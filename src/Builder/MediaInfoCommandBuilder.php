<?php

namespace Mhor\MediaInfo\Builder;

use Mhor\MediaInfo\Runner\MediaInfoCommandRunner;
use Symfony\Component\Filesystem\Filesystem;

class MediaInfoCommandBuilder
{
    /**
     * @param string $filePath
     * @param array  $configuration
     *
     * @throws \Exception
     *
     * @return MediaInfoCommandRunner
     */
    public function buildMediaInfoCommandRunner($filePath, array $configuration = [])
    {
        if (filter_var($filePath, FILTER_VALIDATE_URL) === false) {
            $fileSystem = new Filesystem();

            if (!$fileSystem->exists($filePath)) {
                throw new \Exception(sprintf('File "%s" does not exist', $filePath));
            }

            if (is_dir($filePath)) {
                throw new \Exception(sprintf(
                    'Expected a filename, got "%s", which is a directory',
                    $filePath
                ));
            }
        }

        $configuration = $configuration + [
            'command'                            => null,
            'use_oldxml_mediainfo_output_format' => true,
        ];

        return new MediaInfoCommandRunner(
            $filePath,
            $configuration['command'],
            null,
            null,
            $configuration['use_oldxml_mediainfo_output_format']
        );
    }
}
