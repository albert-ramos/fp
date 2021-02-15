<?php

namespace Tests\Unit\Client;

use src\Client\Domain\ClientEntity;
use Tests\Unit\Client\ClientTestCase;

class ClientEntityTest extends ClientTestCase
{
    public function test_user_is_saved_successfully_to_db_using_entity()
    {
        $clientEmail = 'robin@wayne.com';
        $clientName = 'Robin';

        $client = new ClientEntity;
        $client->uuid = '3af81d0a-4bc8-49f2-a91e-72c4fdf09bb7';
        $client->email = $clientEmail;
        $client->name = $clientName;
        $client->password = $this->hasher->make('imnotbatman');

        $this->assertTrue($client->save());

        $createdClient = ClientEntity::where('email', $clientEmail)->first();
        $this->assertEquals($createdClient->name, $clientName);
        $this->assertEquals($createdClient->email, $clientEmail);
    }

}
