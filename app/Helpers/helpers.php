<?php

use App\Helpers\ArrayX;

function array_get($array, $key, $default = null)
{
    return ArrayX::get($array, $key, $default);
}

function array_first($array, callable $callback = null, $default = null)
{
    return ArrayX::first($array, $callback, $default);
}

function array_last($array, callable $callback = null, $default = null)
{
    return ArrayX::last($array, $callback, $default);
}

function array_has($array, $key)
{
    return ArrayX::has($array, $key);
}

function array_where($array, callable $callback = null)
{
    return ArrayX::where($array, $callback);
}

function array_only($array, $keys)
{
    return ArrayX::only($array, $keys);
}

function array_forget(&$array, $keys)
{
    ArrayX::forget($array, $keys);
}
