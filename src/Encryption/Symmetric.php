<?php

namespace Arch\JWT\Encryption;

use Arch\JWT\Encryption\Algorithm\SymmetricInterface;

/**
 * Class Symmetric
 * @package Arch\JWT\Encryption
 */
class Symmetric implements EncryptionInterface {

  private $algorithm;

  /**
   * Symmetric constructor.
   * @param SymmetricInterface $algo
   */
  public function __construct(SymmetricInterface $algo) {
    $this->algorithm = $algo;
  }

  /**
   * @return SymmetricInterface
   */
  public function getAlgorithm() {
    return $this->algorithm;
  }

  /**
   * {@inheritdoc}
   *
   * @param string $raw
   * @return string
   */
  public function encrypt(string $raw): string {
    return $this->algorithm->hash($raw);
  }

  /**
   * {@inheritdoc}
   *
   * @param string $encrypted
   * @param string $known
   * @return bool
   */
  public function verify(string $encrypted, string $known): bool {
    return hash_equals($encrypted, $known);
  }

}
