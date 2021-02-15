<?php

namespace Tests\Feature\Pharmacy;

use Tests\Feature\ApiTestCase;

class FindPharmacyFeatureTest extends ApiTestCase
{
    /**
     * Can find a pharmacy by name
     *
     * @return void
     */
    public function test_can_find_pharmacy_by_its_name()
    {
        $this->assertEquals($this->pharmacy()->name, $this->pharmacyFields['name']);
    }

}
