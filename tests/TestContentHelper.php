<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;

class TestContentHelper extends TestCase
{

    protected string $contents;
    protected DOMDocument $dom;

    public function __construct(string $file)
    {
        $contents = file_get_contents(path_join(plugin_dir_path(__FILE__), 'arngren_net.html'));
        $doc = new DOMDocument();
        $doc->loadHTML($contents);
    }

    public function test_get_images(string $html): void
    {
        $dom = new DOMDocument();
        $dom->loadHTML($html);
        $images = $dom->getElementsByTagName('img');
        return $images;
    }

    public function test_get_image_alt(DOMElement $element): void
    {
        $attr = $element->getAttribute('alt');
        if($attr = ''){
            return null;
        }
        return $attr;
    }

    public function test_set_image_alt(DOMElement $element, string $alt): void
    {
        $attr=$element->getAttribute('alt');
        $newelement = $element->setAttribute('alt',$alt);
        return $newelement;
    }

    public function test_get_image_src(DOMElement $element): void
    {
        $src = $element->getAttribute('src');
        if($src = ''){
            return null;
        }
        return $src;
    }

    public function test_set_image_src(DOMElement $element): void
    {
        $src = $element->getAttribute('src');
        if($src = ''){
            return null;
        }
        return $src;
    }

    public function test_set_image_alts(string $html, $map): string
    {
        $images = get_images($html);
        $element; 
        foreach ($images as &$image) {
            $element = $dom->createElement('img', $image);

        }
    }

}