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

array_walk_recursive($array, function (&$item) {
    $item = is_numeric($item) ? (int)$item : $item;
});

