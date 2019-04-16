<?php

namespace yamadote\Image\Effect;

use yamadote\Image\Source;

/**
 * Class Invert
 *
 * @package yamadote\Effect
 * Simple effect for images
 */
class Invert implements InterfaceEffect
{
    /**
     * @param  Source $source
     * @return Source
     */
    public function apply(Source $source): Source
    {
        imagefilter($source->image, IMG_FILTER_NEGATE);
        return $source;
    }
}
