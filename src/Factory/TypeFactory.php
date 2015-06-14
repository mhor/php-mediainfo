<?php

namespace Mhor\MediaInfo\Factory;

use Mhor\MediaInfo\Exception\UnknownTrackTypeException;
use Mhor\MediaInfo\Type\AbstractType;
use Mhor\MediaInfo\Type\Audio;
use Mhor\MediaInfo\Type\General;
use Mhor\MediaInfo\Type\Image;
use Mhor\MediaInfo\Type\Other;
use Mhor\MediaInfo\Type\Subtitle;
use Mhor\MediaInfo\Type\Video;

class TypeFactory
{
    const AUDIO = 'Audio';
    const IMAGE = 'Image';
    const GENERAL = 'General';
    const VIDEO = 'Video';
    const SUBTITLE = 'Text';
    const OTHER = 'Other';

    /**
     * @param $type
     *
     * @throws Mhor\MediaInfo\Exception\UnknownTrackTypeException
     *
     * @return AbstractType
     */
    public function create($type)
    {
        switch ($type) {
            case self::AUDIO:
                return new Audio();
            case self::IMAGE:
                return new Image();
            case self::GENERAL:
                return new General();
            case self::VIDEO:
                return new Video();
            case self::SUBTITLE:
                return new Subtitle();
            case self::OTHER:
                return new Other();
            default:
                throw new UnknownTrackTypeException($type);
        }
    }
}
