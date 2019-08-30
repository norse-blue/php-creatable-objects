<?php

declare(strict_types=1);

namespace NorseBlue\CreatableObjects\Traits;

use NorseBlue\CreatableObjects\Exceptions\MissingRequiredParametersException;
use NorseBlue\CreatableObjects\Resolvers\ConstructorResolver;

trait HandlesObjectCreation
{
    /**
     * Creates a new instance.
     *
     * @param mixed ...$params
     *
     * @return static
     */
    public static function create(...$params): self
    {
        $constructor = ConstructorResolver::resolve(static::class);

        if (count($params) < $constructor->getNumberOfRequiredParameters()) {
            throw new MissingRequiredParametersException(
                'Missing parameters for constructor call of class ' . static::class,
                $constructor->getNumberOfRequiredParameters(),
                count($params),
            );
        }

        $params = array_slice($params, 0, $constructor->getNumberOfParameters());

        return new static(...$params);
    }
}
