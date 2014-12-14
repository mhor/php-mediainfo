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
     * @return Duration
     */
    public static function create($durations)
    {
        $duration = new Duration();
        $duration->setMilliseconds($durations[0]);
        return $duration;
    }

    /**
     * @param int $milliseconds
     */
    public function setMilliseconds($milliseconds)
    {
        $this->milliseconds = $milliseconds;
    }

    /**
     * @return int
     */
    public function getMilliseconds()
    {
        return $this->milliseconds;
    }

    /**
     * @return array
     */
    public static function getMembersFields()
    {
        return array('duration');
    }
}
