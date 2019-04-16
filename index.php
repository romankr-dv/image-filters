<?php

require_once __DIR__ . '/vendor/autoload.php';

use yamadote\Image\Reader\PngReader;
use yamadote\Image\Transformer;
use yamadote\Image\Writer\PngWriter;

use yamadote\Image\Effect\{Opacity, Brightness, Contrast, Colorize};

$url = './image.png';

$reader = new PngReader();
$source = $reader->load($url);

$transformer = new Transformer($source);

$source = $transformer
    ->add(new Colorize(10, 20, 40))
    ->add(new Brightness(-20))
    ->add(new Contrast(10))
    ->add(new Opacity(80))
    ->getSource();

$writer = new PngWriter($source);
$writer->save($url);
