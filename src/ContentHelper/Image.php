<?php

namespace Coyote\ContentHelper;

class Image
{
    private string $src;
    private ?string $alt;
    private ?string $class;
    private ?string $contentBefore;
    private ?string $contentAfter;
    private ?string $figureCaption;

    public function __construct(
        string $src,
        string $alt = '',
        ?string $class = null,
        string $contentBefore = null,
        string $contentAfter = null,
        string $figureCaption = null
    ) {
        $this->src = $src;
        $this->alt = $alt;
        $this->class = $class;
        $this->contentBefore = $contentBefore;
        $this->contentAfter = $contentAfter;
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

    public function getAlt(): string
    {
        return $this->alt;
    }

    public function getContentBefore(): ?string
    {
        return $this->contentBefore;
    }

    public function getContentAfter(): ?string
    {
        return $this->contentAfter;
    }

    public function getFigureCaption(): ?string
    {
        return $this->figureCaption;
    }
}
