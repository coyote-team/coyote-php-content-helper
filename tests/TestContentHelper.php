<?php

declare(strict_types=1);
use PHPUnit\Framework\TestCase;
include 'ContentHelper.php';


class TestContentHelper extends TestCase
{
    protected string $contents;
    protected DOMDocument $doc;

    public function setUp(): void
    {
        $contents = file_get_contents(join(DIRECTORY_SEPARATOR, [getcwd(), 'arngren_net.html']));
        $doc = new DOMDocument();
    }

    public function testCreateContentHelper(){
        $helper = new ContentHelper("<img src='foo.jpg'>");
        $this->assertInstanceOf(ContentHelper::class, $helper);
    }

    public function testGetImages(){
        $helper = new ContentHelper("<img src='foo.jpg'>");
        $images = $helper->get_images();
        $this->assertCount(1, $images);

    }

    public function testGetImagesSrc(){
        $helper = new ContentHelper("<img src='foo.jpg'>");
        $images = $helper->get_images();
        $src = $images[0]->src;
        $this->assertEquals($src, 'foo.jpg');
    }

    public function testIgnoreNoSrcImage(){
        $helper = new ContentHelper("<img>");
        $images = $helper->get_images();
        $this->assertCount(0, $images);
    }

}