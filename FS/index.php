<?php

// Magic constants
// echo __FILE__ . '<br>';
// echo __DIR__ . '<br>';
// echo __LINE__ . '<br>';

// Create directory
// mkdir('OOP');

// Rename directory
// rename('test', 'FS');

// Delete directory
// rmdir('test2');

// Read files and folders inside directory
// $files = scandir('../');
// echo '<pre>';
// var_dump($files);
// echo '</pre>';

// file_get_contents, file_put_contents
// $lorem = file_get_contents('lorem.txt');
// echo $lorem;
// echo '<br>';

// file_put_contents('lorem.txt', "First line" . PHP_EOL . $lorem);

// file_get_contents from URL
$jsonContent = file_get_contents('https://jsonplaceholder.typicode.com/users');
$users = json_decode($jsonContent);

echo '<pre>';
var_dump($users[0]);
echo '</pre>';


// Check if file exists or not
// var_dump(file_exists('lorem.txt'). "<br>"); // true

// Get file size
// var_dump(filesize('lorem.txt'));

// Delete file
// unlink('lorem.txt');