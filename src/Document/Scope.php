<?php


namespace App\Document;


use App\Traits\DocumentIdentifierTrait;
use Doctrine\ODM\MongoDB\Mapping\Annotations as MongoDB;
use League\OAuth2\Server\Entities\ScopeEntityInterface;

/**
 * Class Scope
 * @package App\Document
 *
 * @MongoDB\Document(repositoryClass="App\Repository\ScopeDoctrineODMRepository")
 */
class Scope implements ScopeEntityInterface {

  use DocumentIdentifierTrait;

  /**
   * @var string
   *
   * @MongoDB\Field(type="string")
   */
  private $scope;

  /**
   * @return mixed
   */
  public function getScope() {
    return $this->scope;
  }

  /**
   * @param mixed $scope
   */
  public function setScope($scope): void {
    $this->scope = $scope;
  }

  /**
   * Specify data which should be serialized to JSON
   * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
   * @return mixed data which can be serialized by <b>json_encode</b>,
   * which is a value of any type other than a resource.
   * @since 5.4.0
   */
  public function jsonSerialize() {
    return $this->getScope();
  }
}
