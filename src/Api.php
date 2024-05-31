<?php

namespace Sensson\DirectAdmin;

use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;
use JsonException;
use Sensson\DirectAdmin\Exceptions\ConnectionFailed;

class Api
{
    public bool $debug = false;

    public bool $json = true;

    /**
     * @throws ConnectionFailed
     */
    public function call(string $command, array $params = []): array
    {
        $queryParams = $this->json
            ? ['json' => true]
            : [];

        try {
            $response = Http::acceptJson()
                ->withBasicAuth(config('directadmin.username'), config('directadmin.password'))
                ->withQueryParameters($queryParams)
                ->post(config('directadmin.baseUrl').'/'.strtoupper($command), $params);
        } catch (ConnectionException $e) {
            throw new ConnectionFailed('Connection failed: '.$e->getMessage());
        }

        return $this->process($response);
    }

    public function withoutJson(): static
    {
        $this->json = false;

        return $this;
    }

    /**
     * @throws ConnectionFailed
     */
    protected function process(Response $response): array
    {
        if (! $response->successful()) {
            match ($response->status()) {
                401 => throw new ConnectionFailed('Unauthorized. Please check the credentials.'),
                403 => throw new ConnectionFailed('Unauthorized. You do not have access to this resource.'),
                405 => throw new ConnectionFailed('Command does not exist.'),
                default => throw new ConnectionFailed('Something went wrong.'),
            };
        }

        try {
            $content = json_decode($response->body(), associative: true, flags: JSON_THROW_ON_ERROR);
        } catch (JsonException) {
            $content = collect(explode('&', urldecode($response->body())))
                ->map(function ($item) {
                    [$domain, $user] = explode('=', $item);

                    return [$user => $domain];
                })
                ->toArray();
        }

        return $content;
    }

    /**
     * @throws ConnectionFailed
     */
    public function __call(string $name, array $arguments)
    {
        if (method_exists($this, $name)) {
            return $this->{$name}(...$arguments);
        }

        return $this->call($name, $arguments);
    }
}
