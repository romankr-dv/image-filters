<?php

namespace yamadote\Image\Reader;

use yamadote\Image\Source;

/**
 * Class PngReader
 *
 * @package yamadote\Image\Reader
 * Simple PngReader for read png images
 */
class PngReader implements InterfaceReader
{
    /**
     * @param  string $url
     * @return Source
     */
    public function load(string $url): Source
    {
        $image = imagecreatefrompng($url);

        if (!$image) {
            throw new \Error('File not found!');
        }

        $source = new Source($image);
        return $source;
    }
}
