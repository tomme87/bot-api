<?php


namespace App\Repository;


use App\Document\AccessToken;
use App\Interfaces\Repository\IAccessTokenRepository;
use Doctrine\Bundle\MongoDBBundle\ManagerRegistry;
use Doctrine\Bundle\MongoDBBundle\Repository\ServiceDocumentRepository;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Exception\UniqueTokenIdentifierConstraintViolationException;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * Class AccessTokenDoctrineODMRepository
 * @package App\Repository
 *
 * @method AccessToken|null find($id, $lockMode = null, $lockVersion = null)
 * @method AccessToken|null findOneBy(array $criteria, array $orderBy = null)
 * @method AccessToken[]    findAll()
 * @method AccessToken[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AccessTokenDoctrineODMRepository extends ServiceDocumentRepository implements IAccessTokenRepository {

  /**
   * AccessTokenDoctrineODMRepository constructor.
   * @param RegistryInterface $registry
   */
  public function __construct(ManagerRegistry $registry) {
    parent::__construct($registry, AccessToken::class);
  }


  /**
   * Create a new access token
   *
   * @param ClientEntityInterface $clientEntity
   * @param ScopeEntityInterface[] $scopes
   * @param mixed $userIdentifier
   *
   * @return AccessTokenEntityInterface
   */
  public function getNewToken(ClientEntityInterface $clientEntity, array $scopes, $userIdentifier = null) {
    return new AccessToken();
  }

  /**
   * Persists a new access token to permanent storage.
   *
   * @param AccessTokenEntityInterface $accessTokenEntity
   *
   * @throws UniqueTokenIdentifierConstraintViolationException
   */
  public function persistNewAccessToken(AccessTokenEntityInterface $accessTokenEntity) {
    $this->getDocumentManager()->persist($accessTokenEntity);
    $this->getDocumentManager()->flush();
  }

  /**
   * Revoke an access token.
   *
   * @param string $tokenId
   * @throws \Doctrine\ODM\MongoDB\LockException
   * @throws \Doctrine\ODM\MongoDB\Mapping\MappingException
   */
  public function revokeAccessToken($tokenId) {
    $accessToken = $this->find($tokenId);
    $accessToken->setRevoked(true);
    $this->getDocumentManager()->flush();
  }

  /**
   * Check if the access token has been revoked.
   *
   * @param string $tokenId
   *
   * @return void Return true if this token has been revoked
   * @throws \Doctrine\ODM\MongoDB\LockException
   * @throws \Doctrine\ODM\MongoDB\Mapping\MappingException
   */
  public function isAccessTokenRevoked($tokenId) {
    $this->find($tokenId)->isRevoked();
  }
}
