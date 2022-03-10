<?php

namespace ContentHelper;
use ContentHelper\Image;

class WordPressImage {
    private readonly string $caption;
    private readonly Image $image;

    public function __construct(Image $image, string $caption)
    {
        $this->caption = $caption;
        $this->image = $image;
    }

    public function getSrc(): string
    {
        return $this->image->src;
    }

    public function getCaption(): string 
    {
        return $this->$caption;
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