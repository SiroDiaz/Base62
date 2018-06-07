<?php

use Base62\Base62;
use Base62\Drivers\BcmathEncoder;
use PHPUnit\Framework\TestCase;

class BcmathEncoderTest extends TestCase
{
    private $base62;

    public function setUp()
    {
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

    /**
     * @dataProvider encodeDataProvider
     */
    public function testEncode($expectedString, $number)
    {
        $this->assertEquals($expectedString, $this->base62->encode($number));
    }

    public function testEncodeWithNegativeNumber()
    {
        $base62 = new Base62('bcmath');
        $this->expectException(InvalidArgumentException::class);
        $base62->encode(-1);
    }
    /*
    public function testWithInvalidString()
    {
        $base62 = new Base62('bcmath');
        $this->expectException(InvalidArgumentException::class);
        $base62->encode('12asd');
    }
    */
    /*
    public function testEncodeBigInteger() {
        $this->assertEquals('2lkCB1', $base62->encode("2147483647"));
        $this->assertEquals('YYLs9kDZ', $base62->encode("214748364712343"));
    }
    */
    /*
    public function testDecode()
    {
        $base62 = new Base62('bcmath');
        $this->assertEquals('999', $base62->decode('G7'));
        $this->assertEquals(66, $base62->decode('14'));
    }

    public function testDecodeWithNegativeNumber()
    {
        $base62 = new Base62('bcmath');
        $this->expectException(InvalidArgumentException::class);
        $base62->decode(-1);
    }

    public function testDecodeWithPositiveNumber()
    {
        $base62 = new Base62('bcmath');
        $this->expectException(InvalidArgumentException::class);
        $base62->decode(123);
    }

    public function testDecodeWithBoolean()
    {
        $base62 = new Base62('bcmath');
        $this->expectException(InvalidArgumentException::class);
        $base62->decode(false);
    }
    */
    /*
    public function testDecodeBigInteger() {
        $this->assertEquals('2147483647', $base62->decode('2lkCB1'));
        $this->assertEquals('214748364712343', $base62->decode('YYLs9kDZ'));
    }
    */
}
