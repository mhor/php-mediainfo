<?php

namespace Mhor\MediaInfo\Parser;

abstract class AbstractXmlOutputParser implements OutputParserInterface
{
    protected function transformXmlToArray(string $xmlString): array
    {
        if (mb_detect_encoding($xmlString, 'UTF-8', true) === false) {
            $xmlString = utf8_encode($xmlString);
        }

        libxml_use_internal_errors(true);
        $dom = new \DOMDocument('1.0', 'UTF-8');
        $dom->strictErrorChecking = false;
        $dom->validateOnParse = false;
        $dom->recover = true;
        $dom->loadXML($xmlString);
        $xml = simplexml_import_dom($dom);

        libxml_clear_errors();
        libxml_use_internal_errors(false);

        $json = json_encode($xml);

        return json_decode($json, true);
    }
}
