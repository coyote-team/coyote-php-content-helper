<?php

declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require_once('vendor/autoload.php');
use ContentHelper\Image;
use ContentHelper\WordPressImage;

/**
 * wp_get_attachment_url is a dummy function used to represent the
 * function of the same name given in wordpress. It is only used for the
 * purpose of testing outside of the wordpress enviroment. 
 */
function wp_get_attachment_url(int $attachment_id){
    if($attachment_id === 10){
        return strval($attachment_id);
    }

    return false;
}

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
                '10',
                'class/wordpress/wp-image-10',
            ],
            [
                null,
                'there is no wp attachment',
            ],
            [
                null,
                '',
            ],
            /* This test is only a case for our dummy function where attachmentid != 10
                With the real wp_get_attachment_url function this would pass */
            [
                null,
                'class/wordpress/wp-image-22',
            ],
        ];
    }

}