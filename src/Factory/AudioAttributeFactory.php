<?php


namespace Mhor\MediaInfo\Factory;


class AudioAttributeFactory
{
    public static function create($attribute, $value)
    {
        return GenericAttributeFactory::create($attribute, $value);

    }
} 