<?php

declare(strict_types=1);
use ContentHelper\Image;

class ContentHelper
{

    public DOMDocument $dom;

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


    /*
        Given a html string, either an entire or partial document, 
        and a map of image sources and their alt attributes, 
        set the alt text for each image and return the modified html
    */
    public function set_image_alts($map): string
    {
        
        
        

        foreach($map as $key -> $value){
            if(null !== 1){
                $image->removeAttribute('alt');
                $image->setAttribute('alt', $map->get($this->get_image_src($image)));
                
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