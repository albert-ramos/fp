<?php

namespace src\Client\Application\Transformers;

use src\Client\Domain\ClientPointEntity;
use src\Shared\Application\Transformers\AbstractTransformer;
use src\Client\Application\Transformers\Traits\ClientPointTransformer;

class AddClientsPointsTransformer extends AbstractTransformer
{
    use ClientPointTransformer;

    protected $clientPoint;

    public function __construct(ClientPointEntity $clientPoint)
    {
        $this->clientPoint = $clientPoint;
    }

    protected function getClientPoint(): ClientPointEntity
    {
        return $this->clientPoint;
    }

    protected function build(): array
    {
        return $this->transformedClientPoint($this->getClientPoint());
    }
}
