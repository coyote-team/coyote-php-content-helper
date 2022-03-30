<?php

namespace ContentHelper;

use ContentHelper\Image;

class WordPressImage
{
    private string $caption;
    private ?string $wordPressAttachmentUrl;
    private Image $image;

    private const AFTER_REGEX = '/([^>]*?)(?=\[\/caption])/smi';
    private const IMG_ATTACHMENT_REGEX = '/wp-image-(\d+)/smi';

    public function __construct(Image $image)
    {
        $matches = array();
        $this->image = $image;
        $this->caption = '';
        $this->wordPressAttachmentUrl = null;

        if (preg_match(self::AFTER_REGEX, $image->content_after, $matches) === 1) {
            $this->caption = $matches[0];
        }

        if (preg_match(self::IMG_ATTACHMENT_REGEX, $image->class, $matches) === 1) {
            $attachment_url = wp_get_attachment_url(intval($matches[1]));

            if ($attachment_url !== false) {
                $this->wordPressAttachmentUrl = $attachment_url;
            }
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

    public function getWordPressAttachmentUrl(): ?string
    {
        return $this->wordPressAttachmentUrl;
    }
}
