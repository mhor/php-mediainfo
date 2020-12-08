<?php

namespace Mhor\MediaInfo\Tests\Exception;

use Mhor\MediaInfo\Exception\UnknownTrackTypeException;
use PHPUnit\Framework\TestCase;

class UnknownTrackTypeExceptionTest extends TestCase
{
    public function testGetTrackType(): void
    {
        $unknownTrackTypeException = new UnknownTrackTypeException('InvalidType');
        $this->assertEquals($unknownTrackTypeException->getTrackType(), 'InvalidType');
    }
}
