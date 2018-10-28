<?php

namespace Censor\ObjectCensorClasses;

class WordCharacter extends Character
{
    /**
     * Check if a char passed by parameter is valid to be part of a word of text.
     */
    public static function isValidChar(string $char) : bool
    {
        return preg_match('/^\w$/i', $char);
    }

    /**
     * Determines if this character is the same than another Character type object.
     * The comparation is case insensitive, unlike parent class.
     */
    public function equals(Character $obj) : bool
    {
        return strcasecmp($this, $obj) === 0;
    }
}