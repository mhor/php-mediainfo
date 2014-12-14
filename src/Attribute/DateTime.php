<?php

namespace Mhor\MediaInfo\Attribute;

class DateTime extends AbstractAttribute
{

    /**
     * @param string $value
     * @return \DateTime
     */
    public static function create($value)
    {
        return new \DateTime($value);
    }

    /**
     * @return array
     */
    public static function getMembersFields()
    {
        return array(
            'file_last_modification_date',
            'file_last_modification_date__local_'
        );
    }
}
