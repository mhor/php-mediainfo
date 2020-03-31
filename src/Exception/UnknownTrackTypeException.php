<?php

namespace Mhor\MediaInfo\Exception;

class UnknownTrackTypeException extends \Exception
{
    /**
     * @var null|string
     */
    private $trackType = null;

    /**
     * @param string $trackType
     * @param int    $code
     */
    public function __construct(string $trackType, $code = 0)
    {
        parent::__construct(sprintf('Type doesn\'t exist: %s', $trackType), $code, null);
        $this->trackType = $trackType;
    }

    /**
     * @return null|string
     */
    public function getTrackType()
    {
        return $this->trackType;
    }
}
