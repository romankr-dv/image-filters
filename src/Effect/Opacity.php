<?php

namespace yamadote\Image\Effect;

use yamadote\Image\Source;

/**
 * Class Opacity
 *
 * @package yamadote\Effect
 * Simple effect for images
 */
class Opacity implements InterfaceEffect
{
    /**
     * @var int
     */
    private $opacity;

    /**
     * Opacity constructor.
     *
     * @param int $opacity (0 to 100)
     */
    public function __construct(int $opacity)
    {
        $this->opacity = $opacity;
    }

    /**
     * @param  Source $source
     * @return Source
     */
    public function apply(Source $source): Source
    {
        $this->filter_opacity($source->image, $this->opacity);
        return $source;
    }

    /**
     * @param  $img
     * @param  $opacity
     * @return bool
     */
    public function filter_opacity(&$img, $opacity)
    {
        if (!isset($opacity)) {
            return false;
        }
        $opacity /= 100;

        //get image width and height
        $w = imagesx($img);
        $h = imagesy($img);

        //turn alpha blending off
        imagealphablending($img, false);

        //find the most opaque pixel in the image
        //(the one with the smallest alpha value)
        $minalpha = 127;
        for ($x = 0; $x < $w; $x++) {
            for ($y = 0; $y < $h; $y++) {
                $alpha = (imagecolorat($img, $x, $y) >> 24) & 0xFF;
                if ($alpha < $minalpha) {
                    $minalpha = $alpha;
                }
            }
        }

        //loop through image pixels and modify alpha for each
        for ($x = 0; $x < $w; $x++) {
            for ($y = 0; $y < $h; $y++) {
                //get current alpha value (represents the TANSPARENCY!)
                $colorxy = imagecolorat($img, $x, $y);
                $alpha = ($colorxy >> 24) & 0xFF;
                //calculate new alpha
                if ($minalpha !== 127) {
                    $alpha = 127 + 127 * $opacity * ($alpha - 127) / (127 - $minalpha);
                } else {
                    $alpha += 127 * $opacity;
                }
                //get the color index with new alpha
                $alphacolorxy = imagecolorallocatealpha(
                    $img,
                    ($colorxy >> 16) & 0xFF,
                    ($colorxy >> 8) & 0xFF,
                    $colorxy & 0xFF, $alpha
                );
                //set pixel with the new color + opacity
                if (!imagesetpixel($img, $x, $y, $alphacolorxy)) {
                    return false;
                }
            }
        }
        return true;
    }
}
