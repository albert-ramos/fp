<?php

namespace src\Client\Application\Transformers\Traits;

trait TotalClientPointsTransformer
{

    private function getKey(): string
    {
        return 'total_points';
    }

    private function transformedTotalPoints(int $total): array
    {
        return [$this->getKey() => $total];
    }

}
