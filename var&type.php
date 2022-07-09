<?php 

  /* 
    Data Types in PHP
    // Scalar Type
      * Strings
      * Integer
      * Float
      * Boolean

    // Compound Types
      * Arrays
      * Objects
      * Callables
      * Iterables
    
    // Specials
      * Null
      * Resources
  */

  // Variable with Scalar types
  $str = "Sheriff Dean";    //String
  $intNo = 22;           //int
  $floatNo = 12.5;         //float
  $boolVal = true;         //Bool

  #var_dump($str, $floatNo, $intNo, $boolVal);

  // getting variable types

  // echo "<br><br>" .gettype($str);
  // echo "<br>" .gettype($floatNo);
  // echo "<br>" .gettype($boolVal);
  // echo "<br>" .gettype($intNo);

  // Variable checking functions
  // echo ("<br><br>" .is_bool($boolVal));
  // echo "<br>" .is_double($floatNo);
  // echo "<br>" .is_int($intNo);
  // echo "<br>" .is_string($str);

  // defining constants 
  // define("name", "Dean");

  // echo name;

  
  // Some strings functions
  // echo str_split($str, " ");

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>

  <h2>
    <?php 
      echo strtoupper($str).  "<br> $intNo <br> $floatNo <br> $boolVal";
    ?>
  </h2>

</body>
</html>