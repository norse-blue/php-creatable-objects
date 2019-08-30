<?php

namespace NorseBlue\CreatableObjects\Tests\Helpers;

use NorseBlue\CreatableObjects\CreatableObject;

class CreatableProtectedNoParamConstructorObject extends CreatableObject
{
    protected function __construct()
    {
    }
}
