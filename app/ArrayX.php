<?php

namespace App;

class ArrayX
{
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

    static public function firstMin($array)
    {
        $current = static::first($array);

        foreach ($array as $item) {
            if ($item < $current) {
                $current = $item;
            }
        }

        return $current;
    }

    static public function firstMax($array)
    {
        $current = static::first($array);

        foreach ($array as $item) {
            if ($item > $current) {
                $current = $item;
            }
        }

        return $current;
    }

    static public function min($array, $n = 1)
    {
        if ($n > count($array) || !static::accessible($array)) {
            return false;
        }

        for ($i = 1; $i < $n; $i++) {
            $array = array_diff($array, [static::firstMin($array)]);
        }

        return static::firstMin($array);

    }

    static public function max($array, $n = 1)
    {
        if ($n > count($array) || !static::accessible($array)) {
            return false;
        }

        for ($i = 1; $i < $n; $i++) {
            $array = array_diff($array, [static::firstMax($array)]);
        }

        return static::firstMax($array);

    }

    static public function reverse($array)
    {
        $reversed = null;

        for ($i = count($array); $i >= 0; $i--) {
            $reversed[] = $array[$i];
        }

        return $reversed;
    }

    static public function bubbleSorting(array $array)
    {
        for ($i = 0; $i < count($array) - 1; $i++) {
            $changed = false;
            for ($j = 0; $j < count($array) - 1; $j++) {
                if ($array[$j] > $array[$j + 1]) {
                    $tmp = $array[$j + 1];
                    $array[$j + 1] = $array[$j];
                    $array[$j] = $tmp;
                    $changed = true;
                }
            }

            if (!$changed) {
                break;
            }
        }

        return $array;
    }

    /**
     * Сначала заводим переменную ящичек в который
     * можно положить число
     */
    static public function insertionSorting(array $array)
    {
        //Заводим ящичек
        $x;

        // Создаем цикл и говорим что мы будем проходить
        // массив не от первого элемента, а от второго это
        // можно представить как карты в колоде
        // при заходе в цикл мы сохраняем в наш ящичек
        // первую карту из колоды, при этом можно
        // представить что первый элемент мы уже
        // держим в руке

        for ($i = 1; $i < count($array); $i++) {
            $x = $array[$i];

            //Далее мы вычислим индекс
            //предыдущего элемента (на первый раз
            //это будет элемент
            //который у нас в руке)

            $j = $i - 1;

            //пока та карта которая у нас в руке
            // меньше той карты которую
            // мы только что вытянули
            while ($x < $array[$j]) {

            }


        }

    }
}