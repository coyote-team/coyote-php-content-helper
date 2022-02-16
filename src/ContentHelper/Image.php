<?php

namespace ContentHelper;

class Image {
    public readonly string $src;
    public readonly ?string $alt;
    public readonly ?string $class;

    public function __construct(string $src, string $alt, string $class)
    {
        $this->src = $src;
        $this->alt = $alt;
        $this->class = $class;
    }
}