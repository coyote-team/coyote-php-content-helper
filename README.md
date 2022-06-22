# Coyote PHP Content Helper

A composer package PHP helper for the Coyote Drupal plugin, and Coyote Wordpress plugin. 

## Overview

The purpose of the package is to parse HTML content, and put the necessary image attributes for Coyote plugins into an abstracted image object. The content helper also has the functionality of changing the alt text of images based on the src of the images. If the HTML content is malformed then no image elements can be found when parsed.

## Image Object

The image object is an abstraction of an HTML image.
It stores all the attributes, and content for images that will be needed to change the HTML content of a page.
```php

/**@property-read    string  $src
 * @property-read    ?string $alt
 * @property-read    ?string $class
 * @property-read    ?string $contentBefore Content that is between the image element and the previous element
 * @property-read    ?string $contentAfter Content that is between the image element and the next element
 * @property-read    ?string $figureCaption 
 */
class Image{
    <...>
}
```

## Usage

To use the ContentHelper functions for gathering images a ContentHelper object must first be constructed, with input of fully formed HTML.

```php
$helper = new ContentHelper($wellFormedHTML);
```

### Get an array of Images

You can call the getImages function to get an array of Image objects.
```php
$helper = new ContentHelper($wellFormedHTML);
$imageArray = $helper->getImages();
```

### Options to change image text: setImageAlt, and setImageAlts

#### setImageAlt

Given a src, and an alt, the alt text for each image with that src will be changed to the given alt.

This will return the newly modified HTML.

```php
$helper = new ContentHelper($wellFormedHTML);
$src = "foo.jpg";
$newAlt = "This is new alt test";
$newHTML = $helper->setImageAlt($src,$alt);
```

#### setImageAlts

Given a map with the key being the src, and the value being the alt it will traverse the map and change the alt text for each src given.

This will return the newly modified HTML.

```php
$helper = new ContentHelper($wellFormedHTML);
$map = ['foo.jpg'=>'New Alt for Foo','test.jpg'=>'New Alt for Test','example.jpg'=>'New Alt for Example'];
$newHTML = $helper->setImageAlts($map);
```