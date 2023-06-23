<?php

namespace Mhor\MediaInfo\Tests;

use Mhor\MediaInfo\Builder\MediaInfoCommandBuilder;
use Mhor\MediaInfo\Configuration\Configuration;
use Mhor\MediaInfo\Container\MediaInfoContainer;
use Mhor\MediaInfo\MediaInfo;
use Mhor\MediaInfo\Parser\MediaInfoOutputParser;
use Mhor\MediaInfo\Runner\MediaInfoCommandRunner;
use PHPUnit\Framework\TestCase;
use Prophecy\Argument;
use Symfony\Component\Process\Process;

class MediaInfoTest extends TestCase
{
    public function testGetInfo(): void
    {
        $config = new Configuration();

        $mediaInfoCommandRunner = $this->prophesize(MediaInfoCommandRunner::class);
        $mediaInfoCommandRunner
            ->run()
            ->shouldBeCalled()
            ->willReturn('MEDIAINFOOUTPUT');

        $mediaInfoCommandParser = $this->prophesize(MediaInfoCommandBuilder::class);
        $mediaInfoCommandParser
            ->buildMediaInfoCommandRunner(Argument::exact('testpath'), Argument::exact(($config)))
            ->shouldBeCalled()
            ->willReturn($mediaInfoCommandRunner->reveal());

        $mediaInfoOutputParser = $this->prophesize(MediaInfoOutputParser::class);

        $parsedOutput = ['MEDIAINFOOUTPUT'];
        $mediaInfoOutputParser
            ->parse(Argument::exact('MEDIAINFOOUTPUT'))
            ->shouldBeCalled()
            ->willReturn($parsedOutput);

        $mediaInfoOutputParser
            //->getMediaInfoContainer(Argument::exact($config), Argument::exact($parsedOutput))
            ->getMediaInfoContainer(Argument::exact($config), Argument::any($parsedOutput))
            ->shouldBeCalled()
            ->willReturn(new MediaInfoContainer());


        $config->setMediaInfoCommandBuilder($mediaInfoCommandParser->reveal());
        $config->setMediaInfoOutputParser($mediaInfoOutputParser->reveal());

        $mediaInfo = new MediaInfo($config);
        $this->assertInstanceOf(MediaInfoContainer::class, $mediaInfo->getInfo('testpath'));
    }

    public function testSetConfig(): void
    {
        $mediaInfo = new MediaInfo();
        $mediaInfo->setConfig('command', 'new/mediainfo/path');

        $mediaInfo = new MediaInfo();
        $this->assertEquals(false, $mediaInfo->getConfig('urlencode'));
        $mediaInfo->setConfig('urlencode', true);
        $this->assertEquals(true, $mediaInfo->getConfig('urlencode'));

        $mediaInfo->setConfig('command', '/custom/path/mediainfo');
        $this->assertEquals('/custom/path/mediainfo', $mediaInfo->getConfig('command'));

        $mediaInfo->setConfig('use_oldxml_mediainfo_output_format', false);
        $this->assertEquals(false, $mediaInfo->getConfig('use_oldxml_mediainfo_output_format'));

        $mediaInfo->setConfig('include_cover_data', true);
        $this->assertEquals(true, $mediaInfo->getConfig('include_cover_data'));

        $mediaInfo->setConfig('ignore_unknown_track_types', true);
        $this->assertEquals(true, $mediaInfo->getConfig('ignore_unknown_track_types'));

        $this->assertNull($mediaInfo->getConfig('attribute_checkers'));
        $mediaInfo->setConfig('attribute_checkers', []);
        $this->assertEquals([], $mediaInfo->getConfig('attribute_checkers'));

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
