<?php

namespace ContentHelper;

class Image {
    public readonly string $src;
    public readonly ?string $alt;
    public readonly ?string $caption;
    public readonly ?string $class;

    public function __construct(string $src, string $alt, string $caption, string $class)
    {
        $this->src = $src;
        $this->alt = $alt;
        $this->caption = $caption;
        $this->class = $class;
    }
}