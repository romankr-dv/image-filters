<?php

namespace yamadote\Image\Writer;

use yamadote\Image\Source;

/**
 * Interface InterfaceWriter
 *
 * @package yamadote\Image\Writer
 * Interface for saving images
 */
interface InterfaceWriter
{
    /**
     * InterfaceWriter constructor.
     *
     * @param Source $source
     */
    public function __construct(Source $source);

    /**
     * @param  string $url
     * @return bool
     */
    public function save(string $url);
}
