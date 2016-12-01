<?php

use Base62 as B62;

class Base62Test extends PHPUnit_Framework_TestCase {

	public function setUp() {}

	public function testEncode() {
		$converted = B62\Base62::encode(62);
		$this->assertEquals('01', $converted);
	}

	public function testDecode() {
		$reversed = B62\Base62::decode('01');
		$this->assertEquals('62', $reversed);
	}
}
