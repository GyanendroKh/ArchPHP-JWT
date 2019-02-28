<?php

namespace Arch\JWT\Encoder;

/**
 * This class will handle the Base64 encoding
 *
 * Class Base64
 * @package Arch\JWT\Encoder
 */
class Base64 implements EncoderInterface {

  private $urlSafe;
  private $strict;
  private $urlSafeChar = ['+' => '-', '/' => '_'];

  /**
   * Base64 constructor.
   * @param bool $urlSafe
   * @param bool $strict
   */
  public function __construct(bool $urlSafe = true, bool $strict = true) {
    $this->urlSafe = $urlSafe;
    $this->strict = $strict;
  }

  /**
   * {@inheritdoc}
   *
   * @param string $raw
   * @return string
   */
  function encode(string $raw): string {
    $raw = trim($raw);
    if($raw === '') return $raw;

    $encoded  = base64_encode($raw);
    if(!$this->urlSafe) return $encoded;

    return strtr(rtrim($encoded, '='), $this->urlSafeChar);
  }

  /**
   * {@inheritdoc}
   *
   * @param string $encoded
   * @return string
   */
  function decode(string $encoded): string {
    $encoded = trim($encoded);
    if($encoded === '') return $encoded;

    if($this->urlSafe) {
      $encoded = strtr($encoded, $this->urlSafeChar) .
        str_repeat('=', 3 - (3 + strlen($encoded)) % 4);
    }

    return base64_decode($encoded, $this->strict);
  }

  /**
   * @return bool
   */
  public function isUrlSafe(): bool {
    return $this->urlSafe;
  }

  /**
   * @param bool $urlSafe
   */
  public function setUrlSafe(bool $urlSafe): void {
    $this->urlSafe = $urlSafe;
  }

  /**
   * @return bool
   */
  public function isStrict(): bool {
    return $this->strict;
  }

  /**
   * @param bool $strict
   */
  public function setStrict(bool $strict): void {
    $this->strict = $strict;
  }


}
