<?php

use Base62\Base62;

class Base62Test extends PHPUnit_Framework_TestCase {

	public function setUp() {}

	public function testEncode() {
		$this->assertEquals('0', Base62::encode(0));
		$this->assertEquals('g7', Base62::encode(999));
		$this->assertEquals('14', Base62::encode(66));
	}

	public function testEncodeBigInteger() {
		$this->assertEquals('2lkCB1', Base62::encode("2147483647"));
		$this->assertEquals('YYLs9kDZ', Base62::encode("214748364712343"));
	}

	public function testDecode() {
		$this->assertEquals(999, Base62::decode('g7'));
		$this->assertEquals(66, Base62::decode('14'));
	}

	public function testDecodeBigInteger() {
		$this->assertEquals('2147483647', Base62::decode('2lkCB1'));
		$this->assertEquals('214748364712343', Base62::decode('YYLs9kDZ'));
	}
}