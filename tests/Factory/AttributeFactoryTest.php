<?php

namespace Mhor\MediaInfo\Tests\Factory;

use Mhor\MediaInfo\Factory\AttributeFactory;
use PHPUnit\Framework\TestCase;

class AttributeFactoryTest extends TestCase
{
    public function testCreateRatio(): void
    {
        $ratio = AttributeFactory::create(
            'display_aspect_ratio',
            [
                '15.55',
                '15.55 Mo',
            ]
        );

        $this->assertEquals('Mhor\MediaInfo\Attribute\Ratio', get_class($ratio));
    }

    public function testCreateRate(): void
    {
        $rate = AttributeFactory::create(
            'height',
            [
                '720',
                '720p',
            ]
        );

        $this->assertEquals('Mhor\MediaInfo\Attribute\Rate', get_class($rate));
    }

    public function testCreateSize(): void
    {
        $size = AttributeFactory::create(
            'file_size',
            [
                '19316079',
                '18.4 MiB',
            ]
        );

        $this->assertEquals('Mhor\MediaInfo\Attribute\Size', get_class($size));
    }

    public function testCreateMode(): void
    {
        $mode = AttributeFactory::create(
            'overall_bit_rate',
            [
                'CBR',
                'Constant',
            ]
        );

        $this->assertEquals('Mhor\MediaInfo\Attribute\Mode', get_class($mode));
    }

    public function testCreateDuration(): void
    {
        $duration = AttributeFactory::create(
            'duration',
            [
                '475193',
            ]
        );

        $this->assertEquals('Mhor\MediaInfo\Attribute\Duration', get_class($duration));
    }

    public function testCreateCover(): void
    {
        $cover = AttributeFactory::create('cover_data', '01010101');

        $this->assertEquals('Mhor\MediaInfo\Attribute\Cover', get_class($cover));
    }
}
