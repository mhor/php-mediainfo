<?php

namespace Mhor\MediaInfo\Attribute;

interface AttributeInterface
{
    public static function getMembersFields();

    /**
     * @param mixed $value
     * @return mixed
     */
    public static function create($value);
}
