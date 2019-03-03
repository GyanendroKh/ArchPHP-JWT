<?php

namespace Arch\JWT\Token;

use Arch\JWT\Encoder\Base64;
use Arch\JWT\Encryption\Encryption;

/**
 * Class Signature
 * @package Arch\JWT\Token
 */
class Signature {

  private $encoder;
  private $encrypter;

  private $header;
  private $payload;

  /**
   * Signature constructor.
   * @param Header $header
   * @param Payload $payload
   * @throws \Arch\JWT\Exception\AlgorithmNotSupported
   */
  public function __construct(Header $header, Payload $payload) {
    $this->header = $header;
    $this->payload = $payload;

    $this->encoder = new Base64();
    $this->encrypter = Encryption::create($this->header->getAlgorithm());
  }

  /**
   * @return string An encoded jwt without the signature part
   */
  public function getRaw() {
    return "{$this->encoder->encode($this->header->toJSON())}.{$this->encoder->encode($this->payload->toJSON())}";
  }

  /**
   * @return string The encrypted signature
   */
  public function getEncryptedSignature() {
    return $this->encoder->encode($this->encrypter->encrypt($this->getRaw()));
  }

}
