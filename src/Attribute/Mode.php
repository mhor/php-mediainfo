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

    /**
     * @param mixed $rateMode
     * @return Mode
     */
    public static function create($rateMode)
    {
        $mode = new Mode();
        $mode->setShortName($rateMode[0]);
        $mode->setFullName($rateMode[1]);
        return $mode;
    }

    /**
     * @param string $fullName
     */
    public function setFullName($fullName)
    {
        $this->fullName = $fullName;
    }

    /**
     * @param string $shortName
     */
    public function setShortName($shortName)
    {
        $this->shortName = $shortName;
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

    /**
     * @return array
     */
    public static function getMembersFields()
    {
        return array(
            'overall_bit_rate_mode',
            'overall_bit_rate',
            'bit_rate_mode',
            'compression_mode',
            'codec',
            'format',
            'kind_of_stream',
            'writing_library',
        );
    }
}
