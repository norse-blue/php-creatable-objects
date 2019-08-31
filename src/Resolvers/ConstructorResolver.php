<?php

declare(strict_types=1);

namespace NorseBlue\CreatableObjects\Resolvers;

use NorseBlue\CreatableObjects\Exceptions\UnresolvableConstructorException;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

final class ConstructorResolver
{
    /** @var array<string, ReflectionMethod> */
    private static $cache = [];

    /**
     * Gets the class constructor reflection method.
     *
     * @param string $class
     *
     * @return \ReflectionMethod
     */
    private static function getConstructor(string $class): ReflectionMethod
    {
        try {
            $constructor = (new ReflectionClass($class))->getMethod('__construct');
            // @codeCoverageIgnoreStart
        } catch (ReflectionException $exception) {
            throw new UnresolvableConstructorException(
                'Cannot resolve constructor for class ' . $class . '.',
                $exception->getCode(),
                $exception,
            );
            // @codeCoverageIgnoreEnd
        }

        return $constructor;
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
        if (!array_key_exists($class, self::$cache)) {
            self::$cache[$class] = self::getConstructor($class);
        }

        return self::$cache[$class];
    }
}
