<?php

namespace Mhor\MediaInfo\Tests\Factory;

use Mhor\MediaInfo\Attribute as Attribute;
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

        $this->assertInstanceOf(Attribute\Ratio::class, $ratio);
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

        $this->assertInstanceOf(Attribute\Rate::class, $rate);
    }

    public function testCreateFloatRate(): void
    {
        $floatRate = AttributeFactory::create(
            'frame_rate',
            [
                '46.875',
                '46.875 FPS (1024 SPF)'
            ]
        );

        $this->assertInstanceOf(Attribute\FloatRate::class, $floatRate);
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

        $this->assertInstanceOf(Attribute\Size::class, $size);
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

        $this->assertInstanceOf(Attribute\Mode::class, $mode);
    }

    public function testCreateDuration(): void
    {
        $duration = AttributeFactory::create(
            'duration',
            [
                '475193',
            ]
        );

        $this->assertInstanceOf(Attribute\Duration::class, $duration);
    }

    public function testCreateCover(): void
    {
        $cover = AttributeFactory::create('cover_data', '01010101');

        $this->assertInstanceOf(Attribute\Cover::class, $cover);
    }
}
