<?php

namespace Arch\JWT\Encryption\Algorithm;

/**
 * Interface SymmetricInterface
 * @package Arch\JWT\Encryption\Algorithm
 */
interface SymmetricInterface extends AlgorithmInterface {

  /**
   * @param string $raw the string to be hashed
   * @return string the hashed value
   */
  function hash(string $raw): string;

  /**
   * @return string the secret key used for hashing
   */
  function getSecret(): string;

}
