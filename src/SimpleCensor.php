<?php

namespace Censor;

class SimpleCensor extends AbstractCensor
{
    // List of chars to remove from around each word before matching
    protected const TRIM_CHARS = ".,:'\"¿?¡!\r\t";

    public function __invoke(array $censoredWords, string $text) : string
    {
        $lowerCensoredWords = array_map('mb_strtolower', $censoredWords);

        $lines = explode("\n", $text);

        for ($i = 0; $i < count($lines); $i++) {

            if (!strlen($lines[$i])) continue;

            $words = explode(' ', $lines[$i]);

            for ($j = 0; $j < count($words); $j++) {

                if (!strlen($words[$j])) continue;

                $cleanWord = trim($words[$j], self::TRIM_CHARS);
                $lowerWord = mb_strtolower($cleanWord);
                
                if (in_array($lowerWord, $lowerCensoredWords)) {
                    $asterisks = str_repeat('*', strlen($cleanWord));
                    $words[$j] = str_replace($cleanWord, $asterisks, $words[$j]);
                }
            }

            $lines[$i] = implode(' ', $words);
        }

        $result = implode("\n", $lines);

        return $result;
    }
}
