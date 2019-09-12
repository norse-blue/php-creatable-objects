<?php

declare(strict_types=1);

namespace NorseBlue\CreatableObjects\Resolvers;

use NorseBlue\CreatableObjects\Exceptions\MissingRequiredParametersException;
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

    /**
     * Split the given parameters array in 'required', 'optional' and 'extra' sub-arrays
     * as specified by the constructor signature.
     *
     * @param string $class
     * @param array<mixed> $parameters
     *
     * @return array<array<mixed>>
     */
    public static function splitParamsForConstructor(string $class, array $parameters): array
    {
        $constructor = self::resolve($class);

        if (count($parameters) < $constructor->getNumberOfRequiredParameters()) {
            throw new MissingRequiredParametersException(
                'Missing parameters for constructor call of class ' . $class,
                $constructor->getNumberOfRequiredParameters(),
                count($parameters),
            );
        }

        return [
            'required' => array_slice($parameters, 0, $constructor->getNumberOfRequiredParameters()),
            'optional' => array_slice(
                $parameters,
                $constructor->getNumberOfRequiredParameters(),
                $constructor->getNumberOfParameters() - $constructor->getNumberOfRequiredParameters()
            ),
            'extra' => array_slice($parameters, $constructor->getNumberOfParameters()),
        ];
    }
}
