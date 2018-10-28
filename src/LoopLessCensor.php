<?php

namespace Censor;

class LoopLessCensor extends AbstractCensor
{
    public function __invoke(array $censoredWords, string $text) : string
    {
        // Generate a regular expression for each word with array mapping
        $regExps = array_map([$this, 'wordInTextRegExp'], $censoredWords);

        // Match regular expressions in text and replace them using a closure function
        $censoredText = preg_replace_callback($regExps, function($matches) {
            return $this->censoreWord($matches[0]);
        }, $text);

        return $censoredText;
    }

    /**
     * Generates a regular expression that matches the word passed by parameter inside a text.
     * The regular expression is not case sensitive and the delimit is any but letters.
     * Overriding this method in a child class the matching criteria can be chagned.
     */
    protected function wordInTextRegExp(string $word) : string
    {
        return '/(?<!\w)' . preg_quote($word) . '(?!\w)/i';
    }

    /**
     * Generate the censored replacement for a word given.
     * Overriding this method in a child class the censuration mode can be changed.
     */
    protected function censoreWord(string $word) : string
    {
        return str_repeat('*', strlen($word));
    }
}
