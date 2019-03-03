<?php

namespace Arch\JWT\Payload\Verifier;

/**
 * Interface VerifierInterface
 * @package Arch\JWT\Payload\Verifier
 */
interface VerifierInterface {

  /**
   * @param string $data
   * @return bool
   */
  public static function verify(string $data): bool;

}
