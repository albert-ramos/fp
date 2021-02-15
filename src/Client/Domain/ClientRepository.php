<?php

namespace src\Client\Domain;

use \InvalidArgumentException;
use Illuminate\Hashing\BcryptHasher;
use src\Shared\Domain\BaseRepository;

class ClientRepository extends BaseRepository
{
    /**
     * ClientEntity
     *
     * @var ClientEntity
     */
    protected $entity;
    
    public function __construct(
        ClientEntity $client, 
        BcryptHasher $hasher,
        ClientPointEntity $clientPointEntity)
    {
        $this->entity = $client;
        $this->hasher = $hasher;
        $this->clientPointEntity = $clientPointEntity;
    }

    /**
     * Gets entity
     *
     * @return ClientEntity
     */
    public function getEntity(): ClientEntity
    {
        return $this->entity;
    }

     /**
      * Creates client
      *
      * @todo Update arguments with DTO
      *
      * @param string $name
      * @param string $email
      * @param string $password
      * @return boolean
      */
    public function create(string $name, string $email, string $password): bool
    {
        $this->entity->uuid = $this->generateUuid();
        $this->entity->name = $name;
        $this->entity->email = $email;
        $this->entity->password = $this->hasher->make($password);
        
        return $this->entity->save();
    }


    /**
     * Create uuid
     *
     * @param string $data
     * @return string
     */
    public function generateUuid(string $data = null): string
    {
        $data = $data ?? random_bytes(16);
        assert(strlen($data) == 16);
        $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
        $data[8] = chr(ord($data[8]) & 0x3f | 0x80);
    
        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }


    /**
     * Get client by email
     *
     * @todo Update arguments with DTO
     * 
     * @param string $email
     * @return void
     */
    public function getByEmail(string $email)
    {
        return $this->entity->where('email', $email)->first();
    }

    public function getByUuid(string $uuid): ClientEntity
    {
        return $this->entity->where('uuid', $uuid)->first();
    }

    public function getIdFromUuid(string $uuid): int
    {
        $client = $this->getByUuid($uuid) ?? null;

        if( is_null($client) ) {
            throw new InvalidArgumentException('invalid client id');
        }

        return  $client->id;
    }

    public function addPoints(int $pharmacyId, string $clientId, int $points): ClientPointEntity
    {
        return $this->updatePoints($pharmacyId, $clientId, $points);
    }

    public function substractPoints(int $pharmacyId, string $clientUuid, int $points): ClientPointEntity
    {
        $this->checkClientHasEnoughPoints($this->getIdFromUuid($clientUuid), $points);
        return $this->updatePoints($pharmacyId, $clientUuid, -1 * abs($points));
    }

    protected function updatePoints(int $pharmacyId, string $clientUuid, int $points): ClientPointEntity
    {
        $clientId = $this->getIdFromUuid($clientUuid);
        
        $this->clientPointEntity->pharmacy_id = $pharmacyId;
        $this->clientPointEntity->client_id = $clientId;
        $this->clientPointEntity->points = $points;
        $this->clientPointEntity->save();

        return $this->clientPointEntity;
    }

    public function checkClientHasEnoughPoints(string $clientId, int $consuming): bool
    {
        $actual = $this->getTotalPointsByClientId($clientId);

        if($actual < $consuming) {
            throw new InvalidArgumentException('client has not enough points to perform this action');
        }

        return true;
    }
    
    public function getTotalPointsByUuid(string $uuid): int
    {
        return $this->getTotalPointsByKey('uuid', $uuid);
    }

    public function getTotalPointsByClientId(string $id): int
    {
        return $this->getTotalPointsByKey('id', $id);
    }

    public function getTotalPointsByKey(string $key, string $value): int
    {
        return $this->clientPointEntity->whereHas('client', function($q) use($key, $value) {
            $q->where($key, $value);
        })->sum('points') ?? 0;
    }
}
