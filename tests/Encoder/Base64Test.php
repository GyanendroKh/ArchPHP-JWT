<?php

use Arch\JWT\Encoder\Base64 as Encoder;
use PHPUnit\Framework\TestCase;

class Base64Test extends TestCase {

  public function testEncoder() {
    $encoder = new Encoder();
    echo $encoder->encode('Arch');
    $this->assertEquals('QXJjaA', $encoder->encode('Arch'));
    $this->assertEquals('Arch', $encoder->decode('QXJjaA'));
    $this->assertEquals('Arch', $encoder->decode('QXJjaA  '));
    $encoder->setUrlSafe(false);
    $this->assertEquals('QXJjaA==', $encoder->encode('Arch'));
    $this->assertEquals('', $encoder->encode('   '));
    $this->assertEquals('Arch', $encoder->decode('QXJjaA=='));
    $this->assertEquals('Arch', $encoder->decode('  QXJjaA=='));
  }

}
