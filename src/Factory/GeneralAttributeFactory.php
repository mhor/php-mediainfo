<?php

namespace Mhor\MediaInfo\Factory;

class GeneralAttributeFactory
{
    public static function create($attribute, $value)
    {
        return GenericAttributeFactory::create($attribute, $value);
    }
} 