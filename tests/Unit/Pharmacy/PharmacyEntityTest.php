<?php

namespace Tests\Unit\Pharmacy;

use src\Pharmacy\Domain\PharmacyEntity;
use Tests\Unit\Client\ClientTestCase;

class PharmacyEntityTest extends ClientTestCase
{
    public function test_pharmacy_is_saved_to_db()
    {
        $pharmacyName = 'PharmaOne';

        $pharmacy = new PharmacyEntity;
        $pharmacy->name = $pharmacyName;

        $this->assertTrue($pharmacy->save());
        
        $createdPharmacy = PharmacyEntity::where('name', $pharmacyName)->first();
        $this->assertEquals($createdPharmacy->name, $pharmacyName);
    }

}
