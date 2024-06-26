<?php

/** @noinspection PhpUnhandledExceptionInspection */

namespace Sensson\DirectAdmin;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Traits\Macroable;
use Illuminate\Support\Traits\Tappable;
use JsonException;
use Sensson\DirectAdmin\Enums\Method;
use Sensson\DirectAdmin\Exceptions\AuthenticationFailed;
use Sensson\DirectAdmin\Exceptions\CommandNotFound;
use Sensson\DirectAdmin\Exceptions\ConnectionFailed;
use Sensson\DirectAdmin\Exceptions\InvalidResponse;
use Sensson\DirectAdmin\Exceptions\Unauthorized;

class DirectAdmin
{
    use Macroable;
    use Tappable;

    public bool $debug = false;

    public string $server;

    public string $username;

    private string $password;

    public function __construct()
    {
        $this->server = config('directadmin.server');
        $this->username = config('directadmin.username');
        $this->password = config('directadmin.password');
    }

    public function post(string $command, array $params = []): Collection
    {
        return $this->call($command, $params);
    }

    public function get(string $command, array $params = []): Collection
    {
        return $this->call($command, $params, Method::GET);
    }

    /**
     * Call the DirectAdmin API by giving it an API command and some
     * parameters. This will return an array with processed data.
     */
    public function call(string $command, array $params = [], Method $method = Method::POST): Collection
    {
        if (str_starts_with(strtolower($command), 'cmd_api_')) {
            $command = strtoupper($command);
        }

        try {
            $response = Http::acceptJson()
                ->baseUrl($this->server)
                ->withBasicAuth($this->username, $this->password)
                ->withOptions($this->getHttpOptions())
                ->withQueryParameters($this->getQueryParams())
                ->{$method->verb()}($command, $params);
        } catch (ConnectionException $e) {
            throw ConnectionFailed::create($e->getMessage());
        }

        return $this->processResponse(
            response: $response,
            command: $command,
        );
    }

    public function become(string $username): static
    {
        $this->username = $this->username.'|'.$username;

        return $this;
    }

    /**
     * Enable debug mode for HTTP requests. This can help identify
     * issues with the DirectAdmin server.
     */
    public function debug(): static
    {
        $this->debug = true;

        return $this;
    }

    /**
     * Process the response that's returned by the DirectAdmin API
     * and prepare it for further processing by third party code.
     */
    protected function processResponse(Response $response, string $command = ''): Collection
    {
        if (! $response->successful() && $response->status() !== 500) {
            match ($response->status()) {
                401 => throw AuthenticationFailed::create(),
                403 => throw Unauthorized::create(),
                405 => throw CommandNotFound::create($command),
                default => throw ConnectionFailed::create($response->body()),
            };
        }

        try {
            $result = json_decode($response->body(), associative: true, flags: JSON_THROW_ON_ERROR);
            $result = collect($result);
        } catch (JsonException) {
            throw InvalidResponse::create('Invalid JSON returned by server: '.$response->body());
        }

        $this->validateResult($result);

        return $result;
    }

    /**
     * Validate the content returned by DirectAdmin. Even though the
     * API can return a successfull response to our HTTP-request
     * the actual call may have failed.
     */
    protected function validateResult(Collection $result): void
    {
        if ($result->has('error')) {
            $error = $result->get('error');
            $description = $result->get('result');

            if (! empty($description)) {
                $description = ': '.$description;
            }

            throw InvalidResponse::create($error.$description);
        }
    }

    protected function getHttpOptions(): array
    {
        return [
            'debug' => $this->debug,
        ];
    }

    protected function getQueryParams(): array
    {
        return [
            'json' => 'yes',
        ];
    }
}
