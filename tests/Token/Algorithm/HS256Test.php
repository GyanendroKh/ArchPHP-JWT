<?php

use PHPUnit\Framework\TestCase;
use Arch\JWT\Token\Algorithm\HS256;
use Arch\JWT\Exception\AlgorithmNotSupported;
use Arch\JWT\Encryption\Encryption;

class HS256Test extends TestCase{

  public function test() {
    try {
      $hs256 = Encryption::create(new HS256('Arch'));

      $this->assertEquals(HS256::$NAME, $hs256->getAlgorithm()->getName());
      $this->assertEquals('613712a19f49bd62c48d8f7a9f715f5c593c30c81406fcc90ce8d0c1e3f8e3bf',
        $hs256->encrypt('JWT'));
      $this->assertEquals('Arch', $hs256->getAlgorithm()->getSecret());
      $this->assertTrue(
        $hs256->verify(
          $hs256->encrypt('JWT'),
          '613712a19f49bd62c48d8f7a9f715f5c593c30c81406fcc90ce8d0c1e3f8e3bf'
        )
      );
    } catch (AlgorithmNotSupported $e) {
      echo $e->getMessage();
    }
  }

}
