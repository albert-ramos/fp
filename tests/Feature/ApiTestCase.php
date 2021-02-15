<?php

namespace Tests\Feature;

use Tests\TestCase;

class ApiTestCase extends TestCase
{
    protected $headers = [
        'X-Requested-With' => 'XMLHttpRequest',
        'Accept' => 'application/json'
    ];

    protected $clientFields = [
        'name' => 'albert api',
        'email' => 'albertapi@tete.es',
        'password' => 'mypass'
    ];

    protected $pharmacyFields = [
        'name' => 'PharmaOne',
    ];

    protected $client;

    protected $pharmacy;


    protected function setUp(): void
    {
        parent::setUp();
        $this->createClient();
        $this->setPharmacy();
    }

    public function test_api_pings()
    {
        $response = $this->ajaxGet('/api/ping');
        $response->assertSee('pong');
    }

    /**
     * Make ajax POST request
     */
    protected function ajaxPost($uri, array $data = [])
    {
        return $this->post($uri, $data, $this->headers);
    }

    /**
     * Make ajax GET request
     */
    protected function ajaxGet($uri)
    {
        return $this->get($uri, $this->headers);
    }


    public function client()
    {
        return $this->client;
    }

    public function pharmacy()
    {
        return $this->pharmacy;
    }

    protected function createClient()
    {
        $response = json_decode($this->ajaxPost('/api/10/client/create', $this->clientFields)->getContent());
        $this->assertIsObject($response);
        $this->client = $response->data->client;
    }

    protected function setPharmacy()
    {
        $this->seed();

        $url = '/api/10/pharmacy/find?name=' . $this->pharmacyFields['name'];
        $response = json_decode($this->ajaxPost($url)->getContent());

        $this->assertIsObject($response);
        $this->pharmacy = $response->data->pharmacy;
    }
}
