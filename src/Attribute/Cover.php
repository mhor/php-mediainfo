<?php

namespace Mhor\MediaInfo\Attribute;

class Cover extends AbstractAttribute
{
    /**
     * @var string
     */
    private $binaryCover;

    /**
     * @param string $value
     * @return Cover
     */
    public static function create($value)
    {
        $cover = new Cover();
        $cover->setBinaryCover($value);
        return $cover;
    }

    /**
     * @param string $value
     */
    public function setBinaryCover($value)
    {
        $this->binaryCover = $value;
    }

    /**
     * @return string
     */
    public function getBinaryCover()
    {
        return $this->binaryCover;
    }

    /**
     * @return array
     */
    public static function getMembersFields()
    {
        return array('cover_data');
    }
}
