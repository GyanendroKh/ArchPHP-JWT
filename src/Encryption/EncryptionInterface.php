<?php

namespace Arch\JWT\Encryption;

/**
 * Interface EncryptionInterface
 * @package Arch\JWT\Encryption
 */
interface EncryptionInterface {

  /**
   * @param string $raw The string to be encrypted
   * @return string The encrypted string
   */
  function encrypt(string $raw): string;

  /**
   * Checks if the $encrypted and $known are equal
   *
   * @param string $encrypted
   * @param string $known
   * @return bool
   */
  function verify(string $encrypted, string $known): bool;

}
