<?php

namespace Mhor\MediaInfo\Factory;

use Mhor\MediaInfo\Attribute\AbstractAttribute;
use Mhor\MediaInfo\Attribute\Cover;
use Mhor\MediaInfo\Attribute\Duration;
use Mhor\MediaInfo\Attribute\Mode;
use Mhor\MediaInfo\Attribute\Rate;
use Mhor\MediaInfo\Attribute\Size;

class GenericAttributeFactory
{
    /**
     * @param $attribute
     * @param $value
     * @return \DateTime|AbstractAttribute
     */
    public static function create($attribute, $value)
    {
        switch ($attribute) {
            case 'file_size':
            case 'stream_size':
                return new Size($value);

            case 'duration':
                return new Duration($value);

            case 'channel_s_':
            case 'bit_rate':
            case 'sampling_rate':
                return new Rate($value);

            case 'cover_data':
                return new Cover($value);

            case 'overall_bit_rate_mode':
            case 'overall_bit_rate':
            case 'bit_rate_mode':
            case 'compression_mode':
            case 'codec':
            case 'kind_of_stream':
                return new Mode($value);

            case 'file_last_modification_date':
            case 'file_last_modification_date__local_':

                return new \DateTime($value);
            default:
                return $value;
        }
    }
}
