<?php

namespace Mhor\MediaInfo\Exception;

class MediainfoOutputParsingException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
