<?php

namespace Tests\Unit\Pharmacy;

use src\Pharmacy\Domain\PharmacyEntity;
use Tests\TestCase;

class PharmacyTestCase extends TestCase
{
   
    protected $pharmacyFields = [
        'name' => 'PharmaOne',
    ];

    protected $pharmacy;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setPharmacy();
    }

    protected function setPharmacy(): void
    {
        $this->client = new PharmacyEntity;
        $this->client->name = $this->pharmacyFields['name'];
        $this->client->save();
    }

    protected function pharmacy(): PharmacyEntity
    {
        return $this->client;
    }

}
