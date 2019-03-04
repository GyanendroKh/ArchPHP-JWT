<?php

namespace Arch\JWT;

use Arch\JWT\Encoder\Base64;
use Arch\JWT\Encryption\Encryption;
use Arch\JWT\Exception\InvalidJWTException;
use Arch\JWT\Token\Header;
use Arch\JWT\Token\Payload;
use Arch\JWT\Token\Signature;

/**
 * Class JWT
 * @package Arch\JWT
 */
class JWT {

  private $header;
  private $payload;
  private $signature;

  /**
   * JWT constructor.
   * @param Header $header
   * @param Payload $payload
   * @throws Exception\AlgorithmNotSupported
   */
  public function __construct(Header $header, Payload $payload) {
    $this->header = $header;
    $this->payload = $payload;
    $this->signature = new Signature($header, $payload);
  }

  /**
   * @return string
   */
  public function getJWT() {
    return "{$this->signature->getRaw()}.{$this->signature->getEncryptedSignature()}";
  }

  /**
   * Decodes the JWT into an object and verifies the signature and payloads
   *
   * @param string $jwt
   * @param $secret
   * @return JWT
   * @throws Exception\AlgorithmNotSupported
   * @throws Exception\InvalidJWTException
   * @throws Exception\VerifierException
   */
  public static function decode(string $jwt, $secret): JWT {
    $decoder = new Base64();
    $jwt = explode('.', $jwt);

    if(count($jwt) === 3) {
      $header = Header::fromJSON($decoder->decode($jwt[0]), $secret);
      $payload = Payload::fromJson($decoder->decode($jwt[1]));

      $encrypter = Encryption::create($header->getAlgorithm());
      $signature = new Signature($header, $payload);

      if($encrypter->verify($jwt[2], $signature->getEncryptedSignature())) {
        $payload->verify();
        return new JWT($header, $payload);
      }
    }
    throw new InvalidJWTException();
  }

  /**
   * @return Header
   */
  public function getHeader(): Header {
    return $this->header;
  }

  /**
   * @return Payload
   */
  public function getPayload(): Payload {
    return $this->payload;
  }

  /**
   * @return Signature
   */
  public function getSignature(): Signature {
    return $this->signature;
  }

}
