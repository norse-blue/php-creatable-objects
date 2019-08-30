<?php

declare(strict_types=1);

namespace NorseBlue\CreatableObjects\Resolvers;

use NorseBlue\CreatableObjects\Exceptions\UnresolvableConstructorException;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

final class ConstructorResolver
{
    /**
     * Gets the class methods.
     *
     * @param string $class
     *
     * @return array<string, ReflectionMethod>
     *
     * @throws \ReflectionException
     */
    protected static function getClassMethods(string $class): array
    {
        return array_reduce(
            (new ReflectionClass($class))->getMethods(),
            static function ($carry, $item) {
                $carry[$item->name] = $item;

                return $carry;
            },
            []
        );
    }

    /**
     * Check if the class constructor is accessible.
     *
     * @param string $class
     *
     * @return \ReflectionMethod
     */
    public static function resolve(string $class): ReflectionMethod
    {
        try {
            $methods = self::getClassMethods($class);
            // @codeCoverageIgnoreStart
        } catch (ReflectionException $exception) {
            throw new UnresolvableConstructorException(
                'An error occurred while resolving constructor for class ' . $class . '.',
                $exception->getCode(),
                $exception,
            );
            // @codeCoverageIgnoreEnd
        }

        if (!in_array('__construct', array_keys($methods))) {
            throw new UnresolvableConstructorException(
                'Cannot resolve constructor for class ' . $class . '.',
            );
        }

        return $methods['__construct'];
    }
}
