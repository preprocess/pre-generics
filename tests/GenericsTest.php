<?php

use PHPUnit\Framework\TestCase;

use function Pre\Plugin\addMacro;
use function Pre\Plugin\process;

class GenericsTest extends TestCase
{
    public function setUp()
    {
        ini_set("assert.exception", 1);
        addMacro(__DIR__ . "/../source/macros.yay");
    }

    public function test_can_create_basic_generics()
    {
        $combiner = process(__DIR__ . "/fixtures/can-create-basic-generics.pre");
        $this->assertEquals("123: hello world", $combiner->combine('hello', 'world'));
    }

    public function test_can_detect_invalid_argument_types()
    {
        $combiner = process(__DIR__ . "/fixtures/can-create-basic-generics.pre");
        $this->expectException(AssertionError::class);

        $combiner->combine('hello', 1);
    }

    public function test_can_detect_invalid_return_types()
    {
        $combiner = process(__DIR__ . "/fixtures/can-create-basic-generics.pre");
        $this->expectException(AssertionError::class);

        $combiner->badReturn();
    }

    public function test_can_handle_other_class_things()
    {
        $greeter = process(__DIR__ . "/fixtures/test-can-handle-other-class-things.pre");
        $this->assertEquals("hello chris.", $greeter->greet("chris"));
    }
}
