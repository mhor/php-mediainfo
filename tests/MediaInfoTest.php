<?php

namespace Mhor\MediaInfo\Tests;

use Mhor\MediaInfo\MediaInfo;
use PHPUnit\Framework\TestCase;

class MediaInfoTest extends TestCase
{
    public function testSetConfig(): void
    {
        $mediaInfo = new MediaInfo();
        $mediaInfo->setConfig('command', 'new/mediainfo/path');

        $mediaInfo = new MediaInfo();
        $this->assertEquals(false, $mediaInfo->getConfig('urlencode'));
        $mediaInfo->setConfig('urlencode', true);
        $this->assertEquals(true, $mediaInfo->getConfig('urlencode'));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('key "unknow_config" does\'t exist');

        $mediaInfo = new MediaInfo();
        $mediaInfo->setConfig('unknow_config', '');
    }

    public function testGetConfig(): void
    {
        $mediaInfo = new MediaInfo();
        $this->assertEquals(false, $mediaInfo->getConfig('urlencode'));

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('key "unknow_config" does\'t exist');

        $mediaInfo = new MediaInfo();
        $mediaInfo->getConfig('unknow_config');
    }
}
