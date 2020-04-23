<?php

namespace HttpClient\Log;

class Extension
{
    public function __invoke(Client $client)
    {
        $client->resolved(function ($client) {
            $client->middleware->add('log', new LogMiddleware);
        });
    }
}
