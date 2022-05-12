<?php

namespace Coyote\ContentHelper;

class Image
{
    private string $src;
    private ?string $alt;
    private ?string $class;
    private ?string $content_before;
    private ?string $content_after;

    public function __construct(
        string $src,
        string $alt,
        string $class,
        string $content_before = '',
        string $content_after = ''
    ) {
        $this->src = $src;
        $this->alt = $alt;
        $this->class = $class;
        $this->content_before = $content_before;
        $this->content_after = $content_after;
    }


    /**
     * @return string
     */
    public function getSrc(): string
    {
        return $this->src;
    }

    /**
     * @return string|null
     */
    public function getClass(): ?string
    {
        return $this->class;
    }

    /**
     * @return string|null
     */
    public function getAlt(): ?string
    {
        return $this->alt;
    }

    /**
     * @return string|null
     */
    public function getContentBefore(): ?string
    {
        return $this->content_before;
    }

    /**
     * @return string|null
     */
    public function getContentAfter(): ?string
    {
        return $this->content_after;
    }
}
