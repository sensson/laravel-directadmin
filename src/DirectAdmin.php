<?php

namespace Sensson\DirectAdmin;

use Illuminate\Support\Traits\ForwardsCalls;
use Illuminate\Support\Traits\Tappable;
use Sensson\DirectAdmin\Exceptions\ConnectionFailed;

class DirectAdmin
{
    use Tappable;
    use ForwardsCalls;

    public function __construct(public Api $api)
    {
        //
    }

    /**
     * @throws ConnectionFailed
     */
    public function call(string $command, array $params = []): array
    {
        return $this->api->call($command, $params);
    }

    public function __call(string $name, array $arguments)
    {
        return $this->forwardCallTo($this->api, $name, $arguments);
    }
}
