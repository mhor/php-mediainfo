<?php

namespace Mhor\MediaInfo\Attribute;

class Rate extends AbstractAttribute
{
    /**
     * @var int
     */
    private $absoluteValue;

    /**
     * @var string
     */
    private $textValue;

    /**
     * @param array $value
     *
     * @return Rate
     */
    public static function create($value)
    {
        $rate = new Rate();
        $rate->setAbsoluteValue($value[0]);
        $rate->setTextValue($value[1]);
        return $rate;
    }

    /**
     * @return int
     */
    public function getAbsoluteValue()
    {
        return $this->absoluteValue;
    }

    /**
     * @param int $absoluteValue
     */
    public function setAbsoluteValue($absoluteValue)
    {
        $this->absoluteValue = $absoluteValue;
    }

    /**
     * @return string
     */
    public function getTextValue()
    {
        return $this->textValue;
    }

    /**
     * @param string $textValue
     */
    public function setTextValue($textValue)
    {
        $this->textValue = $textValue;
    }

    /**
     * @return array
     */
    public static function getMembersFields()
    {
        return array(
            'channel_s_',
            'bit_rate',
            'sampling_rate',
        );
    }
}
