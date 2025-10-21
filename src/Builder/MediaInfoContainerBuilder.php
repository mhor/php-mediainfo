<?php

namespace Mhor\MediaInfo\Builder;

use Mhor\MediaInfo\Container\MediaInfoContainer;
use Mhor\MediaInfo\Factory\AttributeFactory;
use Mhor\MediaInfo\Factory\TypeFactory;
use Mhor\MediaInfo\Type\AbstractType;

class MediaInfoContainerBuilder
{
    private MediaInfoContainer $mediaInfoContainer;

    private TypeFactory $typeFactory;

    private AttributeFactory $attributesFactory;

    public function __construct(?array $attributesCheckers = null)
    {
        $this->mediaInfoContainer = new MediaInfoContainer();
        $this->typeFactory = new TypeFactory();
        $this->attributesFactory = new AttributeFactory($attributesCheckers);
    }

    public function build(): \Mhor\MediaInfo\Container\MediaInfoContainer
    {
        return $this->mediaInfoContainer;
    }

    public function setVersion($version): void
    {
        $this->mediaInfoContainer->setVersion($version);
    }

    /**
     * @throws \Mhor\MediaInfo\Exception\UnknownTrackTypeException
     */
    public function addTrackType($typeName, array $attributes): void
    {
        $trackType = $this->typeFactory->create($typeName);
        $this->addAttributes($trackType, $attributes);

        $this->mediaInfoContainer->add($trackType);
    }

    private function addAttributes(AbstractType $trackType, array $attributes): void
    {
        foreach ($this->sanitizeAttributes($attributes) as $attribute => $value) {
            if ($attribute[0] === '@') {
                continue;
            }

            $trackType->set(
                $attribute,
                $this->attributesFactory->create($attribute, $value)
            );
        }
    }

    private function sanitizeAttributes(array $attributes): array
    {
        $sanitizeAttributes = [];
        foreach ($attributes as $key => $value) {
            $key = $this->formatAttribute($key);
            if (isset($sanitizeAttributes[$key])) {
                if (!is_array($sanitizeAttributes[$key])) {
                    $sanitizeAttributes[$key] = [$sanitizeAttributes[$key]];
                }

                if (!is_array($value)) {
                    $value = [$value];
                }

                $value = $sanitizeAttributes[$key] + $value;
            }

            $sanitizeAttributes[$key] = $value;
        }

        return $sanitizeAttributes;
    }

    private function formatAttribute(string $attribute): string
    {
        return trim(str_replace('__', '_', str_replace(' ', '_', strtolower($attribute))), '_');
    }
}
