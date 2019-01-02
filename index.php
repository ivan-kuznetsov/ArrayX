<?php

require 'vendor/autoload.php';


$numbers = range(rand(1, 10), rand(11, 16));

var_dump($numbers, array_max($numbers, 4));

