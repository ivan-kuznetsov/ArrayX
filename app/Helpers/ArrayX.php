<?php

namespace App\Helpers;

class ArrayX
{
    public static function get($array, $key, $default = null)
    {
        if (!static::accessible($array)) {
            return $default;
        }

        if (is_null($key)) {
            return $array;
        }

        if (static::exists($array, $key)) {
            return $array[$key];
        }

        foreach (explode('.', $key) as $s) {
            if (static::accessible($array) && static::exists($array, $s)) {
                $array = $array[$s];
            } else {
                return $default;
            }
        }

        return $array;
    }

    public static function accessible($value)
    {
        return is_array($value) || $value instanceof \ArrayAccess;
    }

    public static function exists($array, $key)
    {
        if ($array instanceof \ArrayAccess) {
            return $array->offsetExists($key);
        }

        return array_key_exists($key, $array);
    }

    public static function last($array, callable $callback = null, $default = null)
    {
        if ($callback === null) {
            if (empty($array)) {
                return $default;
            }

            return end($array);
        }

        return static::first(array_reverse($array, true), $callback, $default);
    }

    public static function first($array, callable $callback = null, $default = null)
    {
        if ($callback === null) {
            if (empty($array)) {
                return $default;
            }

            foreach ($array as $item) {
                return $item;
            }
        }

        foreach ($array as $key => $value) {
            if (call_user_func($callback, $value, $key)) {
                return $value;
            }
        }

        return $default;
    }

    public static function has($array, $key)
    {
        if ($key === null) {
            return false;
        }

        $keys = (array)$key;

        if (empty($keys)) {
            return false;
        }

        foreach ($keys as $key) {
            $subKeyArray = $array;

            if (static::exists($array, $key)) {
                continue;
            }

            foreach (explode('.', $key) as $s) {
                if (static::accessible($subKeyArray) && static::exists($subKeyArray, $s)) {
                    $subKeyArray = $subKeyArray[$s];
                } else {
                    return false;
                }
            }
        }

        return true;
    }

    public static function where($array, callable $callback)
    {
        return array_filter($array, $callback, ARRAY_FILTER_USE_BOTH);
    }

    public static function only($array, $keys)
    {
        return array_intersect_key($array, array_flip((array)$keys));
    }

    public static function forget(&$array, $keys)
    {
        $original = &$array;

        $keys = (array)$keys;

        foreach ($keys as $key) {
            if (static::exists($array, $key)) {
                unset($array[$key]);
                continue;
            }

            $parts = explode('.', $key);

            $array = $original;

            while (count($parts) > 1) {
                $part = array_shift($parts);

                if (static::accessible($array) && static::exists($array, $part)) {
                    $array = &$array[$part];
                } else {
                    continue 2;
                }
            }

            unset($array[array_shift($parts)]);

        }
    }
}