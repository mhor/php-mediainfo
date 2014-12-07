<?php


namespace Mhor\MediaInfo\Factory;

class GenericAttributeFactory
{
    public static function create($attribute, $value)
    {
        switch ($attribute) {
            default:
                return $value;
                break;
        }
    }
} 