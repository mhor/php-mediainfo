<?php

namespace Mhor\MediaInfo\Factory;

use Mhor\MediaInfo\Type\AbstractType;
use Mhor\MediaInfo\Type\Audio;
use Mhor\MediaInfo\Type\General;
use Mhor\MediaInfo\Type\Image;
use Mhor\MediaInfo\Type\Subtitle;
use Mhor\MediaInfo\Type\Video;
use Mhor\MediaInfo\Type\Other;
use Mhor\MediaInfo\Exception\UnknownTrackTypeException;

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
     * @return AbstractType
     * @throws UnknownTrackTypeException
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
