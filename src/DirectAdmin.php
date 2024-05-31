<?php

namespace Sensson\DirectAdmin;

use Illuminate\Support\Collection;
use Illuminate\Support\Traits\ForwardsCalls;
use Illuminate\Support\Traits\Tappable;
use Sensson\DirectAdmin\Exceptions\ConnectionFailed;
use Sensson\DirectAdmin\Exceptions\InvalidResponse;

class DirectAdmin
{
    use ForwardsCalls;
    use Tappable;

    public function __construct(public Api $api)
    {
        //
    }

    /**
     * @throws ConnectionFailed
     * @throws InvalidResponse
     */
    public function call(string $command, array $params = []): Collection
    {
        return $this->api->call($command, $params);
    }

    public function __call(string $name, array $arguments)
    {
        return $this->forwardCallTo($this->api, $name, $arguments);
    }
}
