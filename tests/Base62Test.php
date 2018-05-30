<?php

use Base62\Base62;
use Base62\Drivers\BasicEncoder;
use PHPUnit\Framework\TestCase;

class Base62Test extends TestCase {

    public function setUp() {}

    public function testEncode()
    {
        $base62 = new Base62(new BasicEncoder());
        $this->assertEquals('0', $base62->encode(0));
        $this->assertEquals('g7', $base62->encode(999));
        $this->assertEquals('14', $base62->encode(66));
        // asserts for errors
        // $this->assertFalse($base62->encode(-12));
        // $this->assertFalse($base62->encode('not a number'));
    }

    public function testEncodeWithNegativeNumber()
    {
        $base62 = new Base62(new BasicEncoder());
        $this->expectException(InvalidArgumentException::class);
        $base62->encode(-1);
    }

    public function testWithInvalidString()
    {
        $base62 = new Base62(new BasicEncoder());
        $this->expectException(InvalidArgumentException::class);
        $base62->encode('12asd');
    }

    /*
    public function testEncodeBigInteger() {
        $this->assertEquals('2lkCB1', $base62->encode("2147483647"));
        $this->assertEquals('YYLs9kDZ', $base62->encode("214748364712343"));
    }
    */
    public function testDecode()
    {
        $base62 = new Base62(new BasicEncoder());
        $this->assertEquals(999, $base62->decode('g7'));
        $this->assertEquals(66, $base62->decode('14'));
    }

    public function testDecodeWithNegativeNumber()
    {
        $base62 = new Base62(new BasicEncoder());
        $this->expectException(InvalidArgumentException::class);
        $base62->decode(-1);
    }

    public function testDecodeWithPositiveNumber()
    {
        $base62 = new Base62(new BasicEncoder());
        $this->expectException(InvalidArgumentException::class);
        $base62->decode(123);
    }

    public function testDecodeWithBoolean()
    {
        $base62 = new Base62(new BasicEncoder());
        $this->expectException(InvalidArgumentException::class);
        $base62->decode(false);
    }

    /*
    public function testDecodeBigInteger() {
        $this->assertEquals('2147483647', $base62->decode('2lkCB1'));
        $this->assertEquals('214748364712343', $base62->decode('YYLs9kDZ'));
    }
    */
}
