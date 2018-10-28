<?php

namespace Censor\ObjectCensorClasses;

class Text
{
    protected $elements;

    public function __construct(string $textString)
    {
        if (strlen($textString))
            $this->elements = $this->getElementsFromString($textString);
        else
            $this->elements = [];
    }

    /**
     * Censure all occurences of the given word in the text.
     */
    public function censoreWord(string $word) : void
    {
        if (strlen($word)) {
            $censoredWord = new CensoredWord($word);
            
            foreach($this->elements as $ind => $element) {
                if ($element instanceOf Word) {
                    if ($censoredWord->equals($element)) {
                        $this->elements[$ind] = clone $censoredWord;
                    }
                }
            }
        }
    }

    /**
     * Parses a string to get a list of elements of type TextElement.
     */
    protected function getElementsFromString(string $textString) : array
    {
        $result = [];

        $currentWordString = '';
        foreach (str_split($textString) as $char) {
            if (WordCharacter::isValidChar($char)) {
                $currentWordString .= $char;
            } else {
                if ($currentWordString !== '') {
                    $result[] = new Word($currentWordString);
                    $currentWordString = '';
                }
                $result[] = new Character($char);
            }
        }

        return $result;
    }

    public function __toString() : string
    {
        return join($this->elements);
    }

    public function __clone()
    {
        foreach ($elements as $ind => $elem) {
            $this->elements[$ind] = clone $elem;
        }
    }
}