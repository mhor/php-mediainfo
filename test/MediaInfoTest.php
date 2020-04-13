<?php

namespace Mhor\MediaInfo\Test;

use Mhor\MediaInfo\MediaInfo;
use PHPUnit\Framework\TestCase;

class MediaInfoTest extends TestCase
{
    public function testSetConfig(): void
    {
        $mediaInfo = new MediaInfo();
        $mediaInfo->setConfig('command', 'new/mediainfo/path');

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('key "unknow_config" does\'t exist');

        $mediaInfo = new MediaInfo();
        $mediaInfo->setConfig('unknow_config', '');
    }
}
