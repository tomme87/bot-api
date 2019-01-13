<?php


namespace App\Repository;


use App\Document\Scope;
use App\Interfaces\Repository\IScopeRepository;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class ScopeDoctrineODMRepository
 * @package App\Repository
 *
 * @method Scope|null find($id, $lockMode = null, $lockVersion = null)
 * @method Scope|null findOneBy(array $criteria, array $orderBy = null)
 * @method Scope[]    findAll()
 * @method Scope[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ScopeDoctrineODMRepository extends ServiceDocumentRepository implements IScopeRepository {

  /**
   * ScopeDoctrineODMRepository constructor.
   * @param RegistryInterface $registry
   */
  public function __construct(ManagerRegistry $registry) {
    parent::__construct($registry, Scope::class);
  }


  /**
   * Return information about a scope.
   *
   * @param string $identifier The scope identifier
   *
   * @return ScopeEntityInterface
   */
  public function getScopeEntityByIdentifier($identifier) {
    return $this->findOneBy(['scope' => $identifier]);
  }

  /**
   * Given a client, grant type and optional user identifier validate the set of scopes requested are valid and optionally
   * append additional scopes or remove requested scopes.
   *
   * @param ScopeEntityInterface[] $scopes
   * @param string $grantType
   * @param ClientEntityInterface $clientEntity
   * @param null|string $userIdentifier
   *
   * @return ScopeEntityInterface[]
   */
  public function finalizeScopes(array $scopes, $grantType, ClientEntityInterface $clientEntity, $userIdentifier = null) {
    return $this->findBy(['scope' => $scopes]);
  }
}
