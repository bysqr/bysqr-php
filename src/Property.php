<?php


namespace Bysqr;


use Attribute;

#[Attribute]
readonly class Property
{
    public function __construct(
        public ?string $name = null,
        public ?string $wrap = null,
    ) { }
}
