<?php


namespace App\Document;

use Doctrine\Common\Collections\Collection;
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
   * @var Collection<Application>
   *
   * @MongoDB\ReferenceMany(targetDocument="Application")
   */
  private $applications;

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

  /**
   * @return Collection
   */
  public function getApplications(): Collection {
    return $this->applications;
  }

  /**
   * @param Collection $applications
   */
  public function setApplications(Collection $applications): void {
    $this->applications = $applications;
  }

}
