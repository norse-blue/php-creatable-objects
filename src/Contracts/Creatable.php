<?php

declare(strict_types=1);

namespace NorseBlue\CreatableObjects\Contracts;

interface Creatable
{
    /**
     * Creates a new instance.
     *
     * @param mixed ...$params
     *
     * @return mixed
     */
    public static function create(...$params);
}
