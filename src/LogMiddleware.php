<?php

namespace HttpClient\Log;

use function GuzzleHttp\Promise\rejection_for;
use Monolog\Logger;

class LogMiddleware
{
    protected $logger;

    public function __construct()
    {
        $this->logger = new Logger('HttpClient');
    }

    public function __invoke(callable $handler)
    {
        return function ($request, array $options) use ($handler) {
            return $handler($request, $options)->then(
                function ($response) use ($request) {
                    return $response;
                },
                function ($reason) {
                    return rejection_for($reason);
                }
            );
        };
    }
}
