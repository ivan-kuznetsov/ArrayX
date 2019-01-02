<?php

require 'vendor/autoload.php';

$user = [
  'name' => 'Ivan',
  'topics' => [
    ['title' => 'Hi arrays'],
    ['title' => 'Buy arrays'],
  ],
  'country' => [
    'name' => 'UK',
    'flag' => 'nice'
  ],
];


$users = [
  ['name' => 'Sergey', 'score' => 10],
  ['name' => 'Ivan', 'score' => 10],
  ['name' => 'Ilya', 'score' => 30],
  ['name' => 'Mikhail', 'score' => 20],
];

$numbers = range(rand(1, 10), rand(11, 16));

var_dump($numbers, array_max($numbers, 4));

