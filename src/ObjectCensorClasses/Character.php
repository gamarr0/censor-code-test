<?php

namespace Censor\ObjectCensorClasses;

class Character extends TextElement
{
    protected $char;

    public function __construct(string $char)
    {
        $this->char = $char;
    }

    /**
     * Determines if this character is the same than another Character type object.
     */
    public function equals(Character $obj) : bool
    {
        return strcmp($this, $obj) === 0;
    }

    public function __toString() : string
    {
        return $this->char;
    }
}