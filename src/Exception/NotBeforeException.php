<?php

namespace Arch\JWT\Exception;

/**
 * Class NotBeforeException
 * @package Arch\JWT\Exception
 */
class NotBeforeException extends VerifierException {

  /**
   * NotBeforeException constructor.
   */
  public function __construct() {
    parent::__construct("JWT not yet valid.");
  }

}
