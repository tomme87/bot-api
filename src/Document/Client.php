<?php


namespace App\Document;

use App\Traits\DocumentIdentifierTrait;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use League\OAuth2\Server\Entities\ClientEntityInterface;

/**
 * Class Client
 * @package App\Document
 *
 * @MongoDB\Document(repositoryClass="App\Repository\ClientDoctrineODMRepository")
 */
class Client implements ClientEntityInterface {
  use DocumentIdentifierTrait;

  /**
   * @var string
   *
   * @MongoDB\Field(type="string")
   */
  private $name;

  /**
   * @var string
   *
   * @MongoDB\Field(type="string")
   */
  private $redirectUri;

  /**
   * @var string
   *
   * @MongoDB\Field(type="string")
   */
  private $clientSecret;

  /**
   * @return string
   */
  public function getName(): string {
    return $this->name;
  }

  /**
   * @param string $name
   */
  public function setName(string $name): void {
    $this->name = $name;
  }

  /**
   * @return string
   */
  public function getRedirectUri(): string {
    return $this->redirectUri;
  }

  /**
   * @param string $redirectUri
   */
  public function setRedirectUri(string $redirectUri): void {
    $this->redirectUri = $redirectUri;
  }

  /**
   * @return string
   */
  public function getClientSecret(): string {
    return $this->clientSecret;
  }

  /**
   * @param string $clientSecret
   */
  public function setClientSecret(string $clientSecret): void {
    $this->clientSecret = $clientSecret;
  }

}
