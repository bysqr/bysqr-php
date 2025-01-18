<?php


namespace Bysqr;


readonly class Encoder
{
    public function __construct(
        protected Pay $document
    ) { }

    /**
     * Encode document to the SVG image.
     */
    public function toSvg(Theme $theme = Theme::BLUE): string
    {
        $bin = Binary::get();

        $serialized = (new Serializer)->serialize($this->document);

        return $bin->encode(['--src', $serialized, '--format', 'svg']);
    }

    /**
     * Encode document to base64 JPEG image.
     */
    public function toJpeg(Theme $theme = Theme::BLUE, int $size = 512, int $quality = 90): string
    {
        $bin = Binary::get();

        $serialized = (new Serializer)->serialize($this->document);

        return $bin->encode(['--src', $serialized, '--format', 'jpeg', '--quality', $quality, '--size', $size]);
    }

    /**
     * Encode document to base64 PNG image.
     */
    public function toPng(Theme $theme = Theme::BLUE, int $size = 512): string
    {
        $bin = Binary::get();

        $serialized = (new Serializer)->serialize($this->document);

        return $bin->encode(['--src', $serialized, '--format', 'png', '--size', $size]);
    }

    /**
     * Create new encoder instance.
     */
    public static function make(Pay $document): static
    {
        return new static($document);
    }
}
