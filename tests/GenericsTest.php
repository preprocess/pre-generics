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
        $greeter = process(__DIR__ . "/fixtures/can-handle-other-class-things.pre");
        $this->assertEquals("hello chris.", $greeter->greet("chris"));
    }

    public function test_can_handle_object_types()
    {
        $greeter = process(__DIR__ . "/fixtures/can-handle-object-types.pre");
        $this->assertEquals("hello chris.", $greeter->greet(new Name("chris")));
    }

    public function test_can_handle_square_brackets()
    {
        $greeter = process(__DIR__ . "/fixtures/can-handle-square-brackets.pre");
        $this->assertEquals("hello chris.", $greeter->greet("chris"));
    }

    public function test_can_handle_default_parameter_values()
    {
        $greeter = process(__DIR__ . "/fixtures/can-handle-default-parameter-values.pre");
        $this->assertEquals("hello chris.", $greeter->greet());
    }
}
