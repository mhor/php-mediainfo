<?php

namespace Mhor\MediaInfo\Exception;

class MediainfoOutputParsingException extends \Exception
{
    public function __construct($message)
    {
        parent::__construct($message);
    }
}
