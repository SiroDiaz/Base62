<?php

namespace Base62\Tests;

use Base62\Base62;
use Base62\Drivers\BcmathEncoder;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

class BcmathEncoderTest extends TestCase
{
    private $base62;

    protected function setUp()
    {
        parent::setUp();
        $this->base62 = new Base62('bcmath');
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
            ['47rhmv5JHMPe', '214748364787898954454'],
        ];
    }

    /**
     *
     * @dataProvider encodeDataProvider
     */
    public function testEncode($expectedString, $number)
    {
        $this->assertEquals($expectedString, $this->base62->encode($number));
    }

    public function testEncodeWithNegativeNumber()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->base62->encode(-1);
    }

    public function testDecodeWithBoolean()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->base62->decode(false);
    }

    public function testWithInvalidString()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->base62->encode('12asd');
    }
    
    /**
     *
     * @dataProvider encodeBigIntegerDataProvider
     */
    public function testEncodeBigInteger($expectedString, $number) {
        $this->assertEquals($expectedString, $this->base62->encode($number));
    }
    
    /**
     *
     * @dataProvider encodeBigIntegerDataProvider
     */
    public function testDecodeBigInteger($encodedString, $decodedString) {
        $this->assertEquals($decodedString, $this->base62->decode($encodedString));
    }
}
