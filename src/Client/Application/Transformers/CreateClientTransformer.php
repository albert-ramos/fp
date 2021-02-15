<?php

namespace src\Client\Application\Transformers;

use src\Client\Domain\ClientEntity;
use src\Shared\Application\Transformers\AbstractTransformer;
use src\Client\Application\Transformers\Traits\ClientTransformer;


class CreateClientTransformer extends AbstractTransformer
{
    use ClientTransformer;

    protected $client;

    public function __construct(ClientEntity $client)
    {
        $this->client = $client;
    }

    protected function getClient(): ClientEntity
    {
        return $this->client;
    }

    protected function build(): array
    {
        return $this->transformedClient($this->getClient());
    }

}
