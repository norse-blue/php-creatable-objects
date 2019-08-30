<?php

namespace NorseBlue\CreatableObjects\Tests\CreatableObject;

use NorseBlue\CreatableObjects\Tests\Helpers\CreatablePublicNoParamConstructorObject;
use NorseBlue\CreatableObjects\Tests\TestCase;

class CreatablePublicNoParamsConstructorObjectTest extends TestCase
{
    /** @test */
    public function can_create_object()
    {
        $subject = CreatablePublicNoParamConstructorObject::create();

        $this->assertInstanceOf(CreatablePublicNoParamConstructorObject::class, $subject);
    }

    /** @test */
    public function can_create_object_with_extra_parameters_that_are_trimmed_from_call()
    {
        $subject = CreatablePublicNoParamConstructorObject::create('value', 9);

        $this->assertInstanceOf(CreatablePublicNoParamConstructorObject::class, $subject);
    }
}
