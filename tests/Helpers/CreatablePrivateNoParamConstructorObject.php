<?php

namespace NorseBlue\CreatableObjects\Tests\Helpers;

use NorseBlue\CreatableObjects\Contracts\Creatable;
use NorseBlue\CreatableObjects\Traits\HandlesObjectCreation;

class CreatablePrivateNoParamConstructorObject implements Creatable
{
    use HandlesObjectCreation;

    private function __construct()
    {
    }
}
