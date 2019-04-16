<?php

namespace yamadote\Image\Effect;

use yamadote\Image\Source;

/**
 * Class Colorize
 *
 * @package yamadote\Effect
 * Simple effect for images
 */
class Colorize implements InterfaceEffect
{
    /**
     * @var array
     */
    private $rgb;

    /**
     * Colorize constructor.
     *
     * @param int $r (0 to 255)
     * @param int $g (0 to 255)
     * @param int $b (0 to 255)
     */
    public function __construct(int $r, int $g, int $b)
    {
        $this->rgb = ['r' => $r, 'g' => $g, 'b' => $b];
    }

    /**
     * @param  Source $source
     * @return Source
     */
    public function apply(Source $source): Source
    {
        imagefilter(
            $source->image,
            IMG_FILTER_COLORIZE,
            $this->rgb['r'],
            $this->rgb['g'],
            $this->rgb['b']
        );
        return $source;
    }
}
