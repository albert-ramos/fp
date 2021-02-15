<?php

namespace src\Client\Application\Services;

use App\Exceptions\Command\IssueFoundException;
use \Exception;
use \InvalidArgumentException;
use src\Client\Domain\ClientRepository;
use src\Client\Domain\ClientPointEntity;
use src\Client\Application\DTO\ClientDTO;
use src\Shared\Infrastructure\LoggerService;
use src\Client\Application\Transformers\SubstractClientsPointsTransformer;
use src\Shared\Application\Http\Exceptions\ErrorWhileProcessingHttpException;
use src\Client\Application\Events\Dispatchers\ConsumedClientPointsDispatcherService;
use Throwable;

class ConsumeClientPointsService 
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
        ConsumedClientPointsDispatcherService $consumedClientPointsDispatcher)
    {
        $this->logger = $logger;
        $this->clientRepository = $clientRepository;
        $this->consumedClientPointsDispatcher = $consumedClientPointsDispatcher;
    }

    /**
     * Creates a client
     *
     * @param ClientDTO $client
     * @return void
     */
    public function consume(int $pharmacyId, string $clientId, int $points): ClientPointEntity
    {
        $clientPoint = $this->clientRepository->substractPoints(
            $pharmacyId,
            $clientId,
            $points
        );

        $this->consumedClientPointsDispatcher->dispatch($this->clientRepository->getEntity());
        return $clientPoint;
    }

    public function getTotalClientPoints(string $clientId)
    {
        return $this->clientRepository->getTotalPointsByUuid($clientId);
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
            $clientPoint = $this->consume($data['pharmacy_id'], $data['client_id'], $data['points']);
            $total = $this->getTotalClientPoints($data['client_id']);
            return (new SubstractClientsPointsTransformer($clientPoint, $total))->get();
        
        } catch(\Exception $e) {
            $this->logger->debug($e);
            throw new ErrorWhileProcessingHttpException();
        }
    }

}