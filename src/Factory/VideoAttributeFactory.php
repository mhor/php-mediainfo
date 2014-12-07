<?php


namespace Mhor\MediaInfo\Factory;


class VideoAttributeFactory
{
    public static function create($attribute, $value)
    {
        return GenericAttributeFactory::create($attribute, $value);
    }
} 