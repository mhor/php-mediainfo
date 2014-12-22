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

```bash
$ composer require mhor/php-mediainfo
```

## How to use


### Retrieve media information container
```php
<?php
//...
use Mhor\MediaInfo\MediaInfo;
//...
$mediaInfo = new MediaInfo();
$mediaInfoContainer = $mediaInfo->getInfo('music.mp3');
//...
```

### Get general information from media information container

```php
$general = $mediaInfoContainer->getGeneral();
```

### Get videos information from media information container

```php
$videos = $mediaInfoContainer->getVideos();

foreach ($videos as $video) {
    // ... do something
}
```

### Get audios information from media information container

```php
$audios = $mediaInfoContainer->getAudios();

foreach ($audios as $audio) {
    // ... do something
}
```

### Get images information from media information container

```php
$images = $mediaInfoContainer->getImages();

foreach ($images as $image) {
    // ... do something
}
```

### Access to information

#### Get all information into an array

```php
$informationArray = $general->get();
```

#### Get one information by field name

Field Name are in lower case separated by "_"

```php
$oneInformation = $general->get('count_of_audio_streams');
```

### Specials types

#### Cover
For field:

- cover_data

[Cover](src/Attribute/Cover.php) type will be applied

#### Duration
For fields:

- duration
- delay_relative_to_video
- video0_delay
- delay

[Duration](src/Attribute/Duration.php) type will be applied

#### Mode
For fields:

- overall_bit_rate_mode
- overall_bit_rate
- bit_rate_mode
- compression_mode
- codec
- format
- kind_of_stream
- writing_library
- id
- format_settings_sbr
- channel_positions
- default
- forced
- delay_origin
- scan_type
- interlacement
- scan_type
- frame_rate_mode
- format_settings_cabac
- unique_id

[Mode](src/Attribute/Mode.php) type will be applied

#### Rate
For fields:

- channel_s
- bit_rate
- sampling_rate
- bit_depth
- width
- nominal_bit_rate
- frame_rate
- display_aspect_ratio
- frame_rate
- format_settings_reframes
- height
- resolution
- original_display_aspect_ratio

[Rate](src/Attribute/Rate.php) type will be applied

#### Size
For fields:

- file_size
- stream_size

[Size](src/Attribute/Size.php) type will be applied

#### Others
- All date fields will be transformed into `Datetime` php object

##LICENSE
See `LICENSE` for more information
