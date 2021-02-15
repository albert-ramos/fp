<?php

namespace src\Client\Application\Services;

use Exception;
use src\Client\Domain\ClientRepository;
use src\Client\Domain\ClientPointEntity;
use src\Client\Application\DTO\ClientDTO;
use src\Shared\Infrastructure\LoggerService;
use src\Client\Application\Transformers\AddClientsPointsTransformer;
use src\Client\Application\Events\Dispatchers\ClientCreatedDispatcherService;
use src\Shared\Application\Http\Exceptions\ErrorWhileProcessingHttpException;

class AddClientsPointsService 
{

    /**
     * Client repository
     *
     * @var ClientRepository
     */
    private $clientRepository;

    /**
     * Logger service
     *
     * @var LoggerService
     */
    private $loggerService;

    public function __construct(
        ClientRepository $clientRepository, 
        LoggerService $logger,
        ClientCreatedDispatcherService $createdDispatcher)
    {
        $this->logger = $logger;
        $this->clientRepository = $clientRepository;
        $this->createdDispatcher = $createdDispatcher;
    }

    /**
     * Creates a client
     *
     * @param ClientDTO $client
     * @return void
     */
    public function add(int $pharmacyId, string $clientUuid, int $points): ClientPointEntity
    {
        $clientPoint = $this->clientRepository->addPoints(
            $pharmacyId,
            $clientUuid,
            $points
        );

        $this->createdDispatcher->dispatch($this->clientRepository->getEntity());
        return $clientPoint;
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
            $clientPoint = $this->add($data['pharmacy_id'], $data['client_id'], $data['points']);
            
            return (new AddClientsPointsTransformer($clientPoint))->get();
        } catch(Exception $e) {
            $this->logger->debug($e);
            throw new ErrorWhileProcessingHttpException();
        }
    }

}