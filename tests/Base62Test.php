<?php

use Base62\Base62;
use PHPUnit\Framework\TestCase;

class Base62Test extends TestCase
{
    private $base62;

    public function setUp()
    {
        $this->base62 = new Base62('basic');
    }

    public function encodeDataProvider()
    {
        return [
            ['0', 0],
            ['G7', 999],
            ['14', 66],
        ];
    }

    public function decodeDataProvider() {
        return [
            ['0', '0'],
            ['999', 'G7'],
            ['66', '14'],
        ];
    }

    public function encodeBigIntegerDataProvider()
    {
        return [
            ['3MpgfJ1', '214748364787'],
            ['47rhmv5JHMPe', '214748364787898954454'],
        ];
    }

    /**
     * @dataProvider encodeDataProvider
     */
    public function testEncode($expectedString, $decodedString)
    {
        $this->assertEquals($expectedString, $this->base62->encode($decodedString));
    }

    public function testEncodeWithNegativeNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->base62->encode(-1);
    }

    public function testWithInvalidString()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->base62->encode('12asd');
    }

    /**
     * @dataProvider encodeBigIntegerDataProvider
     */
    public function testEncodeBigInteger($expectedString, $decodedString)
    {
        $this->assertNotEquals($expectedString, $this->base62->encode($decodedString));
    }
    
    /**
     * @dataProvider decodeDataProvider
     */
    public function testDecode($expectedString, $decodedString)
    {
        $this->assertEquals($expectedString, $this->base62->decode($decodedString));
    }

    public function testDecodeWithNegativeNumber()
    {
        $base62 = new Base62('basic');
        $this->expectException(InvalidArgumentException::class);
        $base62->decode(-1);
    }

    public function testDecodeWithPositiveNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->base62->decode(123);
    }

    public function testDecodeWithBoolean()
    {
        $base62 = new Base62('basic');
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
