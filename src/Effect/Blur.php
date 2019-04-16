<?php

namespace yamadote\Image\Effect;

use yamadote\Image\Source;

/**
 * Class Blur
 *
 * @package yamadote\Effect
 * Simple effect for images
 */
class Blur implements InterfaceEffect
{
    /**
     * @var int
     */
    private $blur;

    /**
     * Blur constructor.
     *
     * @param int $blur (0 to 5)
     */
    public function __construct(int $blur)
    {
        $this->blur = $blur;
    }

    /**
     * @param  Source $source
     * @return Source
     */
    public function apply(Source $source): Source
    {
        $this->blur($source->image, $this->blur);
        return $source;
    }

    /**
     * Strong Blur
     *
     * @param resource $gdImageResource
     * @param int      $blurFactor
     * @return GD image resource
     * @author Martijn Frazer, idea based on http://stackoverflow.com/a/20264482
     */
    private function blur($gdImageResource, $blurFactor)
    {
        // blurFactor has to be an integer
        $blurFactor = round($blurFactor);

        $originalWidth = imagesx($gdImageResource);
        $originalHeight = imagesy($gdImageResource);

        $smallestWidth = ceil($originalWidth * pow(0.5, $blurFactor));
        $smallestHeight = ceil($originalHeight * pow(0.5, $blurFactor));

        // for the first run, the previous image is the original input
        $prevImage = $gdImageResource;
        $prevWidth = $originalWidth;
        $prevHeight = $originalHeight;

        // scale way down and gradually scale back up, blurring all the way
        for ($i = 0; $i < $blurFactor; $i += 1) {
            // determine dimensions of next image
            $nextWidth = $smallestWidth * pow(2, $i);
            $nextHeight = $smallestHeight * pow(2, $i);

            // resize previous image to next size
            $nextImage = imagecreatetruecolor($nextWidth, $nextHeight);
            imagecopyresized(
                $nextImage,
                $prevImage,
                0,
                0,
                0,
                0,
                $nextWidth,
                $nextHeight,
                $prevWidth,
                $prevHeight
            );

            // apply blur filter
            imagefilter($nextImage, IMG_FILTER_GAUSSIAN_BLUR);

            // now the new image becomes the previous image for the next step
            $prevImage = $nextImage;
            $prevWidth = $nextWidth;
            $prevHeight = $nextHeight;
        }

        // scale back to original size and blur one more time
        imagecopyresized(
            $gdImageResource,
            $nextImage,
            0,
            0,
            0,
            0,
            $originalWidth,
            $originalHeight,
            $nextWidth,
            $nextHeight
        );
        imagefilter($gdImageResource, IMG_FILTER_GAUSSIAN_BLUR);

        // clean up
        imagedestroy($prevImage);

        // return result
        return $gdImageResource;
    }
}
