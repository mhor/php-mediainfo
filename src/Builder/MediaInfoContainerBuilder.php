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
    public function build()
    {
        return $this->mediaInfoContainer;
    }

    /**
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->mediaInfoContainer->setVersion($version);
    }

    /**
     * @param $typeName
     * @param array $attributes
     *
     * @throws \Mhor\MediaInfo\Exception\UnknownTrackTypeException
     */
    public function addTrackType($typeName, array $attributes)
    {
        $trackType = $this->typeFactory->create($typeName);
        $this->addAttributes($trackType, $attributes);

        $this->mediaInfoContainer->add($trackType);
    }

    /**
     * @param AbstractType $trackType
     * @param array        $attributes
     */
    private function addAttributes(AbstractType $trackType, $attributes)
    {
        $this->mediaInfoContainer;
        foreach ($attributes as $attribute => $value) {
            if ($attribute[0] === '@') {
                continue;
            }

            $attribute = $this->formatAttribute($attribute);
            $trackType->set(
                $attribute,
                AttributeFactory::create($attribute, $value)
            );
        }
    }

    /**
     * @param string $attribute
     *
     * @return string
     */
    private function formatAttribute($attribute)
    {
        return trim(str_replace('__', '_', str_replace(' ', '_', strtolower($attribute))), '_');
    }
}
