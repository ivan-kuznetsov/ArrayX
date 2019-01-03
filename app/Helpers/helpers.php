<?php

use App\ArrayX;

function arrayX_get($array, $key, $default = null)
{
    return ArrayX::get($array, $key, $default);
}

function arrayX_first($array, callable $callback = null, $default = null)
{
    return ArrayX::first($array, $callback, $default);
}

function arrayX_last($array, callable $callback = null, $default = null)
{
    return ArrayX::last($array, $callback, $default);
}

function arrayX_has($array, $key)
{
    return ArrayX::has($array, $key);
}

function arrayX_where($array, callable $callback = null)
{
    return ArrayX::where($array, $callback);
}

function arrayX_only($array, $keys)
{
    return ArrayX::only($array, $keys);
}

function arrayX_forget(&$array, $keys)
{
    ArrayX::forget($array, $keys);
}

function arrayX_first_min($array)
{
    return ArrayX::firstMin($array);
}

function arrayX_first_max($array)
{
    return ArrayX::firstMin($array);
}

function arrayX_min($array, $n = 1)
{
    return ArrayX::min($array, $n);
}

function arrayX_max($array, $n = 1)
{
    return ArrayX::max($array, $n);
}

function arrayX_reverse($array)
{
    return ArrayX::reverse($array);
}

function arrayX_sort($array)
{
    return ArrayX::bubbleSorting($array);
}
