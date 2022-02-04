<?php

declare(strict_types=1);



use PHPUnit\Framework\TestCase;

class TestDOMModule extends TestCase
{
    $contents;
	$dom;

    public function setUp(): void 
    {
        $this->contents = file_get_contents(path_join(plugin_dir_path(__FILE__), 'arngren_net.html'));
        $this->$dom = new DOMDocument();
    }

    public function get_images(string $html): DOMNOdeList
    {
        $images = $html->getElementsByTagName('img');
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

    set_image_alt(DOMElement $element, string $alt): DOMElement
    {
        $element->setAttribute('alt',$alt)
        return $element;
    }

    get_image_src(DOMElement $element): ?string
    {
        $src = $element->getAttribute('src');
        if($src = ''){
            return null;
        }
        return $src;
    }

    set_image_src(DOMElement $element): ?string
    {
        $src = $element->getAttribute('src');
        if($src = ''){
            return null;
        }
        return $src;
    }

    set_image_alts(string $html, $map[]<string => string>): string
    {
        $images = get_images($html);
        $element; 
        foreach ($images as &$image) {
            $element = $dom->createElement('img', $image);

        }
    }

}