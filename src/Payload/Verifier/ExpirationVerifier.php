<?php

namespace Arch\JWT\Payload\Verifier;

use Arch\JWT\Payload\Verifier;

/**
 * Class ExpirationVerifier
 * @package Arch\JWT\Payload\Verifier
 */
class ExpirationVerifier extends Verifier {

  public static $name = 'exp';

  /**
   * @param string $data
   * @return bool
   */
  public static function verify(string $data): bool {
    if(time() < $data) return true;
    return false;
  }

}
