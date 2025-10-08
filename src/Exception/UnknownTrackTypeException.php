<?php

namespace Mhor\MediaInfo\Exception;

class UnknownTrackTypeException extends \Exception
{
    private string $trackType;

    public function __construct(string $trackType, $code = 0)
    {
        parent::__construct(sprintf('Type doesn\'t exist: %s', $trackType), $code, null);
        $this->trackType = $trackType;
    }

    public function getTrackType(): string
    {
        return $this->trackType;
    }
}
