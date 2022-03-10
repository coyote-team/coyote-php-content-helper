<?php

declare(strict_types=1);
use ContentHelper\Image;
use ContentHelper\WordPressImage;
use IvoPetkov\HTML5DOMDocument;

class ContentHelper
{

    private DOMDocument $dom;

    public function __construct(string $html){
        $this->dom = new IvoPetkov\HTML5DOMDocument();
        $this->dom->loadHTML($html);
        /* LoadHTML() doesn't return false on error (It Should), so this conditional checks manually if there are any */
        if(count(libxml_get_errors()) > 0){
            libxml_clear_errors();
            throw new Exception('Malformed HTML');
        }

    }

    /*
        Given a html string, either an entire or partial document, return all image elements (these can be DOMElement instances)
    */
    public function get_images()
    {
        
        $images = $this->dom->getElementsByTagName('img');
        $imageObjects = [];
        foreach($images as $image){
            $src = $image->getAttribute('src');
            $alt = $image->getAttribute('alt');
            $class = $image->getAttribute('class');
            $contentImage = new Image($src,$alt,'',$class);
            if($src){
                array_push($imageObjects, $contentImage);
            }
        }

        return $imageObjects;
    }

    
    /*
        Given a src string, and an alt string
        set the alt text equal to the provided alt text
        for each element with the same src
    */
    private function set_image_alt(string $src, string $alt): void
    {
        
        $xpath = new DOMXPATH($this->dom);
        $images = $xpath->evaluate("//img[@src=\"{$src}\"]");
        
        if(is_null($images) || $images === false){
            return;
        }

        foreach($images as $image){
            $image->removeAttribute('alt');
            $image->setAttribute('alt', $alt);
        }

    }

    /*
        Given a html string, either an entire or partial document, 
        and a map of image sources and their alt attributes, 
        set the alt text for each image and return the modified html
    */
    public function set_image_alts($map): string
    {

        foreach($map as $src => $alt){
            $this->set_image_alt($src, $alt);
        }

        $html = $this->dom->saveHTML();

        return $html;
        
        
    }

}