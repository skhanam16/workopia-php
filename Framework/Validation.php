<?php

namespace Framework;

class Validation
{

    /**
     * Validate a string
     * @params string $value
     * @params int $min
     * @params int $max
     * @return bool
     */

    public static function string($value, $min = 1, $max = INF)
    {
        if (is_string($value)) {
            $value = trim($value);
            $length = strlen($value);
            return $length >= $min && $length <= $max;
        }

        return false;
    }


    /**
     * Validate email address
     * @params string $value
     * @return mixed
     */

    public static function email($value)
    {
        $value = trim($value);
        if (filter_var($value, FILTER_VALIDATE_EMAIL)) {
            return $value;
        };
        return false;
    }

    /**
     * Match a value against another
     * @params string $value1
     * @params string $value2
     * @return bool
     */

    public static function match($value1, $value2)
    {
        $value1 = trim($value1);
        $value2 = trim($value2);
        return $value1 === $value2;
    }
}
