<?php

namespace Tests\Unit\Pharmacy;

use src\Pharmacy\Domain\PharmacyRepository;
use Tests\Unit\Pharmacy\PharmacyTestCase;

class PharmacyRepositoryTest extends PharmacyTestCase
{
    protected $clientRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setPharmacyRepository();   
    }

    protected function setPharmacyRepository() 
    {
        $this->pharmacyRepository = $this->app->make(PharmacyRepository::class);
    }

    public function test_pharmacy_is_saved_successfuly()
    {
        $pharmacyName = 'PharmaOne';
        $pharmaWasCreated = $this->pharmacyRepository->create($pharmacyName);

        $this->assertTrue($pharmaWasCreated);

        $createdPharmacy = $this->pharmacyRepository->getByName($pharmacyName);
        $this->assertEquals($createdPharmacy->name, $pharmacyName);
    }

}
