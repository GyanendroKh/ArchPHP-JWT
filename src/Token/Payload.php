<?php

namespace Arch\JWT\Token;

use Arch\JWT\Exception\VerifierException;
use Arch\JWT\Payload\Verifier;

/**
 * Class Payload
 * @package Arch\JWT\Token
 */
class Payload {

  private $claims = array();

  /**
   * Payload constructor.
   * @param array $claims
   */
  public function __construct(array $claims = []) {
    $this->claims = $claims;
  }

  /**
   * @param string $name
   * @param string $value
   * @return Payload
   */
  public function addClaim(string $name, string $value): Payload {
    $this->claims[$name] = $value;
    return $this;
  }

  /**
   * @param string $name
   * @return bool
   */
  public function isClaimExist(string $name): bool {
    return in_array($name, array_keys($this->claims));
  }

  /**
   * @param string $name
   * @return string|null
   */
  public function getClaim(string $name): string {
    if(!$this->isClaimExist($name)) return null;
    return $this->claims[$name];
  }

  /**
   * @param string $name
   * @return Payload
   */
  public function deleteClaim(string $name): Payload {
    if($this->isClaimExist($name)) {
      unset($this->claims[$name]);
    }
    return $this;
  }

  /**
   * @return array
   */
  public function getClaims(): array {
    return $this->claims;
  }

  /**
   * @throws VerifierException
   */
  public function verify() {
    $verifiers = Verifier::getVerifiers();
    /**
     * @var $verifier Verifier\VerifierInterface
     */
    foreach ($verifiers as $name => $verifier) {
      if($this->isClaimExist($name)) {
        if(!$verifier::verify($this->getClaim($name))) {
          throw Verifier::getException($name);
        }
      }
    }
  }

  /**
   * @return string Json Encoded string of the claims
   */
  public function toJSON(): string {
    return json_encode($this->getClaims());
  }

}
