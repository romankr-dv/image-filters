<?php

namespace yamadote\Image\Effect;

use yamadote\Image\Source;

/**
 * Class Sepia
 *
 * @package yamadote\Effect
 * Simple effect for images
 */
class Sepia implements InterfaceEffect
{
    /**
     * @param  Source $source
     * @return Source
     */
    public function apply(Source $source): Source
    {
        imagefilter($source->image, IMG_FILTER_GRAYSCALE);
        imagefilter($source->image, IMG_FILTER_BRIGHTNESS, -30);
        imagefilter($source->image, IMG_FILTER_COLORIZE, 90, 55, 30);
        return $source;
    }
}
