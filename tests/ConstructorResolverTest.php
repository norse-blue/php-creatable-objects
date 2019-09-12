<?php

declare(strict_types=1);

namespace NorseBlue\CreatableObjects\Tests;

use NorseBlue\CreatableObjects\Resolvers\ConstructorResolver;
use NorseBlue\CreatableObjects\Tests\Helpers\CreatablePrivateConstructorObject;
use NorseBlue\CreatableObjects\Tests\Helpers\CreatableProtectedConstructorObject;
use NorseBlue\CreatableObjects\Tests\Helpers\CreatablePublicConstructorObject;

class ConstructorResolverTest extends TestCase
{
    /** @test */
    public function splits_private_constructor_params_correctly()
    {
        $subject = ConstructorResolver::splitParamsForConstructor(CreatablePrivateConstructorObject::class, [
            'value',
            9,
            'unused',
        ]);

        $this->assertEquals([
            'required' => [
                'value',
            ],
            'optional' => [
                9,
            ],
            'extra' => [
                'unused',
            ],
        ], $subject);
    }

    /** @test */
    public function splits_protected_constructor_params_correctly()
    {
        $subject = ConstructorResolver::splitParamsForConstructor(CreatableProtectedConstructorObject::class, [
            'value',
            9,
            'unused',
        ]);

        $this->assertEquals([
            'required' => [
                'value',
            ],
            'optional' => [
                9,
            ],
            'extra' => [
                'unused',
            ],
        ], $subject);
    }

    /** @test */
    public function splits_public_constructor_params_correctly()
    {
        $subject = ConstructorResolver::splitParamsForConstructor(CreatablePublicConstructorObject::class, [
            'value',
            9,
            'unused',
        ]);

        $this->assertEquals([
            'required' => [
                'value',
            ],
            'optional' => [
                9,
            ],
            'extra' => [
                'unused',
            ],
        ], $subject);
    }
}
