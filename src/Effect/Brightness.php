<?php

namespace yamadote\Image\Effect;

use yamadote\Image\Source;

/**
 * Class Brightness
 *
 * @package yamadote\Effect
 * Simple effect for images
 */
class Brightness implements InterfaceEffect
{
    /**
     * @var int
     */
    private $brightness;

    /**
     * Brightness constructor.
     *
     * @param int $brightness (-255 to 255)
     */
    public function __construct(int $brightness)
    {
        $this->brightness = $brightness;
    }

    /**
     * @param  Source $source
     * @return Source
     */
    public function apply(Source $source): Source
    {
        imagefilter($source->image, IMG_FILTER_BRIGHTNESS, $this->brightness);
        return $source;
    }
}
