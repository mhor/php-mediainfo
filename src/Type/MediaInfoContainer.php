<?php

namespace Mhor\MediaInfo\Type;

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
     * @var array
     */
    private $audios = array();

    /**
     * @var array
     */
    private $videos = array();

    /**
     * @var array
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
     * @return array
     */
    public function getAudios()
    {
        return $this->audios;
    }

    /**
     * @return array
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
     * @return array
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
     * @param AbstractType $trackType
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