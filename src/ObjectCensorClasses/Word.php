<?php

namespace Censor\ObjectCensorClasses;

class Word extends TextElement
{
    protected $characters;

    public function __construct(string $chars)
    {
        $this->characters = [];

        foreach (str_split($chars) as $char) {
            $this->characters[] = new WordCharacter($char);
        }
    }

    /**
     * Return the number of characters of the word.
     */
    public function getLength() : int
    {
        return count($this->characters);
    }

    /**
     * Determines if this word is the same than another Word type object.
     */
    public function equals(Word $obj) : bool
    {
        $wordLength = $this->getLength();
        if ($wordLength === $obj->getLength()) {
            $i = 0;
            while ($i < $wordLength) {
                if (!$this->characters[$i]->equals($obj->characters[$i]))
                    break;
                $i++;
            }
            return $i === $wordLength;
        }

        return false;
    }

    public function __toString() : string
    {
        return join($this->characters);
    }

    public function __clone()
    {
        foreach ($this->characters as $ind => $elem) {
            $this->elements[$ind] = clone $elem;
        }
    }
}