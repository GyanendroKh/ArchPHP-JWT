# ArchPHP-JWT
[![Build Status](https://travis-ci.org/GyanendroKh/ArchPHP-JWT.svg?branch=master)](https://travis-ci.org/GyanendroKh/ArchPHP-JWT)   

This is a simple library for working with Json Web Token in PHP.   
---

### Installing
```
$ composer require archphp-jwt
```

### How to use
```php
<?php

require_once '{path/to/vendor}/autoload.php';

use Arch\JWT\JWT;
use Arch\JWT\Token\Header;
use Arch\JWT\Token\Payload;
use Arch\JWT\Token\Algorithm\HS256;
use Arch\JWT\Token\Claim\Subject;

$alg = new HS256('secret');
$typ = 'JWT';

$header = new Header($alg, $typ);

$payload = new Payload([
  Subject::$name => 'arch',
  'custom_claim' => 'custom_value'
]);

/**
 * @see \Arch\JWT\Token\Claim for all available claims
 */

$jwt = new JWT($header, $payload);

// This is print out the encrypted JWT.
echo $jwt->getJWT();
```

### Decoding a JWT
```php
<?php

use Arch\JWT\JWT;
use Arch\JWT\Exception\InvalidJWTException;
use Arch\JWT\Exception\VerifierException;

$t = 'eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJzdWIiOiJBcmNoIn0.kq-ax6J9QPjDcT9Gx4ZPwP-L-FBY_rnEE5i_2ec2X7o';

// The secret key used in encrypting the JWT.
$secret = 'Arch01';

// This is throw an Exception if the JWT is invalid or claims are not verified.
try {
  $jwt = JWT::decode($t, $secret);
} catch(InvalidJWTException|VerifierException $e) {
  echo $e->getMessage();
}

```
