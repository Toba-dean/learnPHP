<?php

// CONDITIONALS

// $name = "Sheriff Dean";
$age = 20;

// If and else statements

// if (str_ends_with($name, 'dean')) {
//   echo "My name is $name";
// } else {
//   echo "Sorry, i don;t know your name.";
// }

// If, elseif and else statements

// if (str_ends_with($name, 'dean')) {
//   echo "My name is $name";
// } elseif (isset($name)) {
//   echo "My name is $name";
// } else {
//   echo "Sorry, i don;t know your name.";
// }

// Ternary if
// echo $age < 22 ? 'Young' : 'Old';
// echo '<br>';

// // Short ternary
// $myAge = $age ?: 18; // Equivalent of "$age ? $age : 18"
// echo $myAge . "<br>";

// // Null coalescing operator
// $var = isset($name) ? $name : 'John';
// $var = $name ?? 'John'; // Equivalent of above
// echo $var . '<br>';

// $name = "Dean";

// // Switch

// switch ($name) {
//   case "Sheriff Dean":
//     echo "My name is $name";
//     break;
//   case "Dean":
//     echo "My name is $name";
//     break;
//   default:
//     echo "No name nigga!!";
//     break;
// }

// LOOPS

// while
// while (true) { // Infinite loop: DON'T run this
//   // Do something constantly
// }

// // Loop with $counter
$counter = 0; // When counter is 10??
while ($counter < 5) {
  $counter++;
  echo $counter . '<br>';
  // if ($counter > 5) break;
}

// do - while
$counter = 0; // When counter is 10?
do {
  // Do some code right here
  echo $counter . '<br>';
  $counter++;
} while ($counter < 5);


// for
for ($i = 0; $i < 5; $i++) {
  echo $i . "<br>";
}

// foreach
$fruits = ["Banana", "Apple", "Orange"];
foreach ($fruits as $i => $fruit) {
  echo $i . ' => ' . $fruit . '<br>';
}

// Iterate Over associative array.
$person = [
  'name' => 'Brad',
  'surname' => 'Traversy',
  'age' => 30,
  'hobbies' => ['Tennis', 'Video Games'],
];

foreach ($person as $key => $value) {
  if (is_array($value)) {
    echo $key . ' => ' . implode(", ", $value) . '<br>';
  }
}
