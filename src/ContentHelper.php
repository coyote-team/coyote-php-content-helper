<?php

declare(strict_types=1);

class ContentHelper
{
    public function get_images(string $html): DOMNOdeList
    {
        $dom = new DOMDocument();
        $dom->loadHTML($html);
        $images = $dom->getElementsByTagName('img');
        return $images;
    }

    public function get_image_alt(DOMElement $element): ?string
    {
        $attr = $element->getAttribute('alt');
        if($attr = ''){
            return null;
        }
        return $attr;
    }

    public function set_image_alt(DOMElement $element, string $alt): DOMElement
    {
        $attr=$element->getAttribute('alt');
        $newelement = $element->setAttribute('alt',$alt);
        return $newelement;
    }

    public function get_image_src(DOMElement $element): ?string
    {
        $src = $element->getAttribute('src');
        if($src = ''){
            return null;
        }
        return $src;
    }

    public function set_image_src(DOMElement $element): ?string
    {
        $src = $element->getAttribute('src');
        if($src = ''){
            return null;
        }
        return $src;
    }

    public function set_image_alts(string $html, $map): string
    {
        $images = get_images($html);
        $element; 
        foreach ($images as &$image) {
            $element = $dom->createElement('img', $image);

        }
    }

}