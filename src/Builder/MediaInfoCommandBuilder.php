<?php

namespace Mhor\MediaInfo\Builder;

use Mhor\MediaInfo\Runner\MediaInfoCommandRunner;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

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
    public function buildMediaInfoCommandRunner(string $filePath, array $configuration = []): MediaInfoCommandRunner
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

        $configuration += [
            'command'                            => null,
            'use_oldxml_mediainfo_output_format' => true,
            'urlencode'                          => false,
            'include_cover_data'                 => false,
        ];

        return new MediaInfoCommandRunner($this->buildMediaInfoProcess(
            $filePath,
            $configuration['command'],
            $configuration['use_oldxml_mediainfo_output_format'],
            $configuration['urlencode'],
            $configuration['include_cover_data']
        ));
    }

    /**
     * @param string      $filePath
     * @param string|null $command
     * @param bool        $forceOldXmlOutput
     * @param bool        $urlencode
     *
     * @return Process
     */
    private function buildMediaInfoProcess(string $filePath, string $command = null, bool $forceOldXmlOutput = true, bool $urlencode = false, bool $includeCoverData = false): Process
    {
        if ($command === null) {
            $command = MediaInfoCommandRunner::MEDIAINFO_COMMAND;
        }

        // arguments are given through ENV vars in order to have system escape them
        $arguments = [
            'MEDIAINFO_VAR_FILE_PATH'    => $filePath,
            'MEDIAINFO_VAR_FULL_DISPLAY' => MediaInfoCommandRunner::MEDIAINFO_FULL_DISPLAY_ARGUMENT,
            'MEDIAINFO_VAR_OUTPUT'       => MediaInfoCommandRunner::MEDIAINFO_OLDXML_OUTPUT_ARGUMENT,
        ];

        if (!$forceOldXmlOutput) {
            $arguments['MEDIAINFO_VAR_OUTPUT'] = MediaInfoCommandRunner::MEDIAINFO_XML_OUTPUT_ARGUMENT;
        }

        if ($urlencode) {
            $arguments['MEDIAINFO_VAR_URLENCODE'] = MediaInfoCommandRunner::MEDIAINFO_URLENCODE;
        }

        if ($includeCoverData) {
            $arguments['MEDIAINFO_COVER_DATA'] = MediaInfoCommandRunner::MEDIAINFO_INCLUDE_COVER_DATA;
        }

        $env = $arguments + [
            'LANG' => setlocale(LC_CTYPE, '0'),
        ];

        return new Process(
            array_merge([$command], array_values($arguments)),
            null,
            $env
        );
    }
}
