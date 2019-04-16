<?php

namespace yamadote\Image;

/**
 * Class Source
 *
 * @package yamadote\Image
 * Universal format for images
 */
class Source
{

    /**
     * @var resource
     */
    public $image;

    /**
     * Source constructor.
     *
     * @param $image
     */
    public function __construct($image)
    {
        $this->image = $image;
    }
}
