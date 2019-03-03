<?php

namespace Arch\JWT\Token\Algorithm;

use Arch\JWT\Encryption\Algorithm\Hmac;

/**
 * Class HS256
 * @package Arch\JWT\Token\Algorithm
 */
class HS256 extends Hmac {

  public static $NAME = 'HS256';
  private $algorithm = 'sha256';

  /**
   * {@inheritdoc}
   *
   * @return string
   */
  public function getName(): string {
    return self::$NAME;
  }

  /**
   * {@inheritdoc}
   *
   * @return string
   */
  public function getAlgorithm(): string {
    return $this->algorithm;
  }

}
