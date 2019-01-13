<?php


namespace App\Document;


use DateTime;
use Doctrine\Common\Collections\Collection;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use League\OAuth2\Server\Entities\AccessTokenEntityInterface;
use League\OAuth2\Server\Entities\ClientEntityInterface;
use League\OAuth2\Server\Entities\ScopeEntityInterface;
use League\OAuth2\Server\Entities\Traits\AccessTokenTrait;

;

/**
 * Class AccessToken
 * @package App\Document
 *
 * @MongoDB\Document(repositoryClass="App\Repository\AccessTokenDoctrineODMRepository")
 */
class AccessToken implements AccessTokenEntityInterface {
  use AccessTokenTrait;

  /**
   * @var string
   *
   * @MongoDB\Id(strategy="NONE")
   */
  private $identifier;

  /**
   * @return string
   */
  public function getIdentifier(): string {
    return $this->identifier;
  }

  /**
   * @param string $identifier
   */
  public function setIdentifier($identifier): void {
    $this->identifier = $identifier;
  }

  /**
   * @var ScopeEntityInterface[]|Collection
   *
   * @MongoDB\ReferenceMany(targetDocument="Scope")
   */
  private $scopes = [];

  /**
   * @var DateTime
   *
   * @MongoDB\Field(type="date")
   */
  private $expiryDateTime;

  /**
   * @var string|int|null
   *
   * @MongoDB\Field(type="string")
   */
  private $userIdentifier;

  /**
   * @var ClientEntityInterface
   *
   * @MongoDB\ReferenceOne(targetDocument="Client")
   */
  private $client;

  /**
   * @var bool
   *
   * @MongoDB\Field(type="boolean")
   */
  private $revoked = false;

  /**
   * Get the token's expiry date time.
   *
   * @return DateTime
   */
  public function getExpiryDateTime() {
    return $this->expiryDateTime;
  }

  /**
   * Set the date time when the token expires.
   *
   * @param DateTime $dateTime
   */
  public function setExpiryDateTime(DateTime $dateTime) {
    $this->expiryDateTime = $dateTime;
  }

  /**
   * Set the identifier of the user associated with the token.
   *
   * @param string|int|null $identifier The identifier of the user
   */
  public function setUserIdentifier($identifier) {
    $this->userIdentifier = $identifier;
  }

  /**
   * Get the token user's identifier.
   *
   * @return string|int|null
   */
  public function getUserIdentifier() {
    return $this->userIdentifier;
  }

  /**
   * Get the client that the token was issued to.
   *
   * @return ClientEntityInterface
   */
  public function getClient() {
    return $this->client;
  }

  /**
   * Set the client that the token was issued to.
   *
   * @param ClientEntityInterface $client
   */
  public function setClient(ClientEntityInterface $client) {
    $this->client = $client;
  }

  /**
   * Associate a scope with the token.
   *
   * @param Scope $scope
   */
  public function addScope(ScopeEntityInterface $scope) {
    $this->scopes = $scope;
  }

  /**
   * Return an array of scopes associated with the token.
   *
   * @return ScopeEntityInterface[]
   */
  public function getScopes() {
    return $this->scopes;
  }

  /**
   * @return bool
   */
  public function isRevoked(): bool {
    return $this->revoked;
  }

  /**
   * @param bool $revoked
   */
  public function setRevoked(bool $revoked): void {
    $this->revoked = $revoked;
  }

}
