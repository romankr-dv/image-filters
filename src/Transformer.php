<?php

namespace yamadote\Image;

use yamadote\Image\Effect\InterfaceEffect;

/**
 * Class Transformer
 *
 * @package yamadote\Image
 * Add filters to source of image
 */
class Transformer
{
    /**
     * @var
     */
    public $source;

    /**
     * @var
     */
    public $effects;

    /**
     * Transformer constructor.
     *
     * @param Source $source
     */
    public function __construct(Source $source)
    {
        $this->source = $source;
        $this->effects = [];
    }

    /**
     * @param  Effect $effect
     * @return Transformer
     */
    public function add(InterfaceEffect $effect): Transformer
    {
        $this->effects[] = $effect;
        return $this;
    }

    /**
     * @return Source
     */
    public function getSource(): Source
    {
        foreach ($this->effects as $effect) {
            $this->source = $effect->apply($this->source);
        }
        return $this->source;
    }
}
