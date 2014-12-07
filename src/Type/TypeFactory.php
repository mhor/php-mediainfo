<?php

namespace Mhor\MediaInfo\Type;

class TypeFactory
{
    const AUDIO = 'Audio';
    const IMAGE = 'Image';
    const GENERAL = 'General';
    const VIDEO = 'Video';

    public function create($type)
    {

        switch ($type) {
            case self::AUDIO :
                return new Audio();
                break;
            case self::IMAGE:
                return new Image();
                break;
            case self::GENERAL:
                return new General();
                break;
            case self::VIDEO:
                return new Image();
                break;
            default:
                throw new \Exception('Type doesn\'t exist');
                break;
        }
    }

} 