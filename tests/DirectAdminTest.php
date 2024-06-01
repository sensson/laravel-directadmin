<?php

/** @noinspection PhpUnhandledExceptionInspection */

use Illuminate\Support\Facades\Http;
use Sensson\DirectAdmin\DirectAdmin;
use Sensson\DirectAdmin\Exceptions\AuthenticationFailed;
use Sensson\DirectAdmin\Exceptions\CommandNotFound;
use Sensson\DirectAdmin\Exceptions\InvalidResponse;
use Sensson\DirectAdmin\Exceptions\Unauthorized;

it('works', function () {
    Http::fake(function () {
        return Http::response([
            'domain.com' => 'username',
        ]);
    });

    $response = app(DirectAdmin::class)->call('CMD_API_DOMAIN_OWNERS');

    expect($response->toArray())
        ->toMatchArray([
            'domain.com' => 'username',
        ]);
});

it('processes api call directly', function () {
    Http::fake(function () {
        return Http::response([
            'domain.com' => 'username',
        ]);
    });

    $response = app(DirectAdmin::class)->CMD_API_DOMAIN_OWNERS();

    expect($response->toArray())
        ->toMatchArray([
            'domain.com' => 'username',
        ]);
});

it('fails when incorrect credentials are used', function () {
    Http::fake(fn () => Http::response([], 401));

    app(DirectAdmin::class)->call('NOT_LOGGED_IN');
})->throws(AuthenticationFailed::class);

it('fails when user does not have access to resource', function () {
    Http::fake(fn () => Http::response([], 403));

    app(DirectAdmin::class)->call('NO_ACCESS');
})->throws(Unauthorized::class);

it('fails if command is unknown', function () {
    Http::fake(fn () => Http::response([], 405));

    app(DirectAdmin::class)->call('UNKNOWN_COMMAND');
})->throws(CommandNotFound::class);

it('fails if server returns invalid JSON', function () {
    Http::fake(function () {
        return Http::response([
            'error' => 'Invalid JSON',
        ], 500);
    });

    app(DirectAdmin::class)->call('INVALID_JSON');
})->throws(InvalidResponse::class);


