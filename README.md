#Php-MediaInfo [![Build Status](https://travis-ci.org/mhor/php-mediainfo.svg?branch=master)](https://travis-ci.org/mhor/php-mediainfo) [![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/mhor/php-mediainfo/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/mhor/php-mediainfo/?branch=master) [![Coverage Status](https://img.shields.io/coveralls/mhor/php-mediainfo.svg)](https://coveralls.io/r/mhor/php-mediainfo?branch=master)

## Introduction
PHP library to run `mediainfo` command

## Installation

You should install [mediainfo](http://manpages.ubuntu.com/manpages/gutsy/man1/mediainfo.1.html):

On linux:
```bash
$ sudo apt-get install mediainfo
```

On Mac:
```bash
$ brew install mediainfo
```

To use this class install it through [Composer](https://getcomposer.org/), add:
```json
{
    "require" : {
        "mhor/php-mediainfo": "@dev"
    }
}
```

## How to use
```php
<?php
//...
use Mhor\MediaInfo\MediaInfo;
//...
$mediaInfo = new MediaInfo();
$mediaInfo->getInfo('music.mp3');
//...
```

##LICENSE
See `LICENSE` for more information
