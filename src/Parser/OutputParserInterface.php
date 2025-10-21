<?php

namespace Mhor\MediaInfo\Parser;

use Mhor\MediaInfo\Container\MediaInfoContainer;

interface OutputParserInterface
{
    public function parse(string $output): void;

    public function getMediaInfoContainer(array $configuration): MediaInfoContainer;
}
