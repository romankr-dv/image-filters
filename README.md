# Image Filters
Library for adding filters to images.<br> Repository for homework on GeekHub Advanced PHP.

## How to use
Add some filters to image:
```php
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
```

## List of filters
All realized filters and ranges of parameters:

| Effect        | Parameters                            | Ranges                |
| ------------- | ------------------------------------- | --------------------- |
| Colorize      | int $red, int $green, int $blue       | from 0 to 255         |
| Brightness    | int $brightness                       | from -255 to 255      |
| Blur          | int $blur                             | from 1 to 6           |
| Contrast      | int $contrast                         | from -100 to 100      |
| Opacity       | int $opacity                          | from 0 to 100         |
| Saturate      | int $saturation                       |                       |
| HueRotate     | int $angle                            |                       |
| Grayscale     |                                       |                       |
| Invert        |                                       |                       |
| Sepia         |                                       |                       |
