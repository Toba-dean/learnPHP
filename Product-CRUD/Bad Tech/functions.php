<?php

// Get a a string og n numbers of random caracters from the character variable

function randomString($n) {
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $str = '';
  for ($i = 0; $i < $n; $i++) {
    $index = rand(0, strlen($characters) - 1);
    $str .= $characters[$index];
  }

  return $str;
}
