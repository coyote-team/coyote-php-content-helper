<?php

declare(strict_types=1);
use PHPUnit\Framework\TestCase;

class TestContentHelper extends TestCase
{


    /*
        Given an html string we can get all of the image elements
    */
    public function testGetImages(): void
    {
        $contents = file_get_contents(path_join(plugin_dir_path(__FILE__), 'arngren_net.html'));
        $doc = new DOMDocument();
    
        $doc->loadHTML($contents);
        $images = $doc->getElementsByTagName('img');
        $num = count($images);
        $this->assertNumeric($num);
    }

    public function testGetImageAlt(): void
    {
        $contents = file_get_contents(path_join(plugin_dir_path(__FILE__), 'arngren_net.html'));
        $doc = new DOMDocument();
        $attr = $element->getAttribute('alt');
        if($attr = ''){
            $this->assertNull($attr);
        }

    }

    public function testSetImageAlt(): void
    {
        $attr=$element->getAttribute('alt');
        $newelement = $element->setAttribute('alt',$alt);
    }

    public function testGetImageSrc(): void
    {
        $src = $element->getAttribute('src');
        if($src = ''){
 
        }
    }

    public function testSetImageSrc(): void
    {
        $src = $element->getAttribute('src');
        if($src = ''){
        }
    }

    public function testGetImageClass(): void
    {
        $class = $element->getAttribute('class');
        if($src = ''){
            $this->assertNull($class);
        }
        $this->assertSame();
    }


}