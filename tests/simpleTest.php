<?php

require dirname(__FILE__) .'/../lib/Base62.php';

class simpleTest extends \PHPUnit_Framework_TestCase {

	public function setUp() {}

	public function testEncode() {
		$converted = Base62::encode(62);
		$this->assertEquals('01', $converted);
	}

	public function testDecode() {
		$reversed = Base62::decode('01');
		$this->assertEquals('62', $reversed);
	}

}