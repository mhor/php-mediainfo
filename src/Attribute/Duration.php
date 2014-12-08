<?php

namespace Mhor\MediaInfo\Attribute;

class Duration
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
     * @return mixed
     */
    public function getMilliseconds()
    {
        return $this->milliseconds;
    }
} 