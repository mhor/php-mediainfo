<?php

namespace Mhor\MediaInfo\Attribute;

class Mode extends AbstractAttribute
{
    /**
     * @var string
     */
    private $shortName;

    /**
     * @var string
     */
    private $fullName;

    public function __construct(array $rateMode)
    {
        $this->shortName = $rateMode[0];
        $this->fullName = $rateMode[1];
    }

    /**
     * @return string
     */
    public function getFullName()
    {
        return $this->fullName;
    }

    /**
     * @return string
     */
    public function getShortName()
    {
        return $this->shortName;
    }
} 