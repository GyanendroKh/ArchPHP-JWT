<?php

namespace Arch\JWT\Exception;

class InvalidJWTException extends \Exception {

  public function __construct(string $msg = 'Invalid JWT') {
    parent::__construct($msg);
  }

}
