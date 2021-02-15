<?php

namespace Tests\Unit\Client;

use Tests\TestCase;
use src\Client\Domain\ClientEntity;
use Illuminate\Hashing\BcryptHasher;
use src\Pharmacy\Domain\PharmacyEntity;

class ClientTestCase extends TestCase
{
   
    protected $clientFields = [
        'name' => 'Bruce',
        'email' => 'bruce@wayne.com',
        'password' => 'imbatman',
    ];

    protected $pharmacyFields = [
        'name' => 'PharmaOne',
    ];

    protected $client;

    protected $pharmacy;

    protected function setUp(): void
    {
        parent::setUp();

        $this->setHasher();
        $this->setClient();
        $this->setPharmacy();
    }

    protected function setHasher(): void
    {
        $this->hasher = new BcryptHasher;
    }

    protected function setClient(): void
    {
        $this->client = new ClientEntity;
        $this->client->uuid = '3af81d0a-4bc8-49f2-a91e-72c4fdf09bb7';
        $this->client->name = $this->clientFields['name'];
        $this->client->email = $this->clientFields['email'];
        $this->client->password = $this->hasher->make($this->clientFields['password']);
        $this->client->save();
    }

    protected function setPharmacy(): void
    {
        $this->pharmacy = new PharmacyEntity;
        $this->pharmacy->name = $this->pharmacyFields['name'];
        $this->pharmacy->save();
    }

    protected function client(): ClientEntity
    {
        return $this->client;
    }

    protected function pharmacy(): PharmacyEntity
    {
        return $this->pharmacy;
    }

}
