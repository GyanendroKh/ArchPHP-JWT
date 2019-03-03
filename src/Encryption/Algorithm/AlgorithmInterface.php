<?php

namespace Arch\JWT\Encryption\Algorithm;

/**
 * Interface AlgorithmInterface
 * @package Arch\JWT\Encryption\Algorithm
 */
interface AlgorithmInterface {

  /**
   * @return string the name of the Algorithm
   */
  function getName(): string;

  /**
   * @return string the algorithm to be used
   */
  function getAlgorithm(): string;

}
