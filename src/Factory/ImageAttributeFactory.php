<?php


namespace Mhor\MediaInfo\Factory;


class ImageAttributeFactory
{
    public static function create($attribute, $value)
    {
        return GenericAttributeFactory::create($attribute, $value);


    }
} 