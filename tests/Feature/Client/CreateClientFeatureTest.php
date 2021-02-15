<?php

namespace Tests\Feature\Client;

use Tests\Feature\ApiTestCase;

class CreateClientFeature extends ApiTestCase
{

    /**
     * Create successfuly a client
     *
     * @return void
     */
    public function test_can_successfully_create_a_client()
    {
        $response = $this->ajaxPost('/api/10/client/create', [
            'name' => 'albert api',
            'email' => 'albertapi@tete.es',
            'password' => 'mypass'
        ]);


        $response->assertJsonStructure([
            'status',
            'data' => ['client']
        ]);
        $response->assertJson([
            'status' => 201,
            'data' => [
                'client' => [
                    'name' => 'albert api',
                    'email' => 'albertapi@tete.es',
                ]
            ]
        ]);
        $response->assertStatus(201);
    }

    public function test_creating_a_client_with_errors()
    {
        $response = $this->ajaxPost('/api/10/client/create', [
            'name' => 'albert api',
        ]);

        $response->assertStatus(422);
    }
}
