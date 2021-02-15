<?php

namespace src\Client\Application\Services;

use Exception;
use src\Pharmacy\Domain\PharmacyEntity;
use src\Pharmacy\Domain\PharmacyRepository;
use src\Shared\Infrastructure\LoggerService;
use src\Pharmacy\Application\Transformers\FindPharmacyTransformer;
use src\Shared\Application\Http\Exceptions\ErrorWhileProcessingHttpException;

class FindPharmacyService 
{
    /**
     * Logger service
     *
     * @var LoggerService
     */
    private $loggerService;

    public function __construct(
        PharmacyRepository $pharmacyRepository, 
        LoggerService $logger)
    {
        $this->logger = $logger;
        $this->pharmacyRepository = $pharmacyRepository;
    }

    /**
     * Finds a farmacy
     *
     * @param string $name
     * @return void
     */
    public function find(string $name): PharmacyEntity
    {
        return $this->pharmacyRepository->getByName($name);
    }

    /**
     * Handler
     *
     * @param array $data
     * @return array
     */
    public function handleInput(array $data = []): array
    {
        try {
            $pharmacy = $this->find($data['name']);
            return (new  FindPharmacyTransformer($pharmacy))->get();
        } catch(Exception $e) {
            $this->logger->debug($e);
            throw new ErrorWhileProcessingHttpException("lel");
        }
    }

}