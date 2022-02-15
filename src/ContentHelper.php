<?php

declare(strict_types=1);
use ContentHelper\Image;

class ContentHelper
{

    private DOMDocument $dom;

    public function __construct(string $html){
        $this->dom = new DOMDocument;
        $this->dom->loadHTML($html);
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

    public function set_image_alt(string $src, string $alt): string{
        
        $xpath = new DOMXPATH($this->dom);
        $images = $xpath->evaluate("//img[@src=\"{$src}\"]");
        
        if(isset($images)){

            foreach($images as $image){
                $image->removeAttribute('alt');
                $image->setAttribute('alt', $alt);
            }

        }

        $html = $this->dom->saveHTML();
        return $html;
    }

    /*
        Given a html string, either an entire or partial document, 
        and a map of image sources and their alt attributes, 
        set the alt text for each image and return the modified html
    */
    public function set_image_alts($map): string
    {
        
        $xpath = new DOMXPath($this->dom);

        foreach($map as $src => $alt){
            $images = $xpath->evaluate("//img[@src=\"{$src}\"]");
            if(is_null($images) || $images === false){
                continue;
            }
            
            foreach($images as $image){
                $image->removeAttribute('alt');
                $image->setAttribute('alt', $alt);
            }

        }

        $html = $this->dom->saveHTML();

        return $html;
        
        
    }



}