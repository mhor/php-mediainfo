<?php

namespace Mhor\MediaInfo\Attribute;

class Duration extends AbstractAttribute
{
    /**
     * @var int
     */
    private $milliseconds;

    /**
     * @param array $durations
     */
    public function __construct(array $durations)
    {
        $this->milliseconds = $durations[0];
    }

    /**
     * @return int
     */
    public function getMilliseconds()
    {
        return $this->milliseconds;
    }
} 