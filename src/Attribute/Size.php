<?php

namespace Mhor\MediaInfo\Attribute;

class Size extends AbstractAttribute
{
    /**
     * @var int
     */
    protected $bit;

    /**
     * @param array $sizes
     *
     * @return Size
     */
    public static function create($sizes)
    {
        $size = new Size();
        $size->setBit($sizes[0]);
        return $size;
    }

    /**
     * @param int $bit
     */
    public function setBit($bit)
    {
        $this->bit = $bit;
    }

    /**
     * @return int
     */
    public function getBit()
    {
        return $this->bit;
    }

    /**
     * @return array
     */
    public static function getMembersFields()
    {
        return array(
            'file_size',
            'stream_size',
        );
    }
}
