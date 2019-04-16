<?php

namespace yamadote\Image\Reader;

use yamadote\Image\Source;

/**
 * Interface InterfaceReader
 *
 * @package yamadote\Image\Reader
 * Interface for read images
 */
interface InterfaceReader
{
    /**
     * @param  string $url
     * @return Source
     */
    public function load(string $url): Source;
}
