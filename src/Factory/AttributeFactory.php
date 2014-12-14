<?php

namespace Mhor\MediaInfo\Factory;

use Mhor\MediaInfo\Attribute\AbstractAttribute;
use Mhor\MediaInfo\Attribute\Cover;
use Mhor\MediaInfo\Attribute\DateTime;
use Mhor\MediaInfo\Attribute\Duration;
use Mhor\MediaInfo\Attribute\Mode;
use Mhor\MediaInfo\Attribute\Rate;
use Mhor\MediaInfo\Attribute\Size;
use Mhor\MediaInfo\Container\MediaInfoContainer;

class AttributeFactory
{
    /**
     * @param $attribute
     * @param $value
     * @return AbstractAttribute
     */
    public static function create($attribute, $value)
    {
        $attributesType = self::getAllAttributeType();
        foreach($attributesType as $attributeType) {
            if ($attributeType->isMember($attribute)) {
                return $attributeType::create($value);
            }
        }

        return $value;
    }

    /**
     * @return AbstractAttribute[]
     */
    private static function getAllAttributeType()
    {
        return array(
            new Cover(),
            new Duration(),
            new Mode(),
            new Rate(),
            new Size(),
            new DateTime(),
        );
    }
}
