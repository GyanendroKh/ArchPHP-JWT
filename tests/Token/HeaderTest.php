<?php

use Arch\JWT\Exception\InvalidJWTException;
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

  public function testFromJSON() {
    try {
      $header = Header::fromJSON(json_encode([
        'alg' => 'none',
        'typ' => 'JWT'
      ]), '');

      /**
       * @var $alg \Arch\JWT\Encryption\Algorithm\SymmetricInterface
       */
      $alg = $header->getAlgorithm();
      $this->assertEquals('none', $alg->getName());
      $this->assertEquals('', $alg->getSecret());
      $this->assertEquals('JWT', $header->getType());

      Header::fromJSON(json_encode([
        'alg' => 'none',
      ]), '');
    }catch (\Exception $e) {
      $this->assertInstanceOf(InvalidJWTException::class, $e);
      try {
        Header::fromJSON(json_encode([
          'alg' => 'none',
          'typ' => 'JWT',
          'aa' => 'A'
        ]), '');
      }catch (\Exception $e) {
        $this->assertInstanceOf(InvalidJWTException::class, $e);
        try {
          Header::fromJSON('aa', '');
        }catch (\Exception $e) {
          $this->assertInstanceOf(InvalidJWTException::class, $e);
        }
      }
    }
  }

}
