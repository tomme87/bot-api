<?php


namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class Application
 * @package App\Document
 *
 * @MongoDB\Document()
 */
class Application {

  /**
   * @var string
   *
   * @MongoDB\Id()
   */
  private $id;

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
  private $clientID;

  /**
   * @var string
   *
   * @MongoDB\Field(type="string")
   */
  private $clientSecret;

  /**
   * @var User
   *
   * @MongoDB\ReferenceOne(targetDocument="User")
   */
  private $user;

  /**
   * @return string
   */
  public function getId(): string {
    return $this->id;
  }

  /**
   * @param string $id
   */
  public function setId(string $id): void {
    $this->id = $id;
  }

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
  public function getClientID(): string {
    return $this->clientID;
  }

  /**
   * @param string $clientID
   */
  public function setClientID(string $clientID): void {
    $this->clientID = $clientID;
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

  /**
   * @return User
   */
  public function getUser(): User {
    return $this->user;
  }

  /**
   * @param User $user
   */
  public function setUser(User $user): void {
    $this->user = $user;
  }

}
