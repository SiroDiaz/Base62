# Base62

[![Build Status](https://travis-ci.org/SiroDiaz/Base62.svg?branch=master)](https://travis-ci.org/SiroDiaz/Base62)

Base62 encoder and decorder also for big numbers. Useful to short database numeric ids in URLs.

## requirements

* requires PHP 5 >= 5.0.0
* Composer
* GMP or BCMath extensions enabled
* phpseclib/phpseclib for big integer manipulation

## Composer

	$ composer install

## Quick Start and Examples

#### Methods

encode and decode

#### Examples

Encoding and decoding litle numbers.

```php
require 'vendor/autoload.php';

use Base62 as B62;

$encodedValue = B62\Base62::encode(200000);	// 'O1Q'
$decodedValue = B62\Base62::decode($encodedValue); // 200000
```

Encoding and decoding big numbers (using Math_BigInteger object).

```php
require 'vendor/autoload.php';

use Base62 as B62;

// unsigned bigint (MySQL) 18446744073709551615
$id = new \Math_BigInteger('18446744073709551615', 10);

// print encoded base62 number id
$encodedValue = B62\Base62::encode($id);	// 'fyha61AhGY1'
$decodedValue = B62\Base62::decode(B62\Base62::encode($id)); // 18446744073709551615
```
