<?php

declare(strict_types=1);

namespace NorseBlue\CreatableObjects\Contracts;

interface Creatable
{
    /**
     * Creates a new instance.
     */
    public static function create(mixed ...$params): mixed;
}
