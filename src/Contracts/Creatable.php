<?php

declare(strict_types=1);

namespace NorseBlue\CreatableObjects\Contracts;

interface Creatable
{
    /**
     * Creates a new instance.
     *
     * @return mixed
     */
    public static function create();
}
