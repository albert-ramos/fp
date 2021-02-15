<?php

namespace src\Client\Application\Events\Dispatchers;

use App\Events\Client\ClientCreated;
use src\Client\Domain\ClientEntity;

class ClientCreatedDispatcherService
{
    static public function dispatch(ClientEntity $client)
    {
        ClientCreated::dispatch($client);
    }
}
