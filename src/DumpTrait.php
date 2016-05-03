<?php
namespace Mhor\MediaInfo;

trait DumpTrait
{
    /**
     * Convert the object into json
     *
     * @return array
     */
    public function jsonSerialize()
    {
        $array = get_object_vars($this);
        
        if (isset($array['attributes'])) {
            $array = $array['attributes'];
        }
        
        return $array;
    }
    
    /**
     * Dump object to array
     *
     * @return array
     */
    public function __toArray()
    {
        return $this->jsonSerialize();
    }
    
    public function __toXML()
    {
        $components = explode('\\', get_class($this));
        $rootNode = end($components);
        $xml = new \SimpleXMLElement("<?xml version=\"1.0\"?><$rootNode></$rootNode>");
        $array = json_decode(json_encode($this), TRUE);
        
        $this->ComposeXML($array, $xml);
        
        return $xml;
    }
    
    protected function ComposeXML( $data, &$xml )
    {
        foreach( $data as $key => $value ) {
            if( is_array($value) ) {
                if( is_numeric($key) ){
                    $key = 'item'.$key;
                }
                $subnode = $xml->addChild($key);
                $this->ComposeXML($value, $subnode);
            } else {
                $xml->addChild("$key",htmlspecialchars("$value"));
            }
        }
    }
}