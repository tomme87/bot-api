<?php


namespace App\Repository;


use App\Document\Client;
use App\Interfaces\Repository\IClientRepository;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class ClientDoctrineODMRepository
 * @package App\Repository
 *
 * @method Client|null find($id, $lockMode = null, $lockVersion = null)
 * @method Client|null findOneBy(array $criteria, array $orderBy = null)
 * @method Client[]    findAll()
 * @method Client[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ClientDoctrineODMRepository extends ServiceDocumentRepository implements IClientRepository {

  /**
   * ClientDoctrineODMRepository constructor.
   * @param RegistryInterface $registry
   */
  public function __construct(ManagerRegistry $registry) {
    parent::__construct($registry, Client::class);
  }

  /**
   * Get a client.
   *
   * @param string $clientIdentifier The client's identifier
   * @param null|string $grantType The grant type used (if sent)
   * @param null|string $clientSecret The client's secret (if sent)
   * @param bool $mustValidateSecret If true the client must attempt to validate the secret if the client
   *                                        is confidential
   *
   * @return ClientEntityInterface|null
   * @throws \Doctrine\ODM\MongoDB\LockException
   * @throws \Doctrine\ODM\MongoDB\Mapping\MappingException
   */
  public function getClientEntity($clientIdentifier, $grantType = null, $clientSecret = null, $mustValidateSecret = true): ?ClientEntityInterface {
    $client = $this->find($clientIdentifier);

    if ($client === null) {
      return null;
    }

    if ($mustValidateSecret === true && $client->getClientSecret() !== $clientSecret) {
      return null;
    }

    return $client;
  }
}
