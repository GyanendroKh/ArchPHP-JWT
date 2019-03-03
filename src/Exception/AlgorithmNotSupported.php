<?php

namespace Arch\JWT\Exception;

use Arch\JWT\Encryption\Algorithm\AlgorithmInterface;

/**
 * Class AlgorithmNotSupported
 * @package Arch\JWT\Exception
 */
class AlgorithmNotSupported extends \Exception {

  private $algo;

  /**
   * AlgorithmNotSupported constructor.
   * @param AlgorithmInterface $algo
   */
  public function __construct(AlgorithmInterface $algo) {
    parent::__construct("Algorithm ({$algo->getName()}) is not supported");
    $this->algo = $algo;
  }

  /**
   * @return AlgorithmInterface
   */
  public function getAlgorithm(): AlgorithmInterface {
    return $this->algo;
  }

}
