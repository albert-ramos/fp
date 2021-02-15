<?php

namespace src\Client\Application\Transformers;

use src\Client\Application\Transformers\Traits\TotalClientPointsTransformer;
use src\Client\Domain\ClientPointEntity;

class SubstractClientsPointsTransformer extends AddClientsPointsTransformer
{
   use TotalClientPointsTransformer;

   private $total;

   public function __construct(ClientPointEntity $clientPoint, int $total)
   {
       parent::__construct($clientPoint);
       $this->total = $total;
   }

   protected function build(): array
   {
       return array_merge(parent::build(), $this->transformedTotalPoints($this->total));
   }
}
