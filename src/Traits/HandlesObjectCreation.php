<?php

declare(strict_types=1);

namespace NorseBlue\CreatableObjects\Traits;

use NorseBlue\CreatableObjects\Resolvers\ConstructorResolver;

trait HandlesObjectCreation
{
    /**
     * Creates a new instance.
     */
    public static function create(mixed ...$params): static
    {
        $splitted_params = ConstructorResolver::splitParamsForConstructor(static::class, $params);

        return new static(...array_merge($splitted_params['required'], $splitted_params['optional']));
    }
}
