<?php

namespace Censor\ObjectCensorClasses;

class CensoredWord extends Word
{
    /**
     * Overrided method to represent the censored word with asterisks.
     */
    public function __toString() : string
    {
        return str_repeat('*', count($this->characters));
    }
}