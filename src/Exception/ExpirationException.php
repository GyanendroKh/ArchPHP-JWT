<?php

namespace Arch\JWT\Exception;

/**
 * Class ExpirationException
 * @package Arch\JWT\Exception
 */
class ExpirationException extends VerifierException  {

  /**
   * ExpirationException constructor.
   */
  public function __construct() {
    parent::__construct('JWT is already expired');
  }

}
