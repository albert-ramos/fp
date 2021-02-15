<?php

namespace App\Listeners;

use App\Events\Client\ClientCreated;
use src\Client\Application\Events\Listeners\ClientCreatedListenerService;

class ClientCreatedHandler
{
    protected $listener;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(ClientCreatedListenerService $listener)
    {
        $this->listener = $listener;
    }

    /**
     * Handle the event.
     *
     * @param  ClientCreated  $event
     * @return void
     */
    public function handle(ClientCreated $event)
    {
        $this->listener->handle($event);
    }
}
