<?php

namespace yamadote\Image\Effect;

use yamadote\Image\Source;

/**
 * Class Contrast
 *
 * @package yamadote\Effect
 * Simple effect for images
 */
class Contrast implements InterfaceEffect
{
    /**
     * @var int
     */
    public $contrast;

    /**
     * Contrast constructor.
     *
     * @param int $contrast (-100 to 100)
     */
    public function __construct(int $contrast)
    {
        $this->contrast = $contrast;
    }

    /**
     * @param  Source $source
     * @return Source
     */
    public function apply(Source $source): Source
    {
        imagefilter($source->image, IMG_FILTER_CONTRAST, $this->contrast);
        return $source;
    }
}
