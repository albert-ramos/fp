<?php

namespace src\Pharmacy\Application\Transformers\Traits;

use src\Pharmacy\Domain\PharmacyEntity;

trait PharmacyTransformer
{

    private function getKey(): string
    {
        return 'pharmacy';
    }

    private function transformEntity(PharmacyEntity $pharmacy)
    {
        return [
            'id' => $pharmacy->id,
            'name' => $pharmacy->name,
        ];
    }

    private function transformedClient(PharmacyEntity $client): array
    {
        return [$this->getKey() => $this->transformEntity($client)];
    }

}
