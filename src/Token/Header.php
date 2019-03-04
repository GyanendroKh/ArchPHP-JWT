<?php

namespace Arch\JWT\Token;

use Arch\JWT\Encryption\Algorithm\AlgorithmInterface;
use Arch\JWT\Encryption\Algorithm\Map;
use Arch\JWT\Encryption\Encryption;
use Arch\JWT\Exception\InvalidJWTException;

/**
 * Class Header
 * @package Arch\JWT\Token
 */
class Header {

  private $alg;
  private $typ;

  /**
   * Header constructor.
   * @param AlgorithmInterface $alg
   * @param string $typ
   */
  public function __construct(AlgorithmInterface $alg, string $typ = 'JWT') {
    $this->alg = $alg;
    $this->typ = $typ;
  }

  /**
   * @return AlgorithmInterface
   */
  public function getAlgorithm(): AlgorithmInterface {
    return $this->alg;
  }

  /**
   * @param AlgorithmInterface $alg
   */
  public function setAlgorithm(AlgorithmInterface $alg): void {
    $this->alg = $alg;
  }

  /**
   * @return string
   */
  public function getType(): string {
    return $this->typ;
  }

  /**
   * @param string $typ
   */
  public function setType(string $typ): void {
    $this->typ = $typ;
  }

  /**
   * Converts the headers to Json
   *
   * @return string
   */
  public function toJSON() {
    return json_encode([
      'alg' => $this->alg->getName(),
      'typ' => $this->typ
    ]);
  }

  /**
   * Converts json string into object (Header part)
   *
   * @param string $json
   * @param string $secret
   * @return Header
   * @throws InvalidJWTException
   */
  public static function fromJSON(string $json, string $secret): Header {
    $json = json_decode($json);

    if($json !== null && $json !== false) {
      $json = get_object_vars($json);
      if (count($json) === 2) {
        if (isset($json['alg']) && isset($json['typ'])) {
          if (!empty(Map::${$json['alg']})) {
            $algo = new Map::${$json['alg']}($secret);

            if (Encryption::isAlgorithmSupported($algo)) {
              return new Header($algo, $json['typ']);
            }
          }
        }
      }
    }
    throw new InvalidJWTException('Invalid Header');
  }

}
