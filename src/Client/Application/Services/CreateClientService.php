<?php

namespace src\Client\Application\Services;

use Exception;
use src\Client\Domain\ClientEntity;
use src\Client\Domain\ClientRepository;
use src\Client\Application\DTO\ClientDTO;
use src\Shared\Infrastructure\LoggerService;
use src\Client\Application\Transformers\CreateClientTransformer;
use src\Client\Application\Events\Dispatchers\ClientCreatedDispatcherService;
use src\Shared\Application\Http\Exceptions\ErrorWhileProcessingHttpException;

class CreateClientService 
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
    public function create(ClientDTO $client): ClientEntity
    {
        $this->clientRepository->create(
            $client->getName(), 
            $client->getEmail(), 
            $client->getPassword()
        );

        $this->createdDispatcher->dispatch($this->clientRepository->getEntity());
        return $this->clientRepository->getEntity();
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
            $clientDTO = new ClientDTO($data['name'], $data['email'], $data['password']);
            $client = $this->create($clientDTO);
            
            return (new CreateClientTransformer($client))->get();
        } catch(Exception $e) {
            $this->logger->debug($e);
            throw new ErrorWhileProcessingHttpException();
        }
    }

}