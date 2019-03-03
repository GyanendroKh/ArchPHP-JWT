<?php

namespace Arch\JWT\Encryption;

use Arch\JWT\Encryption\Algorithm\AlgorithmInterface;
use Arch\JWT\Encryption\Algorithm\Map;
use Arch\JWT\Encryption\Algorithm\SymmetricInterface;
use Arch\JWT\Exception\AlgorithmNotSupported;

/**
 * Class Encryption
 * @package Arch\JWT\Encryption
 */
class Encryption {

  /**
   * @param AlgorithmInterface $algo
   * @return Symmetric
   * @throws AlgorithmNotSupported
   */
  public static function create(AlgorithmInterface $algo) {
    if(self::isAlgorithmSupported($algo)) {
      if($algo instanceof SymmetricInterface) {
        return new Symmetric($algo);
      }
    }

    throw new AlgorithmNotSupported($algo);
  }

  /**
   * @return array a list of all the supported hashing algorithm
   */
  public static function getSupportedAlgorithms(): array {
    return hash_algos();
  }

  /**
   * Checks if the current algorithm is supported
   * @param AlgorithmInterface $algo
   * @return bool
   */
  public static function isAlgorithmSupported(AlgorithmInterface $algo): bool {
    if($algo->getName() == 'none') return true;
    return in_array($algo->getAlgorithm(), self::getSupportedAlgorithms()) &&
      !empty(Map::${$algo->getName()});
  }

}
