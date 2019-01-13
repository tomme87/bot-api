<?php


namespace App\Document;

use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;

/**
 * Class User
 * @package App\Document
 *
 * @MongoDB\Document()
 */
class User {

  /**
   * @var string
   *
   * @MongoDB\Id(strategy="AUTO", type="string")
   */
  private $id;

  /**
   * @var string
   *
   * @MongoDB\Field(type="string")
   */
  private $username;

  /**
   * @return string
   */
  public function getId(): string {
    return $this->id;
  }

  /**
   * @return string
   */
  public function getUsername(): string {
    return $this->username;
  }

  /**
   * @param string $username
   */
  public function setUsername(string $username): void {
    $this->username = $username;
  }

}
