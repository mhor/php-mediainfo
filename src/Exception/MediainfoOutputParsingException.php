<?php

namespace Mhor\MediaInfo\Exception;

class MediainfoOutputParsingException extends \Exception
{
    /**
     * @param string $message
     */
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}
