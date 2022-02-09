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
        $helper = new ContentHelper();
        $this->assertInstanceOf(ContentHelper::class, $helper);
    }


}