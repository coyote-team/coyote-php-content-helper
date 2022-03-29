<?php

declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require_once('vendor/autoload.php');
use ContentHelper\Image;
use ContentHelper\WordPressImage;

class TestWordPressImage extends TestCase{



    /**
     * @dataProvider beforeAfterData
     */
    public function testCaptionExtraction($expectedResults, $input){
        [$before_content, $after_content] = $input;
        $testImage = new Image('src','alt','class',$before_content, $after_content);
        $testWordPressImage = new WordPressImage($testImage);

        $this->assertSame($expectedResults, $testWordPressImage->getCaption());
    }

    private function beforeAfterData(): array
    {
        return [
            [
                '',
                ['before','after'],
            ],
            [
                'This is a test caption',
                ['','This is a test caption[/caption]'],
            ],
            [
                '',
                ['',''],
            ],
        ];
    }

        /**
     * @dataProvider beforeAfterDataWPAttachment
     */
    public function testWPAttachmentExtraction($expectedResults, $input){
        $testImage = new Image('src','alt',$input,'before_content', 'after_content');
        $testWordPressImage = new WordPressImage($testImage);

        $this->assertSame($expectedResults, $testWordPressImage->getWordPressAttachmentUrl());
    }

    private function beforeAfterDataWPAttachment(): array
    {
        return [
            [
                'wp-image-10',
                'class/wordpress/wp-image-10',
            ],
            [
                '',
                'there is no wp attachment',
            ],
            [
                '',
                '',
            ],
        ];
    }

}