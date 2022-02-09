<?php

declare(strict_types=1);

class ContentHelper
{

    /*
        Given a html string, either an entire or partial document, return all image elements (these can be DOMElement instances)
    */
    public function get_images(string $html)
    {
        $dom->loadHTML($html);
        $images = $dom->getElementsByTagName('img');

        foreach($images as $image){

        }

        return $images;
    }

    /*
        Given a DOMElement node, return either null or its caption
    */
    public function get_image_caption(DOMElement $element): ?string
    {
        return '';
    }

    /*
        Given a DOMElement node, return either null or its alt
    */
    public function get_image_alt(DOMElement $element): ?string
    {
        $attr = $element->getAttribute('alt');
        if($attr = ''){
            return null;
        }
        return $attr;
    }

    /*
        Given an image DOMElement node and a string, set its alt attribute value. Be careful of data sanitation.
    */
    public function set_image_alt(DOMElement $element, string $alt): DOMElement
    {
        $newelement = $element->setAttribute('alt',$alt);
        return $newelement;
    }

    /*
        Given a DOMElement node, return either null or its src attribute
    */
    public function get_image_src(DOMElement $element): ?string
    {
        $src = $element->getAttribute('src');
        if($src = ''){
            return null;
        }
        return $src;
    }
    
    /*
        Given an image DOMElement node and a string, set its src attribute value. Be careful of data sanitation.
    */
    public function set_image_src(DOMElement $element, string $src): ?string
    {
        $newelement = $element->setAttribute('src',$src);
        return $newelement;
    }

    /*
        Given a DOMElement node, return either null or its class attribute
    */
    public function get_image_class(DOMElement $element): ?string
    {
        $src = $element->getAttribute('class');
        if($src = ''){
            return null;
        }
        return $src;
    }

    /*
        Given a DOMElement node, return either null or its attachment src
    */
    public function get_image_attachment_src(DOMElement $element): ?string
    {
        return null;
    }

    /*
        Given a html string, either an entire or partial document, 
        and a map of image sources and their alt attributes, 
        set the alt text for each image and return the modified html
    */
    public function set_image_alts(string $html, $map): string
    {
        
        $images = get_images($html);
        $image_count = count($images);

        foreach($images as $image){
            if($map->get($this->get_image_src($image) !== null)){
                
            }
        }
        
        
        
    }




    /**
     * @param int $attachment_id
     * @return string
     */
    function coyote_attachment_url($attachment_id) {

        return '//teststring';
    }


}

class Image {
    public readonly string $src;
    public readonly ?string $alt;
    public readonly ?string $caption;

    public function __construct(string $src, string $alt, string $caption)
    {
        $this->src = $src;
        $this->alt = $alt;
        $this->caption = $caption;
    }

}