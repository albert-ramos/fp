<?php

namespace src\Pharmacy\Domain;

use src\Shared\Domain\BaseRepository;

class PharmacyRepository extends BaseRepository
{
    /**
     * ClientEntity
     *
     * @var PharmacyEntity
     */
    protected $entity;
    
    public function __construct(PharmacyEntity $pharmacy)
    {
        $this->entity = $pharmacy;
    }

    /**
     * Gets entity
     *w
     * @return PharmacyEntity
     */
    public function getEntity(): PharmacyEntity
    {
        return $this->entity;
    }

     /**
      * Creates pharmacy
      *
      * @todo Update arguments with DTO
      *
      * @param string $name
      * @param string $email
      * @param string $password
      * @return boolean
      */
    public function create(string $name): bool
    {
        $this->entity->name = $name;
        return $this->entity->save();
    }

    /**
     * Get by name
     * 
     * @param string $name
     * @return PharmacyEntity
     */
    public function getByName(string $name): PharmacyEntity
    {
        return $this->entity->where('name', $name)->first();
    }
}
