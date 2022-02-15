<?php

declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require_once('vendor/autoload.php');


class TestContentHelper extends TestCase
{

    public function testCreateContentHelper(){
        $helper = new ContentHelper("<img src='foo.jpg'>");
        $this->assertInstanceOf(ContentHelper::class, $helper);
    }

    public function testGetImages(){
        $helper = new ContentHelper("<img src='foo.jpg'>");
        $images = $helper->get_images();
        $this->assertCount(1, $images);

    }

    public function testIgnoreNoSrcImage(){
        $helper = new ContentHelper("<img>");
        $images = $helper->get_images();
        $this->assertCount(0, $images);
    }

    public function testGetImagesSrc(){
        $helper = new ContentHelper("<img src='foo.jpg'>");
        $images = $helper->get_images();
        $src = $images[0]->src;
        $this->assertEquals($src, 'foo.jpg');
    }

    public function testNoImagesAtAll(){
        $helper = new ContentHelper("<html></html>");
        $images = $helper->get_images();
        $this->assertCount(0, $images);
    }

    public function testReturnsImageInstanceArray(){
        $helper = new ContentHelper("<img src='foo.jpg'>");
        $images = $helper->get_images();
        $this->assertInstanceOf(ContentHelper\Image::class, array_pop($images));
    }

    public function testSetAltWithMap(){
        $helper = new ContentHelper("<img src='foo.jpg'><img src='boo.jpg'><img src='notthere.jpg'>");
        $map = ['foo.jpg' => 'one', 'boo.jpg' => 'two', 'fail.jpg' => 'shouldnt work'];
        
        $newText = $helper->set_image_alts($map);
        $newHelper = new ContentHelper($newText);
        
        $images = $newHelper->get_images();
        
        $alt1 = $images[0]->alt;
        $alt2 = $images[1]->alt;
        $alt3 = $images[2]->alt;

        $this->assertEquals($alt1, 'one');
        $this->assertEquals($alt2, 'two');
        $this->assertEquals($alt3, '');
    }

    public function testNoSrcInHTMLMatchingMapSrc(){
        $helper = new ContentHelper("<img src='foo.jpg'>");
        $map = ['fo.jpg' => 'one', 'bo.jpg' => 'two', 'fail.jpg' => 'shouldnt work'];
        
        $newText = $helper->set_image_alts($map);
        $newHelper = new ContentHelper($newText);
        
        $images = $newHelper->get_images();
        
        $this->assertCount(1, $images);
    }

    public function testChangeAltFromCurrentWithMap(){
        $helper = new ContentHelper("<img src='foo.jpg' alt='three'><img src='boo.jpg' alt='four'><img src='notthere.jpg' alt='five'>");
        $map = ['foo.jpg' => 'one', 'boo.jpg' => 'two', 'fail.jpg' => 'shouldnt work'];
        
        $newText = $helper->set_image_alts($map);
        $newHelper = new ContentHelper($newText);
        
        $images = $newHelper->get_images();
        
        $alt1 = $images[0]->alt;
        $alt2 = $images[1]->alt;
        $alt3 = $images[2]->alt;

        $this->assertEquals($alt1, 'one');
        $this->assertEquals($alt2, 'two');
        $this->assertEquals($alt3, 'five');
    }

    public function testChangeElementsWithSameSrc(){
        $helper = new ContentHelper("<img src='foo.jpg' alt='three'><img src='foo.jpg' alt='four'><img src='notthere.jpg' alt='five'>");
        $map = ['foo.jpg' => 'one', 'boo.jpg' => 'two', 'fail.jpg' => 'shouldnt work'];
        
        $newText = $helper->set_image_alts($map);
        $newHelper = new ContentHelper($newText);
        
        $images = $newHelper->get_images();
        
        $alt1 = $images[0]->alt;
        $alt2 = $images[1]->alt;
        $alt3 = $images[2]->alt;

        $this->assertEquals($alt1, 'one');
        $this->assertEquals($alt2, 'one');
        $this->assertEquals($alt3, 'five');
    }

    public function testChangingSingleAltWithOneSrc(){
        $helper = new ContentHelper("<img src='foo.jpg'><img src='boo.jpg'>");

        $newHtml = $helper->set_image_alt("foo.jpg", "test");
        $newHelper = new ContentHelper($newHtml);

        $images = $newHelper->get_images();

        $alt1 = $images[0]->alt;

        $this->assertEquals($alt1, 'test');
    }

    public function testChangingSingleAltWithMultipleSrcs(){
        $helper = new ContentHelper("<img src='foo.jpg'><img src='boo.jpg'><img src='foo.jpg'>");

        $newHtml = $helper->set_image_alt("foo.jpg", "test");
        $newHelper = new ContentHelper($newHtml);

        $images = $newHelper->get_images();

        $alt1 = $images[0]->alt;
        $alt2 = $images[2]->alt;

        $this->assertEquals($alt1, 'test');
        $this->assertEquals($alt2, 'test');
    }

    public function testNoChangeForSingleAltWithMultipleSrcs(){
        $helper = new ContentHelper("<img src='foo.jpg'><img src='boo.jpg'><img src='foo.jpg'>");

        $newHtml = $helper->set_image_alt("hi.jpg", "test");
        $newHelper = new ContentHelper($newHtml);

        $images = $newHelper->get_images();

        $alt1 = $images[0]->alt;
        $alt2 = $images[2]->alt;

        $this->assertEquals($alt1, '');
        $this->assertEquals($alt2, '');
    }

    public function testChangeExistingAltForSrc(){
        $helper = new ContentHelper("<img src='foo.jpg' alt='one'><img src='boo.jpg'><img src='foo.jpg' alt='two'>");
        
        $newHtml = $helper->set_image_alt("foo.jpg", "test");
        $newHelper = new ContentHelper($newHtml);

        $images = $newHelper->get_images();

        $alt1 = $images[0]->alt;
        $alt2 = $images[2]->alt;

        $this->assertEquals($alt1, 'test');
        $this->assertEquals($alt2, 'test');
    }
}