<?php

namespace NorseBlue\CreatableObjects\Tests\Helpers;

use NorseBlue\CreatableObjects\CreatableObject;

class CreatablePublicConstructorObject extends CreatableObject
{
    /** @var int */
    public $count;
    /** @var string */
    public $name;

    public function __construct(string $name, int $count = 0)
    {
        $this->name = $name;
        $this->count = $count;
    }
}
