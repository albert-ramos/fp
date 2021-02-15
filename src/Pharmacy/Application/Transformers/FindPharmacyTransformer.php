<?php

namespace src\Pharmacy\Application\Transformers;

use src\Pharmacy\Domain\PharmacyEntity;
use src\Shared\Application\Transformers\AbstractTransformer;
use src\Pharmacy\Application\Transformers\Traits\PharmacyTransformer;

class FindPharmacyTransformer extends AbstractTransformer
{
    use PharmacyTransformer;

    protected $pharmacy;

    public function __construct(PharmacyEntity $pharmacy)
    {
        $this->pharmacy = $pharmacy;
    }

    protected function getPharmacy(): PharmacyEntity
    {
        return $this->pharmacy;
    }

    protected function build(): array
    {
        return $this->transformedClient($this->getPharmacy());
    }

}
