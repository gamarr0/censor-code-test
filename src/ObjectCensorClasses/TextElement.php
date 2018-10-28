<?php

namespace Censor\ObjectCensorClasses;

abstract class TextElement
{
    abstract public function __toString() : string;
}