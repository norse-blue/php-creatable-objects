<?php

namespace NorseBlue\CreatableObjects\Tests\CreatableObject;

use Exception;
use NorseBlue\CreatableObjects\Exceptions\MissingRequiredParametersException;
use NorseBlue\CreatableObjects\Tests\Helpers\CreatableProtectedConstructorObject;
use NorseBlue\CreatableObjects\Tests\TestCase;

class CreatableProtectedConstructorObjectTest extends TestCase
{
    /** @test */
    public function can_create_object_only_with_required_params()
    {
        $subject = CreatableProtectedConstructorObject::create('value');

        $this->assertInstanceOf(CreatableProtectedConstructorObject::class, $subject);
        $this->assertSame('value', $subject->name);
        $this->assertSame(0, $subject->count);
    }

    /** @test */
    public function can_create_object_with_all_params()
    {
        $subject = CreatableProtectedConstructorObject::create('value', 9);

        $this->assertInstanceOf(CreatableProtectedConstructorObject::class, $subject);
        $this->assertSame('value', $subject->name);
        $this->assertSame(9, $subject->count);
    }

    /** @test */
    public function can_create_object_with_extra_parameters_that_are_trimmed_from_call()
    {
        $subject = CreatableProtectedConstructorObject::create('value', 9, 'extra param');

        $this->assertInstanceOf(CreatableProtectedConstructorObject::class, $subject);
        $this->assertSame('value', $subject->name);
        $this->assertSame(9, $subject->count);
    }

    /** @test */
    public function throws_exception_when_creating_with_missing_parameters()
    {
        try {
            CreatableProtectedConstructorObject::create();
        } catch (Exception $exception) {
            $this->assertInstanceOf(MissingRequiredParametersException::class, $exception);
            $this->assertSame(1, $exception->getRequiredParams());
            $this->assertSame(0, $exception->getGivenParams());

            return;
        }

        $this->fail(MissingRequiredParametersException::class . ' was not thrown.');
    }
}
