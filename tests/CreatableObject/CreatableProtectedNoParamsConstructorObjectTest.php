<?php

namespace NorseBlue\CreatableObjects\Tests\CreatableObject;

use NorseBlue\CreatableObjects\Tests\Helpers\CreatableProtectedNoParamConstructorObject;
use NorseBlue\CreatableObjects\Tests\TestCase;

class CreatableProtectedNoParamsConstructorObjectTest extends TestCase
{
    /** @test */
    public function can_create_object(): void
    {
        $subject = CreatableProtectedNoParamConstructorObject::create();

        $this->assertInstanceOf(CreatableProtectedNoParamConstructorObject::class, $subject);
    }

    /** @test */
    public function can_create_object_with_extra_parameters_that_are_trimmed_from_call(): void
    {
        $subject = CreatableProtectedNoParamConstructorObject::create('value', 9);

        $this->assertInstanceOf(CreatableProtectedNoParamConstructorObject::class, $subject);
    }
}
