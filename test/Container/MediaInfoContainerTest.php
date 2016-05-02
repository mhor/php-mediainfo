<?php

use Mhor\MediaInfo\MediaInfo;

class MediaInfoContainerTest extends \PHPUnit_Framework_TestCase
{
    public function testToJson()
    {
        $mediaInfo = new MediaInfo();
        $mediaInfoContainer = $mediaInfo->getInfo('test/fixtures/test.mp3');
        
        $data = json_encode($mediaInfoContainer);
        
        $this->assertRegExp('/^\{.+\}$/', $data);
    }
    
    public function testToJsonType()
    {
        $mediaInfo = new MediaInfo();
        $mediaInfoContainer = $mediaInfo->getInfo('test/fixtures/test.mp3');
        
        $data = json_encode($mediaInfoContainer->getGeneral());
        
        $this->assertRegExp('/^\{.+\}$/', $data);
    }
    
    public function testToArray()
    {
        $mediaInfo = new MediaInfo();
        $mediaInfoContainer = $mediaInfo->getInfo('test/fixtures/test.mp3');
        
        $array = $mediaInfoContainer->__toArray();
        
        $this->assertArrayHasKey('version', $array);
    }
    
    public function testToArrayType()
    {
        $mediaInfo = new MediaInfo();
        $mediaInfoContainer = $mediaInfo->getInfo('test/fixtures/test.mp3');
        
        $array = $mediaInfoContainer->getGeneral()->__toArray();
        
        $this->assertTrue(is_array($array));
    }
}