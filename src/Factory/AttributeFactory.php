<?php

namespace Mhor\MediaInfo\Factory;

use Mhor\MediaInfo\Checker\AbstractAttributeChecker;
use Mhor\MediaInfo\Checker\AttributeCheckerInterface;
use Mhor\MediaInfo\Checker\CoverChecker;
use Mhor\MediaInfo\Checker\DateTimeChecker;
use Mhor\MediaInfo\Checker\DurationChecker;
use Mhor\MediaInfo\Checker\FloatRateChecker;
use Mhor\MediaInfo\Checker\ModeChecker;
use Mhor\MediaInfo\Checker\RateChecker;
use Mhor\MediaInfo\Checker\RatioChecker;
use Mhor\MediaInfo\Checker\SizeChecker;

class AttributeFactory
{
    /**
     * @var AttributeCheckerInterface[]
     */
    private $attributeCheckers;

    /**
     * @param array|null $attributeCheckers
     */
    public function __construct(array $attributeCheckers = null)
    {
        if (null === $attributeCheckers) {
            $attributeCheckers = $this->getDefaultAttributeCheckers();
        }

        $this->attributeCheckers = $attributeCheckers;
    }

    /**
     * @param $attribute
     * @param $value
     *
     * @return mixed
     */
    public function create($attribute, $value)
    {
        foreach ($this->attributeCheckers as $attributeChecker) {
            if ($attributeChecker->isMember($attribute)) {
                return $attributeChecker->create($value);
            }
        }

        return $value;
    }

    /**
     * @return AbstractAttributeChecker[]
     */
    private function getDefaultAttributeCheckers(): array
    {
        return [
            new CoverChecker(),
            new DurationChecker(),
            new ModeChecker(),
            new RateChecker(),
            new FloatRateChecker(),
            new RatioChecker(),
            new SizeChecker(),
            new DateTimeChecker(),
        ];
    }
}
