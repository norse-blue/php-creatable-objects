<?php

namespace NorseBlue\CreatableObjects\Tests\CreatableObject;

use Exception;
use NorseBlue\CreatableObjects\Exceptions\UnresolvableConstructorException;
use NorseBlue\CreatableObjects\Tests\Helpers\NoConstructorObject;
use NorseBlue\CreatableObjects\Tests\TestCase;

class NoConstructorObjectTest extends TestCase
{
    /** @test */
    public function throws_exception_for_class_without_constructor(): void
    {
        try {
            $subject = NoConstructorObject::create();
        } catch (Exception $exception) {
            $this->assertInstanceOf(UnresolvableConstructorException::class, $exception);

            return;
        }

        $this->fail(UnresolvableConstructorException::class . ' was not thrown.');
    }
}
