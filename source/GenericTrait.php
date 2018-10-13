<?php

namespace Pre\Generics;

trait GenericTrait
{
    protected function validGenericType($value, $type)
    {
        $interface = $this->GENERIC_INTERFACES[$type];

        if ($interface !== null) {
            if (!is_a($value, $interface)) {
                return false;
            }
        }

        $substitution = $this->GENERIC_ALIASES[$type];
        $actual = $this->{"GENERIC_TYPE_{$substitution}"};

        if ($actual === "mixed") {
            return true;
        }

        if ($actual === "bool" || $actual === "boolean") {
            return is_boolean($value);
        }

        if ($actual === "int" || $actual === "integer") {
            return is_integer($value);
        }

        if ($actual === "float") {
            return is_float($value);
        }

        if ($actual === "number") {
            return is_number($value);
        }

        if ($actual === "string") {
            return is_string($value);
        }

        if ($actual === "array") {
            return is_array($value);
        }

        if ($actual === "callable") {
            return is_callable($value);
        }

        if ($actual === "resource") {
            return is_resource($value);
        }

        return is_a($value, $actual);
    }
}
