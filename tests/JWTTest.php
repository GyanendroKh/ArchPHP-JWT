<?php

use Arch\JWT\Exception\ExpirationException;
use Arch\JWT\Exception\InvalidJWTException;
use Arch\JWT\JWT;
use Arch\JWT\Token\Algorithm\HS256;
use Arch\JWT\Token\Claim\Subject;
use Arch\JWT\Token\Header;
use Arch\JWT\Token\Payload;
use Arch\JWT\Token\Signature;
use PHPUnit\Framework\TestCase;

class JWTTest extends TestCase {

  public function test() {
    $header = new Header(new HS256('Arch01'));
    $payload = new Payload([
      Subject::$name => 'Arch'
    ]);

    try {
      $jwt = new JWT($header, $payload);


      $this->assertEquals(
        'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJBcmNoIn0.kq-ax6J9QPjDcT9Gx4ZPwP-L-FBY_rnEE5i_2ec2X7o',
        $jwt->getJWT()
      );
    } catch (\Arch\JWT\Exception\AlgorithmNotSupported $e) {
    }
  }

  public function testDecode() {
    try {
      $t = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJBcmNoIn0.kq-ax6J9QPjDcT9Gx4ZPwP-L-FBY_rnEE5i_2ec2X7o';
      $jwt = JWT::decode($t, 'Arch01');

      $header = new Header(new HS256('Arch01'));
      $payload = new Payload([
        Subject::$name => 'Arch'
      ]);

      $signature = new Signature($header, $payload);
      /**
       * @var $alg \Arch\JWT\Encryption\Algorithm\SymmetricInterface
       */
      $alg = $header->getAlgorithm();

      $this->assertEquals($alg->getSecret(), $jwt->getHeader()->getAlgorithm()->getSecret());
      $this->assertEquals($alg->getName(), $jwt->getHeader()->getAlgorithm()->getName());
      $this->assertEquals($alg->getAlgorithm(), $jwt->getHeader()->getAlgorithm()->getAlgorithm());

      $this->assertEquals($payload->getClaim(Subject::$name), $jwt->getPayload()->getClaim(Subject::$name));

      $this->assertCount(count($payload->getClaims()), $jwt->getPayload()->getClaims());

      $this->assertEquals($signature->getRaw(), $jwt->getSignature()->getRaw());
      $this->assertEquals($signature->getEncryptedSignature(), $jwt->getSignature()->getEncryptedSignature());

      JWT::decode('a', '');
    }catch (\Exception $e) {
      if($e instanceof PHPUnit\Framework\ExpectationFailedException) {
        throw $e;
      }

      $this->assertInstanceOf(InvalidJWTException::class, $e);
    }
  }

  public function testInvalidDecode() {
    try {
      JWT::decode('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJBcmNoIiwiZXhwIjoxNTUxNjY5MzgwfQ.j9mXDN0RIJ2UXMmNJdXIZ7G4LlP4hjWGIOrz73h5iK8', 'Arch01');
    }catch (\Exception $e) {
      $this->assertInstanceOf(ExpirationException::class, $e);
    }
  }

  public function testInvalidSignDecode() {
    try {
      JWT::decode('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJBcmNoIn0.kq-ax6J9QPjDcT9Gx4ZPwP-L-FBY_rnEE5i_2ec2X7o', 'Arch');
    }catch (\Exception $e) {
      $this->assertInstanceOf(InvalidJWTException::class, $e);
    }

    try {
      JWT::decode('eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJBcmNoIn0.kq-ax6J9QPjDcT9GxZPwP-L-FBY_rnEE5i_2ec2X7o', 'Arch01');
    }catch (\Exception $e) {
      $this->assertInstanceOf(InvalidJWTException::class, $e);
    }
  }

}
