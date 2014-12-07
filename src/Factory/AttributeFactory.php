<?php

namespace Mhor\MediaInfo\Factory;

use Mhor\MediaInfo\Type\MediaInfoContainer;

class AttributeFactory
{
    public static function create($attributeTypeClass, $attribute, $value)
    {
        switch ($attributeTypeClass) {
            case MediaInfoContainer::VIDEO_CLASS:
                return VideoAttributeFactory::create($attribute, $value);
                break;
            case MediaInfoContainer::AUDIO_CLASS:
                return AudioAttributeFactory::create($attribute, $value);
                break;
            case MediaInfoContainer::IMAGE_CLASS:
                return ImageAttributeFactory::create($attribute, $value);
                break;
            case MediaInfoContainer::GENERAL_CLASS:
                return GeneralAttributeFactory::create($attribute, $value);
                break;
            default:
                throw new \Exception('Type doesn\'t exist');
                break;
        }
    }
} 