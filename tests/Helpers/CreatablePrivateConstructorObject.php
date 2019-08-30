<?php

namespace NorseBlue\CreatableObjects\Tests\Helpers;

use NorseBlue\CreatableObjects\Contracts\Creatable;
use NorseBlue\CreatableObjects\Traits\HandlesObjectCreation;

class CreatablePrivateConstructorObject implements Creatable
{
    use HandlesObjectCreation;

    /** @var int */
    public $count;
    /** @var string */
    public $name;

    private function __construct(string $name, int $count = 0)
    {
        $this->name = $name;
        $this->count = $count;
    }
}
