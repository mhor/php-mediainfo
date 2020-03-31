<?php

namespace Mhor\MediaInfo\Builder;

use Mhor\MediaInfo\Container\MediaInfoContainer;
use Mhor\MediaInfo\Factory\AttributeFactory;
use Mhor\MediaInfo\Factory\TypeFactory;
use Mhor\MediaInfo\Type\AbstractType;

class MediaInfoContainerBuilder
{
    /**
     * @var MediaInfoContainer
     */
    private $mediaInfoContainer;

    /**
     * @var TypeFactory
     */
    private $typeFactory;

    public function __construct()
    {
        $this->mediaInfoContainer = new MediaInfoContainer();
        $this->typeFactory = new TypeFactory();
    }

    /**
     * @return MediaInfoContainer
     */
    public function build(): \Mhor\MediaInfo\Container\MediaInfoContainer
    {
        return $this->mediaInfoContainer;
    }

    /**
     * @param string $version
     */
    public function setVersion($version): void
    {
        $this->mediaInfoContainer->setVersion($version);
    }

    /**
     * @param $typeName
     * @param array $attributes
     *
     * @throws \Mhor\MediaInfo\Exception\UnknownTrackTypeException
     */
    public function addTrackType($typeName, array $attributes): void
    {
        $trackType = $this->typeFactory->create($typeName);
        $this->addAttributes($trackType, $attributes);

        $this->mediaInfoContainer->add($trackType);
    }

    /**
     * @param AbstractType $trackType
     * @param array        $attributes
     */
    private function addAttributes(AbstractType $trackType, array $attributes): void
    {
        foreach ($this->sanitizeAttributes($attributes) as $attribute => $value) {
            if ($attribute[0] === '@') {
                continue;
            }

            $trackType->set(
                $attribute,
                AttributeFactory::create($attribute, $value)
            );
        }
    }

    /**
     * @param array $attributes
     *
     * @return array
     */
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

    /**
     * @param string $attribute
     *
     * @return string
     */
    private function formatAttribute(string $attribute): string
    {
        return trim(str_replace('__', '_', str_replace(' ', '_', strtolower($attribute))), '_');
    }
}
