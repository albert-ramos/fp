<?php

namespace Tests\Feature\Client;

use Tests\Feature\ApiTestCase;

class AddPointsToClientFeatureTest extends ApiTestCase
{

    /**
     * Create successfuly a client
     *
     * @return void
     */
    public function test_can_successfully_add_points_to_client()
    {
        $response = $this->ajaxPost('/api/10/client/points/add', [
            'pharmacy_id' => 1,
            'client_id' => $this->client()->id,
            'points' => 10
        ]);

        $response->assertJsonStructure([
            'status',
            'data' => [
                'client_point' => [
                    'pharmacy_id',
                    'client_id',
                    'points',
                ]
            ]
        ]);
        $response->assertJson([
            'status' => 201,
            'data' => [
                'client_point' => [
                    'pharmacy_id' => 1,
                    'client_id' => $this->client()->id,
                    'points' =>  10,
                ]
            ]
        ]);
        $response->assertStatus(201);
    }

    // public function test_creating_a_client_with_errors()
    // {
    //     $response = $this->ajaxPost('/api/10/client/create', [
    //         'name' => 'albert api',
    //     ]);

    //     $response->assertStatus(422);
    // }
}
