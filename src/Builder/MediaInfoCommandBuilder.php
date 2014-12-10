<?php

namespace Mhor\MediaInfo\Builder;

use Mhor\MediaInfo\Runner\MediaInfoCommandRunner;
use Symfony\Component\Filesystem\Filesystem;

class MediaInfoCommandBuilder
{
    public function buildMediaInfoCommandRunner($filepath)
    {
        $fileSystem = new Filesystem();
        if (!$fileSystem->exists($filepath)) {
            throw new \Exception('File doesn\'t exist');
        }

        return new MediaInfoCommandRunner($filepath);
    }
}
