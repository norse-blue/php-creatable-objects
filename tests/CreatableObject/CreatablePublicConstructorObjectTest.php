<?php

namespace NorseBlue\CreatableObjects\Tests\CreatableObject;

use Exception;
use NorseBlue\CreatableObjects\Exceptions\MissingRequiredParametersException;
use NorseBlue\CreatableObjects\Tests\Helpers\CreatablePublicConstructorObject;
use NorseBlue\CreatableObjects\Tests\TestCase;

class CreatablePublicConstructorObjectTest extends TestCase
{
    /** @test */
    public function can_create_object_only_with_required_params()
    {
        $subject = CreatablePublicConstructorObject::create('value');

        $this->assertInstanceOf(CreatablePublicConstructorObject::class, $subject);
        $this->assertSame('value', $subject->name);
        $this->assertSame(0, $subject->count);
    }

    /** @test */
    public function can_create_object_with_all_params()
    {
        $subject = CreatablePublicConstructorObject::create('value', 9);

        $this->assertInstanceOf(CreatablePublicConstructorObject::class, $subject);
        $this->assertSame('value', $subject->name);
        $this->assertSame(9, $subject->count);
    }

    /** @test */
    public function can_create_object_with_extra_parameters_that_are_trimmed_from_call()
    {
        $subject = CreatablePublicConstructorObject::create('value', 9, 'extra param');

        $this->assertInstanceOf(CreatablePublicConstructorObject::class, $subject);
        $this->assertSame('value', $subject->name);
        $this->assertSame(9, $subject->count);
    }

    /** @test */
    public function throws_exception_when_creating_with_missing_parameters()
    {
        try {
            CreatablePublicConstructorObject::create();
        } catch (Exception $exception) {
            $this->assertInstanceOf(MissingRequiredParametersException::class, $exception);
            $this->assertSame(1, $exception->getRequiredParams());
            $this->assertSame(0, $exception->getGivenParams());

            return;
        }

        $this->fail(MissingRequiredParametersException::class . ' was not thrown.');
    }
}
