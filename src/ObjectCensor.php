<?php

namespace Censor;

use Censor\ObjectCensorClasses\Text;

class ObjectCensor extends AbstractCensor
{
    public function __invoke(array $censoredWords, string $text) : string
    {
        $textObject = new Text($text);

        foreach ($censoredWords as $word) {
            $textObject->censoreWord($word);
        }

        return $textObject;
    }
}
