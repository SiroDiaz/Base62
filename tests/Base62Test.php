<?php

namespace Base62\Tests;

use Base62\Base62;
use PHPUnit\Framework\TestCase;

class Base62Test extends TestCase {

	public function setUp() {}

	public function encodeDataProvider() {
		return [
			['0', 0],
			['g7', 999],
			['14', 66],
		];
	}

	/**
	 * @dataProvider encodeDataProvider
	 */
	public function testEncode($expectedString, $number) {
		$this->assertEquals($expectedString, Base62::encode($number));
	}

	public function invalidEncodedValueDataProvider() {
		return [
			[-12],
			['not a number'],
		];
	}

	/**
	 * @dataProvider invalidEncodedValueDataProvider
	 */
	public function testEncodeWithInvalidValue($invalidValue) {
		$this->assertFalse(Base62::encode($invalidValue));
	}

	public function encodeBigIntegerDataProvider() {
		return [
			['2lkCB1', '2147483647'],
			['YYLs9kDZ', '214748364712343'],
		];
	}

	/**
	 * @dataProvider encodeBigIntegerDataProvider
	 */
	public function testEncodeBigInteger($expectedString, $decodedString) {
		$this->assertEquals($expectedString, Base62::encode($decodedString));
	}

	public function decodeDataProvider() {
		return [
			[999, 'g7'],
			[66, '14'],
		];
	}

	/**
	 * @dataProvider decodeDataProvider
	 */
	public function testDecode($expectedNumber, $encodedString) {
		$this->assertEquals($expectedNumber, Base62::decode($encodedString));
	}

	public function invalidDecodedValueDataProvider() {
		return [
			[123],
			[false],
			[[]],
		];
	}

	/**
	 * @dataProvider invalidDecodedValueDataProvider
	 */
	public function testDecodeWithInvalidValue($invalidValue) {
		$this->assertFalse(Base62::decode($invalidValue));
	}

	public function decodeBigIntegerDataProvider() {
		return [
			['2147483647', '2lkCB1'],
			['214748364712343', 'YYLs9kDZ'],
		];
	}

	/**
	 * @dataProvider decodeBigIntegerDataProvider
	 */
	public function testDecodeBigInteger($expectedString, $encodedString) {
		$this->assertEquals($expectedString, Base62::decode($encodedString));
	}
}
