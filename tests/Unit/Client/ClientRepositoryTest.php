<?php

namespace Tests\Unit;

use src\Client\Domain\ClientPointEntity;
use src\Client\Domain\ClientRepository;
use Tests\Unit\Client\ClientTestCase;

class ClientRepositoryTest extends ClientTestCase
{
    protected $clientRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $this->setClientRepository();   
    }

    protected function setClientRepository() 
    {
        $this->clientRepository = $this->app->make(ClientRepository::class);
    }

    public function test_user_is_saved_successfully_to_db_using_repository()
    {
        $clientName = 'Robin';
        $clientEmail = 'robin@wayne.com';
        $clientPassword = 'imnotbatman';
        $clientWasCreated = $this->clientRepository->create($clientName, $clientEmail, $clientPassword);

        $this->assertTrue($clientWasCreated);

        $createdClient = $this->clientRepository->getByEmail($clientEmail);
        $this->assertEquals($createdClient->name, $clientName);
        $this->assertEquals($createdClient->email, $clientEmail);
    }

    public function test_can_add_points_to_client_successfuly() 
    {
        $points = 5;

        $clientPoint = $this->clientRepository->addPoints(
            $this->pharmacy()->id,
            $this->client()->uuid,
            $points
        );

        
        $this->assertInstanceOf(ClientPointEntity::class, $clientPoint);
        $this->assertEquals($clientPoint->points, $points);
    }

    public function test_can_add_negative_points_to_client_successfuly() 
    {
        $points = 5;

        $this->clientRepository->addPoints(
            $this->pharmacy()->id,
            $this->client()->uuid,
            $points
        );

        $clientPoint = $this->clientRepository->substractPoints(
            $this->pharmacy()->id,
            $this->client()->uuid,
            $points
        );

        
        $this->assertInstanceOf(ClientPointEntity::class, $clientPoint);
        $this->assertEquals($clientPoint->points, -$points);
    }
}
