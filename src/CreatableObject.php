<?php

declare(strict_types=1);

namespace NorseBlue\CreatableObjects;

use NorseBlue\CreatableObjects\Contracts\Creatable;
use NorseBlue\CreatableObjects\Traits\HandlesObjectCreation;

abstract class CreatableObject implements Creatable
{
    use HandlesObjectCreation;
}
