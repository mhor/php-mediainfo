<?php

namespace Mhor\MediaInfo\Parser;

abstract class AbstractXmlOutputParser implements OutputParserInterface
{
    protected function transformXmlToArray($xmlstring)
    {
        $xml = simplexml_load_string($xmlstring);
        $json = json_encode($xml);
        return json_decode($json, TRUE);
    }
} 