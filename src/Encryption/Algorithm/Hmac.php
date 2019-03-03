<?php

namespace Arch\JWT\Encryption\Algorithm;

/**
 * Class Hmac
 * @package Arch\JWT\Encryption\Algorithm
 */
abstract class Hmac implements SymmetricInterface {

  private $secretKey;

  /**
   * Hmac constructor.
   * @param string $secret
   */
  public function __construct(string $secret) {
    $this->secretKey = $secret;
  }

  /**
   * {@inheritdoc}
   *
   * @return string
   */
  public function getSecret(): string {
    return $this->secretKey;
  }

  /**
   * @param string $secret the new Secret key
   * @return Hmac
   */
  public function setSecret(string $secret): Hmac {
    $this->secretKey = $secret;
    return $this;
  }

  /**
   * {@inheritdoc}
   *
   * @param string $raw
   * @return string
   */
  public function hash(string $raw): string {
    return hash_hmac($this->getAlgorithm(), $raw, $this->getSecret(), true);
  }

}
