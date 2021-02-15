<?php

namespace src\Client\Application\Events\Dispatchers;

use src\Client\Domain\ClientEntity;
use App\Events\Client\ConsumedClientPoints;

class ConsumedClientPointsDispatcherService
{
    static public function dispatch(ClientEntity $client)
    {
        ConsumedClientPoints::dispatch($client);
    }
}
