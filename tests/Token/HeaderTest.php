<?php

use Arch\JWT\Token\Algorithm\None;
use Arch\JWT\Token\Header;
use PHPUnit\Framework\TestCase;

class HeaderTest extends TestCase {

  public function test() {
    $header = new Header(new None());
    $this->assertEquals(json_encode([
      'alg' => $header->getAlgorithm()->getName(),
      'typ' => $header->getType()
    ]), $header->toJSON());
  }

}
