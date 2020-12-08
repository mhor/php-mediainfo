# Php-MediaInfo [![Coverage Status](https://coveralls.io/repos/github/mhor/php-mediainfo/badge.svg?branch=master)](https://coveralls.io/github/mhor/php-mediainfo?branch=master) [![Packagist](https://img.shields.io/packagist/v/mhor/php-mediainfo.svg)](https://packagist.org/packages/mhor/php-mediainfo) [![Packagist](https://img.shields.io/packagist/dt/mhor/php-mediainfo.svg)](https://packagist.org/packages/mhor/php-mediainfo)

## Introduction

PHP wrapper around the `mediainfo` command

## Table of contents:
- [Installation](#installation)
- [How to use](#how-to-use)
- [Specials types](#specials-types)
- [Extra](#extra)
- [License](#license)

## Installation

### 1 - Install mediainfo
You should install [mediainfo](http://manpages.ubuntu.com/manpages/gutsy/man1/mediainfo.1.html):

#### On linux:

```bash
$ sudo apt-get install mediainfo
```

#### On Mac:

```bash
$ brew install mediainfo
```

### 2 - Integration in your php project

To use this library install it through [Composer](https://getcomposer.org/), run:

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

### Get subtitles information from media information container

```php
$subtitles = $mediaInfoContainer->getSubtitles();

foreach ($subtitles as $subtitle) {
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

### Get menus information from media information container

```php
$menus = $mediaInfoContainer->getMenus();

foreach ($menus as $menu) {
    // ... do something
}
```

### Example

```php
<?php

require './vendor/autoload.php';

use Mhor\MediaInfo\MediaInfo;

$mediaInfo = new MediaInfo();
$mediaInfoContainer = $mediaInfo->getInfo('./SampleVideo_1280x720_5mb.mkv');

echo "Videos channel: \n";
echo "=======================\n";
foreach ($mediaInfoContainer->getVideos() as $video) {
    if ($video->has('format')) {
        echo 'format: '.(string)$video->get('format')."\n";
    }

    if ($video->has('height')) {
        echo 'height: '.$video->get('height')->getAbsoluteValue()."\n";
    }

    echo "\n---------------------\n";
}

echo "Audios channel: \n";
echo "=======================\n";
foreach ($mediaInfoContainer->getAudios() as $audio) {
    $availableInfo = $audio->list();
    foreach ($availableInfo as $key) {
        echo $audio->get($key);
    }
    echo "\n---------------------\n";
}
```

### Ignore unknown types

By default unknown type throw an error this, to avoid this behavior, you can do:

```php
$mediaInfo = new MediaInfo();
$mediaInfoContainer = $mediaInfo->getInfo('music.mp3', false);

$others = $mediaInfoContainer->getOthers();
foreach ($others as $other) {
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

#### Check if information exists

Field Name are in lower case separated by "_"

```php
if ($general->has('count_of_audio_streams')) {
    echo $general->get('count_of_audio_streams');
}
```

#### List available information

```php
$availableInfo = $general->list();
foreach ($availableInfo as $key) {
    echo $general->get($key);
}
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
- format_settings_reframes
- height
- resolution
- maximum_bit_rate

[Rate](src/Attribute/Rate.php) type will be applied

#### Ratio
For fields:

- display_aspect_ratio
- original_display_aspect_ratio

[Ratio](src/Attribute/Ratio.php) type will be applied

#### Size
For fields:

- file_size
- stream_size

[Size](src/Attribute/Size.php) type will be applied

#### Others
- All date fields will be transformed into `Datetime` php object


## Extra

### Use custom mediainfo path

```php
$mediaInfo = new MediaInfo();
$mediaInfo->setConfig('command', '/usr/local/bin/mediainfo');
$mediaInfoContainer = $mediaInfo->getInfo('music.mp3');
```

### Support old mediainfo version (<17.10)

```php
$mediaInfo = new MediaInfo();
$mediaInfo->setConfig('use_oldxml_mediainfo_output_format', false);
$mediaInfoContainer = $mediaInfo->getInfo('music.mp3');
```

### Use url as filepath

```php
$mediaInfo = new MediaInfo();
$mediaInfoContainer = $mediaInfo->getInfo('http://example.org/music/test.mp3');
```


### MediaInfoContainer to JSON, Array or XML
```php
$mediaInfo = new MediaInfo();
$mediaInfoContainer = $mediaInfo->getInfo('music.mp3');

$json = json_encode($mediaInfoContainer);
$array = $mediaInfoContainer->__toArray();
$xml = $mediaInfoContainer->__toXML();
```

### Usage for WindowsOS

Download MediaInfo CLI from [here](https://mediaarea.net/de/MediaInfo/Download/Windows). Extract zip-archive and place MediaInfo.exe somewhere. Use it:

```php
$mediaInfo = new MediaInfo();
$mediaInfo->setConfig('command', 'C:\path\to\directory\MediaInfo.exe');
$mediaInfoContainer = $mediaInfo->getInfo('music.mp3');
```

### Urlencode Config

By default MediaInfo tries to detect if a URL is already percent-encode and encodes the URL when it's not.
Setting the `'urlencode'` config setting to `true` forces MediaInfo to encode the URL despite the presence of percentage signs in the URL.
This is for example required when using pre-signed URLs for AWS S3 objects.

```php
$mediaInfo = new MediaInfo();
$mediaInfo->setConfig('urlencode', true);
$mediaInfoContainer = $mediaInfo->getInfo('https://demo.us-west-1.amazonaws.com/video.mp4?X-Amz-Content-Sha256=UNSIGNED-PAYLOAD&X-Amz-Algorithm=AWS4-HMAC-SHA256&X-Amz-Credential=ABC%2F123%2Fus-west-1%2Fs3%2Faws4_request&X-Amz-Date=20200721T114451Z&X-Amz-SignedHeaders=host&X-Amz-Expires=600&X-Amz-Signature=123');
```

This setting requires MediaInfo `20.03` minimum

### Cover data

Recent versions of MediaInfo don't include cover data by default, without passing an additional flag. To include any available cover data, set the `'include_cover_data'` config setting to `true`. See the [cover type](#cover) for details on retrieving the base64 encoded image from `cover_data`.

Originally this cover data was always included in the MediaInfo output, so this option is unnecessary for older versions. But [around version 18](https://sourceforge.net/p/mediainfo/discussion/297610/thread/aeb4222d/?limit=25) cover data was removed from the output by default, unless you also pass the `--Cover_Data=base64` flag.

```php
$mediaInfo = new MediaInfo();
$mediaInfo->setConfig('include_cover_data', true);
$mediaInfoContainer = $mediaInfo->getInfo('music.mp3');

$general = $mediaInfoContainer->getGeneral();
if ($general->has('cover_data')) {
    $attributeCover = $general->get('cover_data');
    $base64EncodedImage = $attributeCover->getBinaryCover();
}
```

**Note:** Older versions of MediaInfo will print the following error if passed this flag:

```bash
$ mediainfo ./music.mp3 -f --OUTPUT=OLDXML --Cover_Data=base64
Option not known
```

### Symfony integration

Look at this bundle: [MhorMediaInfoBunde](https://github.com/mhor/MhorMediaInfoBundle)

### Codeigniter integration

Look at [this](https://philsturgeon.uk/blog/2012/05/composer-with-codeigniter/) to use composer with Codeigniter

## License
See `LICENSE` for more information
