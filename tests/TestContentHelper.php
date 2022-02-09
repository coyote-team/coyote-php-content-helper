<?php

declare(strict_types=1);
use PHPUnit\Framework\TestCase;


class TestContentHelper extends TestCase
{
    protected string $contents;
    protected DOMDocument $doc;

    public function setUp(): void
    {
        $contents = file_get_contents(join(DIRECTORY_SEPARATOR, [getcwd(), 'arngren_net.html']));
        $doc = new DOMDocument();
    }

    /*
        Given an html string we can get all of the image elements
    */
    public function testGetImages(): void
    {
        $images = ContentHelper->get_images($contents);
        $num = count($images);
        $this->assertNumeric($num);
    }

    /*
        Creates a new image element with an alt attribute of 'testing',
        and checks to see if it can be retrieved
    */
    public function testGetImageAlt(): void
    {
        $element = $doc->createElement('img');
        $newelement = $doc->appendChild($element);
        $newelement->setAttribute('alt','testing');
        $attr = ContentHelper->get_image_alt($newelement);
        $this->asserEquals(
            'testing',
            $attr,
            "The attribute is not equal to the element"
        );
    }

    /*
        Creates a new image element with the alt text of 'testing'
        and then sets it to a new alt text of 'new alt'
    */
    public function testSetImageAlt(): void
    {
        $element = $doc->createElement('img');
        $newelement = $doc->appendChild($element);
        $newelement->setAttribute('alt','testing');
        $newelement = ContentHelper->set_image_alt($newelement, 'new alt');
        $this->assertEquals(
            'new alt',
            $newelement->getAttribute('alt'),
            "The attribute was not set to the new alt"
        );
    }

    /*
        Creates a new image element with src attribute of 'testing src',
        then gets the source using the ContentHelper function checking if it is set to 'testing src'
    */
    public function testGetImageSrc(): void
    {
        $element = $doc->createElement('img');
        $newelement = $doc->appendChild($element);
        $newelement->setAttribute('src','testing src');
        $attr = ContentHelper->get_image_src($newelement);
        $this->assertEquals(
            'testing src',
            $attr,
            "The src attribute was not set appropriately"
        );
    }

    /*
        Creates a new image element with the src attribute of 'testing src'
        and then sets it to a new src value of 'new src'
    */
    public function testSetImageSrc(): void
    {
        $element = $doc->createElement('img');
        $newelement = $doc->appendChild($element);
        $newelement->setAttribute('src','testing src');
        $newelement = ContentHelper->set_image_src($newelement, 'new src');
        $this->assertEquals(
            'new src',
            $newelement->getAttribute('src'),
            "The attribute was not set to the new src"
        );
    }
    
    /*
        Creates a new image element with class attribute of 'testing class',
        then gets the source using the ContentHelper function checking 
        if it is set to 'testing class'
    */
    public function testGetImageClass(): void
    {
        $element = $doc->createElement('img');
        $newelement = $doc->appendChild($element);
        $newelement->setAttribute('class','testing class');
        $attr = ContentHelper->get_image_src($newelement);
        $this->assertEquals(
            'testing class',
            $attr,
            "The class attribute was not found"
        );
    }


}