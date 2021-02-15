<?php

namespace App\Events\Client;

use src\Client\Domain\ClientEntity;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class ClientCreated
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Client Entity
     *
     * @var ClientEntity
     */
    public $client;

    /**
     * Create a ClientCreated instance.
     *
     * @return void
     */
    public function __construct(ClientEntity $client)
    {
        $this->client = $client;
    }

}
