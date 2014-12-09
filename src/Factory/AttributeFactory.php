<?php

namespace Mhor\MediaInfo\Factory;

use Mhor\MediaInfo\Attribute\AbstractAttribute;
use Mhor\MediaInfo\Type\MediaInfoContainer;

class AttributeFactory
{
    /**
     * @param $attributeTypeClass
     * @param $attribute
     * @param $value
     * @return \DateTime|AbstractAttribute
     * @throws \Exception
     */
    public static function create($attributeTypeClass, $attribute, $value)
    {
        switch ($attributeTypeClass) {
            case MediaInfoContainer::VIDEO_CLASS:
                return VideoAttributeFactory::create($attribute, $value);
            case MediaInfoContainer::AUDIO_CLASS:
                return AudioAttributeFactory::create($attribute, $value);
            case MediaInfoContainer::IMAGE_CLASS:
                return ImageAttributeFactory::create($attribute, $value);
                break;
            case MediaInfoContainer::GENERAL_CLASS:
                return GeneralAttributeFactory::create($attribute, $value);
            default:
                throw new \Exception('Type doesn\'t exist');
        }
    }
} 