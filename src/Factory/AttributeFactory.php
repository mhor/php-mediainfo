<?php

namespace Mhor\MediaInfo\Factory;

use Mhor\MediaInfo\Attribute\AbstractAttribute;
use Mhor\MediaInfo\Attribute\Cover;
use Mhor\MediaInfo\Attribute\DateTime;
use Mhor\MediaInfo\Attribute\Duration;
use Mhor\MediaInfo\Attribute\Mode;
use Mhor\MediaInfo\Attribute\Rate;
use Mhor\MediaInfo\Attribute\Size;
use Mhor\MediaInfo\Checker\AbstractAttributeChecker;
use Mhor\MediaInfo\Checker\CoverChecker;
use Mhor\MediaInfo\Checker\DateTimeChecker;
use Mhor\MediaInfo\Checker\DurationChecker;
use Mhor\MediaInfo\Checker\ModeChecker;
use Mhor\MediaInfo\Checker\RateChecker;
use Mhor\MediaInfo\Checker\SizeChecker;
use Mhor\MediaInfo\Container\MediaInfoContainer;

class AttributeFactory
{
    /**
     * @param $attribute
     * @param $value
     * @return mixed
     */
    public static function create($attribute, $value)
    {
        $attributesType = self::getAllAttributeType();
        foreach ($attributesType as $attributeType) {
            if ($attributeType->isMember($attribute)) {
                return $attributeType->create($value);
            }
        }

        return $value;
    }

    /**
     * @return AbstractAttributeChecker[]
     */
    private static function getAllAttributeType()
    {
        return array(
            new CoverChecker(),
            new DurationChecker(),
            new ModeChecker(),
            new RateChecker(),
            new SizeChecker(),
            new DateTimeChecker(),
        );
    }
}
