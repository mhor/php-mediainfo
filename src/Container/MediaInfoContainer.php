<?php

namespace Mhor\MediaInfo\Container;

use Mhor\MediaInfo\DumpTrait;
use Mhor\MediaInfo\Type\AbstractType;
use Mhor\MediaInfo\Type\Audio;
use Mhor\MediaInfo\Type\General;
use Mhor\MediaInfo\Type\Image;
use Mhor\MediaInfo\Type\Menu;
use Mhor\MediaInfo\Type\Other;
use Mhor\MediaInfo\Type\Subtitle;
use Mhor\MediaInfo\Type\Video;

class MediaInfoContainer implements \JsonSerializable
{
    use DumpTrait;

    public const GENERAL_CLASS = 'Mhor\MediaInfo\Type\General';
    public const AUDIO_CLASS = 'Mhor\MediaInfo\Type\Audio';
    public const IMAGE_CLASS = 'Mhor\MediaInfo\Type\Image';
    public const VIDEO_CLASS = 'Mhor\MediaInfo\Type\Video';
    public const SUBTITLE_CLASS = 'Mhor\MediaInfo\Type\Subtitle';
    public const MENU_CLASS = 'Mhor\MediaInfo\Type\Menu';
    public const OTHER_CLASS = 'Mhor\MediaInfo\Type\Other';

    private ?string $version = null;

    private ?General $general = null;

    /**
     * @var Audio[]
     */
    private array $audios = [];

    /**
     * @var Video[]
     */
    private array $videos = [];

    /**
     * @var Subtitle[]
     */
    private array $subtitles = [];

    /**
     * @var Image[]
     */
    private array $images = [];

    /**
     * @var Menu[]
     */
    private array $menus = [];

    /**
     * @var Other[]
     */
    private array $others = [];

    public function getGeneral(): ?General
    {
        return $this->general;
    }

    /**
     * @return Audio[]
     */
    public function getAudios(): array
    {
        return $this->audios;
    }

    /**
     * @return Image[]
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @return Menu[]
     */
    public function getMenus(): array
    {
        return $this->menus;
    }

    /**
     * @return Other[]
     */
    public function getOthers(): array
    {
        return $this->others;
    }

    /**
     * @param string $version
     */
    public function setVersion(?string $version): void
    {
        $this->version = $version;
    }

    public function getVersion(): ?string
    {
        return $this->version;
    }

    /**
     * @return Video[]
     */
    public function getVideos(): array
    {
        return $this->videos;
    }

    /**
     * @return Subtitle[]
     */
    public function getSubtitles(): array
    {
        return $this->subtitles;
    }

    public function setGeneral(General $general): void
    {
        $this->general = $general;
    }

    /**
     * @throws \Exception
     */
    public function add(AbstractType $trackType): void
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
            case self::SUBTITLE_CLASS:
                $this->addSubtitle($trackType);
                break;
            case self::MENU_CLASS:
                $this->addMenu($trackType);
                break;
            case self::OTHER_CLASS:
                $this->addOther($trackType);
                break;
            default:
                throw new \Exception('Unknown type');
        }
    }

    private function addAudio(Audio $audio): void
    {
        $this->audios[] = $audio;
    }

    private function addVideo(Video $video): void
    {
        $this->videos[] = $video;
    }

    private function addImage(Image $image): void
    {
        $this->images[] = $image;
    }

    private function addSubtitle(Subtitle $subtitle): void
    {
        $this->subtitles[] = $subtitle;
    }

    private function addMenu(Menu $menu): void
    {
        $this->menus[] = $menu;
    }

    private function addOther(Other $other): void
    {
        $this->others[] = $other;
    }
}
