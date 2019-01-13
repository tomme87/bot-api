<?php


namespace App\Traits;


trait DocumentIdentifierTrait {
  /**
   * @var string
   *
   * @MongoDB\Id()
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
}
