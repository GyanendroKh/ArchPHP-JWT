<?php

namespace Arch\JWT\Payload\Verifier;

use Arch\JWT\Payload\Verifier;

/**
 * Class NotBeforeVerifier
 * @package Arch\JWT\Payload\Verifier
 */
class NotBeforeVerifier extends Verifier {

  public static $name = 'nbf';

  /**
   * @param string $data
   * @return bool
   */
  public static function verify(string $data): bool {
    if(time() > $data) return true;
    return false;
  }


}
