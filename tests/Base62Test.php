<?php

use Base62 as B62;

class Base62Test extends PHPUnit_Framework_TestCase {

	public function setUp() {}

	public function testEncode() {
		$this->assertEquals('01', B62\Base62::encode(62));
		$this->assertEquals('g7', B62\Base62::encode(476));
	}

	public function testDecode() {
		$this->assertEquals('62', B62\Base62::decode('01'));
		$this->assertEquals('476', B62\Base62::decode('g7'));
	}
}
