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
    private static array $cache = [];

    /**
     * Resolves the class constructor reflection method.
     */
    public static function resolve(string $class): ReflectionMethod
    {
        if (array_key_exists($class, self::$cache)) {
            return self::$cache[$class];
        }

        try {
            $constructor = (new ReflectionClass($class))->getMethod('__construct');
        } catch (ReflectionException $exception) {
            throw new UnresolvableConstructorException(
                'Cannot resolve constructor for class ' . $class . '.',
                $exception->getCode(),
                $exception,
            );
        }

        return self::$cache[$class] = $constructor;
    }

    /**
     * Split the given parameters array in 'required', 'optional' and 'extra' sub-arrays
     * as specified by the constructor signature.
     *
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
