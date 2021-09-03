<?php

declare(strict_types=1);

namespace NorseBlue\CreatableObjects\Resolvers;

use JetBrains\PhpStorm\ArrayShape;
use NorseBlue\CreatableObjects\Exceptions\MissingRequiredParametersException;
use NorseBlue\CreatableObjects\Exceptions\UnresolvableConstructorException;
use ReflectionClass;
use ReflectionException;
use ReflectionMethod;

/**
 * @internal
 */
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
            if (! class_exists($class)) {
                // @codeCoverageIgnoreStart
                throw new UnresolvableConstructorException(
                    'The given class ' . $class . ' does not exist.',
                );
                // @codeCoverageIgnoreEnd
            }

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
     * @param array<mixed> $params
     *
     * @phpstan-return array{'required': array<mixed>, 'optional': array<mixed>, 'extra': array<mixed>}
     */
    #[ArrayShape(['required' => 'array<mixed>', 'optional' => 'array<mixed>', 'extra' => 'array<mixed>'])]
    public static function splitParamsForConstructor(string $class, array $params): array
    {
        $constructor = self::resolve($class);

        if (count($params) < $constructor->getNumberOfRequiredParameters()) {
            throw new MissingRequiredParametersException(
                'Missing parameters for constructor call of class ' . $class,
                $constructor->getNumberOfRequiredParameters(),
                count($params),
            );
        }

        return [
            'required' => array_slice($params, 0, $constructor->getNumberOfRequiredParameters()),
            'optional' => array_slice(
                $params,
                $constructor->getNumberOfRequiredParameters(),
                $constructor->getNumberOfParameters() - $constructor->getNumberOfRequiredParameters()
            ),
            'extra' => array_slice($params, $constructor->getNumberOfParameters()),
        ];
    }
}
