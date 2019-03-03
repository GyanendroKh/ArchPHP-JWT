<?php

namespace Arch\JWT\Token;

use Arch\JWT\Encryption\Algorithm\AlgorithmInterface;

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

}
