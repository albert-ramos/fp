<?php

namespace Tests\Feature\Client;

use Tests\Feature\ApiTestCase;

class ConsumeClientPointsFeatureTest extends ApiTestCase
{

    /**
     * Test can insert negative client points
     *
     * @return void
     */
    public function test_can_insert_negative_client_points()
    {
        $num1 = random_int(10, 20);
        $num2 = random_int(1, 10);

        $this->ajaxPost('/api/10/client/points/add', [
            'pharmacy_id' => 1,
            'client_id' => $this->client()->id,
            'points' => $num1
        ]);

        $response = $this->ajaxPost('/api/10/client/points/consume', [
            'pharmacy_id' => 1,
            'client_id' => $this->client()->id,
            'points' => $num2
        ]);

        $response->assertJsonStructure([
            'status',
            'data' => [
                'client_point' => [
                    'pharmacy_id',
                    'client_id',
                    'points',
                ],
                'total_points'
            ]
        ]);
        $response->assertJson([
            'status' => 200,
            'data' => [
                'client_point' => [
                    'pharmacy_id' => 1,
                    'client_id' => $this->client()->id,
                    'points' =>  -$num2,
                ],
                'total_points' => $num1-$num2
            ]
        ]);

        $response->assertStatus(200);
    }

    /**
     * Test can insert negative client points
     *
     * @return void
     */
    public function test_can_consume_client_points()
    {
        $this->ajaxPost('/api/10/client/points/add', [
            'pharmacy_id' => 1,
            'client_id' => $this->client()->id,
            'points' => 10
        ]);

        $this->ajaxPost('/api/10/client/points/add', [
            'pharmacy_id' => 1,
            'client_id' => $this->client()->id,
            'points' => 15
        ]);


        $consumeResponse = $this->ajaxPost('/api/10/client/points/consume', [
            'pharmacy_id' => 1,
            'client_id' => $this->client()->id,
            'points' => 5
        ]);


        $consumeResponse->assertStatus(200);
    }

}
