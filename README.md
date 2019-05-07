# Base62

[![Build Status](https://travis-ci.org/SiroDiaz/Base62.svg?branch=develop)](https://travis-ci.org/SiroDiaz/Base62)
[![paypal](https://www.paypalobjects.com/en_US/i/btn/btn_donateCC_LG.gif)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=3XKLA6VTYVSKW&source=url)

Base62 encoder and decorder also for big numbers. Useful to short database numeric ids in URLs.

## requirements

* requires PHP >= 7.0.0 or higher
* Composer
* GMP (preferred) or BCMath extensions enabled.

## Composer

	$ composer require base62/base62

## Laravel 5

You just need to follow the composer command listed before and then you have to publish the base62.php config file into
the config path of Laravel with the following command:

	$ php artisan vendor:publish --tag=base62/base62

Then you can change in `config/base62.php` the default driver that is 'basic' (the PHP encoder implementation) for another supported
by your host. It is recomended to use GMP extension because it is the most fast solution.
Allowed encoders and decoders drivers are:
- basic
- gmp
- bcmath

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

$base62 = new Base62();		// by default use 'basic' driver. It is the default PHP encoder and decoder
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
