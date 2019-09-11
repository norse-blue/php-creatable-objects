<?php

namespace NorseBlue\CreatableObjects\Tests\CreatableObject;

use NorseBlue\CreatableObjects\Tests\Helpers\CreatablePrivateNoParamConstructorObject;
use NorseBlue\CreatableObjects\Tests\TestCase;

class CreatablePrivateNoParamsConstructorObjectTest extends TestCase
{
    /** @test */
    public function can_create_object(): void
    {
        $subject = CreatablePrivateNoParamConstructorObject::create();

        $this->assertInstanceOf(CreatablePrivateNoParamConstructorObject::class, $subject);
    }

    /** @test */
    public function can_create_object_with_extra_parameters_that_are_trimmed_from_call(): void
    {
        $subject = CreatablePrivateNoParamConstructorObject::create('value', 9);

        $this->assertInstanceOf(CreatablePrivateNoParamConstructorObject::class, $subject);
    }
}
