<?php

use Arch\JWT\Exception\ExpirationException;
use Arch\JWT\Exception\NotBeforeException;
use Arch\JWT\Exception\VerifierException;
use Arch\JWT\Token\Claim\Expiration;
use Arch\JWT\Token\Claim\NotBefore;
use Arch\JWT\Token\Claim\Subject;
use Arch\JWT\Token\Payload;
use PHPUnit\Framework\TestCase;

class PayloadTest extends TestCase {

  public function test() {
    $payload = new Payload([
      NotBefore::$name => time() - 10,
      Subject::$name => 'Arch'
    ]);

    $this->assertTrue($payload->isClaimExist(Subject::$name));
    $this->assertEquals('Arch', $payload->getClaim(Subject::$name));

    $exp = time() + 100 . '';
    $payload->addClaim(Expiration::$name, $exp);
    $this->assertTrue($payload->isClaimExist(Expiration::$name));
    $this->assertEquals($exp, $payload->getClaim(Expiration::$name));

    $this->assertCount(3, $payload->getClaims());

    $payload->deleteClaim(NotBefore::$name);
    $this->assertCount(2, $payload->getClaims());

    $this->assertEquals(json_encode([
      Subject::$name => 'Arch',
      Expiration::$name => $exp
    ]), $payload->toJSON());
  }

  public function testNotBefore() {
    $payload = new Payload();

    try {
      $payload->addClaim(NotBefore::$name, time() - 10);
      $payload->verify();
      $payload->addClaim(NotBefore::$name, time() + 10);
      $payload->verify();
    } catch (VerifierException $e) {
      $this->assertInstanceOf(NotBeforeException::class, $e);
    }
  }

  public function testExpiration() {
    $payload = new Payload();

    try {
      $payload->addClaim(Expiration::$name, time() + 10);
      $payload->verify();
      $payload->addClaim(Expiration::$name, time() - 10);
      $payload->verify();
    }catch(VerifierException $e) {
      $this->assertInstanceOf(ExpirationException::class, $e);
    }
  }

}
