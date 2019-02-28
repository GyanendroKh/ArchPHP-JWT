<?php

namespace Arch\JWT\Encoder;

/**
 * Interface EncoderInterface
 * @package Arch\JWT\Encoder
 */
interface EncoderInterface {

  /**
   * Returns an encoded string
   *
   * @param string $raw
   * @return string
   */
  function encode(string $raw): string;

  /**
   * Returns the raw string
   *
   * @param string $encoded
   * @return string
   */
  function decode(string $encoded): string;

}
