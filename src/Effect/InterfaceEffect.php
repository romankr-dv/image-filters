<?php

namespace yamadote\Image\Effect;

use yamadote\Image\Source;

/**
 * Interface InterfaceEffect
 *
 * @package yamadote\Effect
 * Interface for adding effect to image
 */
interface InterfaceEffect
{
    /**
     * @param  Source $source
     * @return Source
     */
    public function apply(Source $source): Source;
}
