<?php

function sayName()
{
  echo "Say my name baby <br>";
};

// function with params
function hello($name)
{
  echo "$name says hello and have a nice day. <br>";
};

sayName();
hello("Dean");

// function as a value 
// function sumNum($a, $b, $c) {
//   return $a + $b * $c;
// };

// $getSum = sumNum(2, 4, 6);

// echo $getSum . "<br>";

// Create function to sum all numbers using ...$nums(rest operator)
// function sum(...$nums) {
//   $sum = 0;
//   foreach ($nums as $num) $sum += $num;
//   return $sum;
// }
// echo sum(1, 2, 3, 4, 10) . "<br>";


// Arrow functions
function sum(...$nums)
{
  return array_reduce($nums, fn ($carry, $n) => $carry + $n);
}

// note the arrow function is the fn()...
echo sum(1, 2, 3, 10, 6);
