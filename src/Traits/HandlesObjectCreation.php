<?php

declare(strict_types=1);

namespace NorseBlue\CreatableObjects\Traits;

use NorseBlue\CreatableObjects\Resolvers\ConstructorResolver;

trait HandlesObjectCreation
{
    /**
     * Creates a new instance.
     *
     * @param mixed ...$parameters
     *
     * @return static
     */
    public static function create(...$parameters): self
    {
        $params = ConstructorResolver::splitParamsForConstructor(static::class, $parameters);

        return new static(...array_merge($params['required'], $params['optional']));
    }
}
