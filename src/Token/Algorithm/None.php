<?php

namespace Arch\JWT\Token\Algorithm;

use Arch\JWT\Encryption\Algorithm\Hmac;

/**
 * Class None
 * @package Arch\JWT\Token\Algorithm
 */
class None extends Hmac {

  public static $NAME = 'none';

  /**
   * None constructor.
   */
  public function __construct() {
    parent::__construct('');
  }

  /**
   * {@inheritdoc
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
  public function getAlgorithm(): string{
    return '';
  }

  /**
   * {@inheritdoc}
   *
   * @param string $value
   * @return string
   */
  public function hash(string $value = ''): string {
    return '';
  }

}
