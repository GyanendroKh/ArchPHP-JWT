<?php

namespace Arch\JWT\Encryption\Algorithm;

use Arch\JWT\Token\Algorithm\HS256;
use Arch\JWT\Token\Algorithm\None;

/**
 * Class Map
 * @package Arch\JWT\Encryption\Algorithm
 */
class Map {

  public static $HS256 = HS256::class;

  public static $none = None::class;

}
