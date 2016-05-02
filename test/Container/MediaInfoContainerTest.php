<?php

use Mhor\MediaInfo\Container\MediaInfoContainer,
    Mhor\MediaInfo\Type\General,
    Mhor\MediaInfo\Type\Audio;

class MediaInfoContainerTest extends \PHPUnit_Framework_TestCase
{
    private function createContainer()
    {
        $mediaInfoContainer = new MediaInfoContainer();
        
        $general = new General();
        
        $general->set('Format', 'MPEG Audio');
        $general->set('Duration', '1mn 20s');
        
        $audio = new Audio();
        
        $audio->set('Format', 'MPEG Audio');
        $audio->set('Bit rate', '56.0 Kbps');
        
        $mediaInfoContainer->add($audio);
        $mediaInfoContainer->add($general);
        
        return $mediaInfoContainer;
    }
    
    public function testToJson()
    {
        $mediaInfoContainer = $this->createContainer();
        
        $data = json_encode($mediaInfoContainer);
        
        $this->assertRegExp('/^\{.+\}$/', $data);
    }
    
    public function testToJsonType()
    {
        $mediaInfoContainer = $this->createContainer();
        
        $data = json_encode($mediaInfoContainer->getGeneral());
        
        $this->assertRegExp('/^\{.+\}$/', $data);
    }
    
    public function testToArray()
    {
        $mediaInfoContainer = $this->createContainer();
        
        $array = $mediaInfoContainer->__toArray();
        
        $this->assertArrayHasKey('version', $array);
    }
    
    public function testToArrayType()
    {
        $mediaInfoContainer = $this->createContainer();
        
        $array = $mediaInfoContainer->getGeneral()->__toArray();
        
        $this->assertTrue(is_array($array));
    }
}