<?php

namespace src\Client\Application\Transformers\Traits;

use src\Client\Domain\ClientPointEntity;

trait ClientPointTransformer
{

    private function getKey(): string
    {
        return 'client_point';
    }

    private function transformEntity(ClientPointEntity $clientPoint)
    {
        return [
            'pharmacy_id' => $clientPoint->pharmacy_id,
            'client_id' => $clientPoint->client->uuid,
            'points' => $clientPoint->points,
        ];
    }

    private function transformedClientPoint(ClientPointEntity $clientPoint): array
    {
        return [$this->getKey() => $this->transformEntity($clientPoint)];
    }

}
