<?php


use Arch\JWT\Encryption\Encryption;
use Arch\JWT\Exception\AlgorithmNotSupported;
use Arch\JWT\Token\Algorithm\None;
use PHPUnit\Framework\TestCase;

class NoneTest extends TestCase {

  public function test() {
    try {
      $none = Encryption::create(new None());
      $this->assertEquals('none', $none->getAlgorithm()->getName());
      $this->assertEquals('', $none->encrypt('A'));
    }catch (AlgorithmNotSupported $e) {
      echo $e->getMessage();
    }
  }

}
