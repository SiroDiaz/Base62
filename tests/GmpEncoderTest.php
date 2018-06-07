<?php

use Base62\Base62;
use Base62\Drivers\GmpEncoder;
use PHPUnit\Framework\TestCase;

class GmpEncoderTest extends TestCase
{
    private $base62;

    public function setUp()
    {
        $this->base62 = new Base62('gmp');
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
            ['2LKcb1', '2147483647'],
            ['yylS9Kdz', '214748364712343'],
        ];
    }

    public function testEncode()
    {
        $this->assertEquals('0', $this->base62->encode(0));
        $this->assertEquals('G7', $this->base62->encode(999));
        $this->assertEquals('14', $this->base62->encode(66));
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
    public function testEncodeBigInteger($expectedString, $number) {
        $this->assertEquals($expectedString, $this->base62->encode($number));
    }
    
    public function testDecode()
    {
        $this->assertEquals('999', $this->base62->decode('G7'));
        $this->assertEquals(66, $this->base62->decode('14'));
    }

    public function testDecodeWithNegativeNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->base62->decode(-1);
    }

    public function testDecodeWithPositiveNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->base62->decode(123);
    }

    public function testDecodeWithBoolean()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->base62->decode(false);
    }

    /*
    public function testDecodeBigInteger() {
        $this->assertEquals('2147483647', $this->base62->decode('2lkCB1'));
        $this->assertEquals('214748364712343', $this->base62->decode('YYLs9kDZ'));
    }
    */
}
