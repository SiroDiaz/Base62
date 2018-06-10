# Base62

[![Build Status](https://travis-ci.org/SiroDiaz/Base62.svg?branch=develop)](https://travis-ci.org/SiroDiaz/Base62)

Base62 encoder and decorder also for big numbers. Useful to short database numeric ids in URLs.

## requirements

* requires PHP >= 5.6 or HHVM
* Composer
* GMP or BCMath extensions enabled(optional but enabled better performance)

## Composer

	$ composer require "base62/base62":"dev-master"

## Quick Start and Examples

#### Methods

encode and decode

#### Examples

Encoding and decoding litle numbers.

```php
require 'vendor/autoload.php';

use Base62\Base62;

$encodedValue = Base62::encode(200000);	// 'Q1O'
$decodedValue = Base62::decode($encodedValue); // 200000
```

Encoding and decoding big numbers.

```php
require 'vendor/autoload.php';

use Base62\Base62;

// unsigned bigint (MySQL) 18446744073709551615
$id = '18446744073709551615';

// print encoded base62 number id
$encodedValue = Base62::encode($id);	// 'lYGhA16ahyf'
$decodedValue = Base62::decode(Base62::encode($id)); // 18446744073709551615
```
