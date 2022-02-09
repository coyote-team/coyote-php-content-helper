<?php

declare(strict_types=1);

class ContentHelper
{

    public ?string $html;


    public function __construct(string $html){
        $this->html = $html;
    }

    /*
        Given a html string, either an entire or partial document, return all image elements (these can be DOMElement instances)
    */
    public function get_images()
    {
        $dom = new DOMDocument();
        $dom->loadHTML($this->html);
        $images = $dom->getElementsByTagName('img');
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
    public readonly ?string $class;

    public function __construct(string $src, string $alt, string $caption, string $class)
    {
        $this->src = $src;
        $this->alt = $alt;
        $this->caption = $caption;
        $this->class = $class;
    }

}