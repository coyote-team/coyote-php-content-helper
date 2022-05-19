<?php

namespace Coyote\ContentHelper;

class Image
{
    private string $src;
    private ?string $alt;
    private ?string $class;
    private ?string $content_before;
    private ?string $content_after;
    private ?string $figureCaption;

    public function __construct(
        string $src,
        string $alt,
        string $class,
        string $content_before = '',
        string $content_after = '',
        string $figureCaption = null
    ) {
        $this->src = $src;
        $this->alt = $alt;
        $this->class = $class;
        $this->content_before = $content_before;
        $this->content_after = $content_after;
        $this->figureCaption = $figureCaption;
    }

    public function getSrc(): string
    {
        return $this->src;
    }

    public function getClass(): ?string
    {
        return $this->class;
    }

    public function getAlt(): ?string
    {
        return $this->alt;
    }

    public function getContentBefore(): ?string
    {
        return $this->content_before;
    }

    public function getContentAfter(): ?string
    {
        return $this->content_after;
    }

    public function getFigureCaption(): ?string
    {
        return $this->figureCaption;
    }
}
