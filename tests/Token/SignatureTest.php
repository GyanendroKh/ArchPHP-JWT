<?php

use Arch\JWT\Exception\AlgorithmNotSupported;
use Arch\JWT\Token\Algorithm\HS256;
use Arch\JWT\Token\Claim\Subject;
use Arch\JWT\Token\Header;
use Arch\JWT\Token\Payload;
use Arch\JWT\Token\Signature;
use PHPUnit\Framework\TestCase;

class SignatureTest extends TestCase {

  public function test() {
    $e  = 'NgIL9TzUAuT5KSd3Q5kJqHlOWUg4mtTsmYNeiWoEUe8';
    $header = new Header(new HS256('Arch'));
    $payload = new Payload();
    $payload->addClaim(Subject::$name, 'Arch');
    try {
      $signature = new Signature($header, $payload);
      $this->assertEquals($e, $signature->getEncryptedSignature());
    }catch (AlgorithmNotSupported $e) {
      echo $e->getMessage();
    }
  }

}
