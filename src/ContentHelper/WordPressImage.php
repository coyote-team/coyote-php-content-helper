<?php

namespace ContentHelper;
use ContentHelper\Image;

class WordPressImage {
    private string $caption;
    private Image $image;

    const AFTER_REGEX = '/([^>]*?)(?=\[\/caption])/smi';

    public function __construct(Image $image)
    {
        $matches = array();
        $this->image = $image;
        $this->caption = '';

        if(preg_match(self::AFTER_REGEX, $image->content_after, $matches) === 1){
            $this->caption = $matches[0];
        }

    }

    public function getSrc(): string
    {
        return $this->image->src;
    }

    public function getCaption(): string 
    {
        return $this->caption;
    }

    public function getAlt(): string 
    {
        return $this->image->alt;
    }

    public function getClass(): string
    {
        return $this->image->class;
    }
}