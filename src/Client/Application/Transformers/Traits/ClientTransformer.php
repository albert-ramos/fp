<?php

namespace src\Client\Application\Transformers\Traits;

use src\Client\Domain\ClientEntity;

trait ClientTransformer
{

    private function getKey(): string
    {
        return 'client';
    }

    private function transformEntity(ClientEntity $client)
    {
        return [
            'id' => $client->uuid,
            'name' => $client->name,
            'email' => $client->email,
        ];
    }

    private function transformedClient(ClientEntity $client): array
    {
        return [$this->getKey() => $this->transformEntity($client)];
    }

}
