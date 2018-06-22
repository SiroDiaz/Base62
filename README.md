# Base62

[![Build Status](https://travis-ci.org/SiroDiaz/Base62.svg?branch=develop)](https://travis-ci.org/SiroDiaz/Base62)

Base62 encoder and decorder also for big numbers. Useful to short database numeric ids in URLs.

## requirements

* requires PHP >= 5.6 or higher
* Composer
* GMP (preferred) or BCMath extensions enabled.

If you want to use Base62 library with Laravel you must have Laravel 5.1 because the minimum supported PHP version is 5.6.x.

## Composer

	$ composer require "base62/base62":"3.0.0"

## Quick Start and Examples

#### Methods

encode and decode

#### Encoders/Decoders drivers

- basic
- gmp
- bcmath

#### Examples

Encoding and decoding litle numbers.

```php
require 'vendor/autoload.php';

use Base62\Base62;

$base62 = new Base62('basic');		// 'basic' means default PHP encoder and decoder
$encodedValue = $base62->encode(200000);	// 'Q1O'
$decodedValue = $base62->decode($encodedValue); // 200000
```

Encoding and decoding big numbers. An important thing you must take in count: your PHP can be 32 or 64 bit,
this means that a representation of an integer can take a maximum or 32 or 64 bit. This is a important limitation
when you work with big integers, but for solve this problem we have GMP and BCMath native extensions for PHP.


```php
require 'vendor/autoload.php';

use Base62\Base62;

// unsigned bigint (MySQL) 18446744073709551615
$id = '214748364787898954454';

$base62 = new Base62('gmp');
// print encoded base62 number id
$encodedValue = $base62->encode($id);	// '47rhmv5JHMPe'
$decodedValue = $base62->decode($base62->encode($id)); // '214748364787898954454'
```

Note that encode method uses strings as argument and not an integer. This is the best option by a simple reason.
Imagine that you uses an integer that can not been represented by native PHP 32 or 64 bit interpreter, what would happen?
Simple, the integer is truncated and can take negative values or a different positive number.

## License

[MIT License](https://opensource.org/licenses/MIT) Copyright © 2014-present, Siro Díaz Palazón
