<?php

namespace Mhor\MediaInfo\Container;

use Mhor\MediaInfo\Type\AbstractType;
use Mhor\MediaInfo\Type\Audio;
use Mhor\MediaInfo\Type\General;
use Mhor\MediaInfo\Type\Image;
use Mhor\MediaInfo\Type\Video;

class MediaInfoContainer
{
    const GENERAL_CLASS = 'Mhor\MediaInfo\Type\General';
    const AUDIO_CLASS = 'Mhor\MediaInfo\Type\Audio';
    const IMAGE_CLASS = 'Mhor\MediaInfo\Type\Image';
    const VIDEO_CLASS = 'Mhor\MediaInfo\Type\Video';

    /**
     * @var string
     */
    private $version;

    /**
     * @var General
     */
    private $general;

    /**
     * @var Audio[]
     */
    private $audios = array();

    /**
     * @var Video[]
     */
    private $videos = array();

    /**
     * @var Image[]
     */
    private $images = array();

    /**
     * @return General
     */
    public function getGeneral()
    {
        return $this->general;
    }

    /**
     * @return Audio[]
     */
    public function getAudios()
    {
        return $this->audios;
    }

    /**
     * @return Image[]
     */
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param string $version
     */
    public function setVersion($version)
    {
        $this->version = $version;
    }

    /**
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * @return Video[]
     */
    public function getVideos()
    {
        return $this->videos;
    }

    /**
     * @param General $general
     */
    public function setGeneral($general)
    {
        $this->general = $general;
    }

    /**
     * @param  AbstractType $trackType
     * @throws \Exception
     */
    public function add(AbstractType $trackType)
    {
        switch (get_class($trackType)) {
            case self::AUDIO_CLASS:
                $this->addAudio($trackType);
                break;
            case self::VIDEO_CLASS:
                $this->addVideo($trackType);
                break;
            case self::IMAGE_CLASS:
                $this->addImage($trackType);
                break;
            case self::GENERAL_CLASS:
                $this->setGeneral($trackType);
                break;
            default:
                throw new \Exception('Unknow type');
        }
    }

    /**
     * @param Audio $audio
     */
    private function addAudio(Audio $audio)
    {
        $this->audios[] = $audio;
    }

    /**
     * @param Video $video
     */
    private function addVideo(Video $video)
    {
        $this->videos[] = $video;
    }

    /**
     * @param Image $image
     */
    private function addImage(Image $image)
    {
        $this->images[] = $image;
    }
}
