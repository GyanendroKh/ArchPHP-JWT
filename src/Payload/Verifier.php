<?php

namespace Arch\JWT\Payload;

use Arch\JWT\Exception\ExpirationException;
use Arch\JWT\Exception\NotBeforeException;
use Arch\JWT\Exception\VerifierException;
use Arch\JWT\Payload\Verifier\ExpirationVerifier;
use Arch\JWT\Payload\Verifier\NotBeforeVerifier;
use Arch\JWT\Payload\Verifier\VerifierInterface;

/**
 * Class Verifier
 * @package Arch\JWT\Payload
 */
abstract class Verifier implements VerifierInterface {

  /**
   * @return array Class Map for all the supported claim verifier
   */
  public static function getVerifiers(): array {
    return array(
      ExpirationVerifier::$name   => ExpirationVerifier::class,
      NotBeforeVerifier::$name    => NotBeforeVerifier::class
    );
  }

  public static function getExceptions(): array {
    return array(
      ExpirationVerifier::$name   => ExpirationException::class,
      NotBeforeVerifier::$name    => NotBeforeException::class
    );
  }

  /**
   * @param string $name
   * @return VerifierException|null
   */
  public static function getException(string $name): VerifierException {
    foreach(self::getExceptions() as $n => $v) {
      if($name === $n) return new $v();
    }
    return null;
  }

}
