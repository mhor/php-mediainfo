<?php

namespace Mhor\MediaInfo\Factory;

use Mhor\MediaInfo\Type\AbstractType;
use Mhor\MediaInfo\Type\Audio;
use Mhor\MediaInfo\Type\General;
use Mhor\MediaInfo\Type\Image;

class TypeFactory
{
    const AUDIO = 'Audio';
    const IMAGE = 'Image';
    const GENERAL = 'General';
    const VIDEO = 'Video';

    /**
     * @param $type
     * @return AbstractType
     * @throws \Exception
     */
    public function create($type)
    {
        switch ($type) {
            case self::AUDIO :
                return new Audio();
            case self::IMAGE:
                return new Image();
            case self::GENERAL:
                return new General();
            case self::VIDEO:
                return new Image();
            default:
                throw new \Exception('Type doesn\'t exist');
        }
    }

} 