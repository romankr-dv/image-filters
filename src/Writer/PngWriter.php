<?php

namespace yamadote\Image\Writer;

use yamadote\Image\Source;

/**
 * Class PngWriter
 *
 * @package yamadote\Image\Writer
 * Simple PngWriter for saving png images
 */
class PngWriter implements InterfaceWriter
{
    /**
     * @var
     */
    private $source;

    /**
     * PngWriter constructor.
     *
     * @param $source
     */
    public function __construct(Source $source)
    {
        $this->source = $source;
    }

    /**
     * @param string $url
     */
    public function save(string $url)
    {
        $image = $this->source->image;
        imagesavealpha($image, true);
        imagepng($image, $url);
        imagedestroy($image);
    }

    /**
     * Show image in browser
     */
    public function show()
    {
        $image = $this->source->image;
        imagesavealpha($image, true);
        header('Content-Type: image/png');
        imagepng($image);
        imagedestroy($image);
    }
}
