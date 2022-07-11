<?php

echo "OOP! <br>";

// Class are templates for Objects, and objects are instances of class.

//Access Modifiers => Public, Protected, Private. 
// Final keyword prevent method overriding or inheriting class.

// Call methods using the public modifiers.
// Call methods with any modifier depending of how you want the method to be used!!

class Fruit {

  // Properties
  // Public modifiers can be accessed from everywhere.
  // Protected modifiers can be accessed by the Parent class and subclasses of the parent class.
  // Private modifiers can only be accessed by the class that creates them i.e they are encapsulated props. Use getters and setters for this modifiers.
  public $name;
  public $color;

  // Encapsulated property
  private $something;

  // Constructor
  function __construct($name, $color) {
    $this->name = $name;
    $this->color = $color;
  }

  // setter function
  public function set_something($something) {
    $this->something = $something;
  }

  // Getter function
  public function get_something() {
    echo $this->something;
  }

  private function name() {
    echo "Call me Tune!";
  }

  public function call() {
    Fruit::name();
  }

  // Method
  protected function greetEm() {
    echo "Hello from the $this->name nigga, Burna's album is a BOMB BTW!!";
  }

  // Getter method
  // function getName() {
  //   return $this->name;
  // }

  // Const === cannot be changed once declared 
  const Bye = "See y'all later!!";

  function accessConst() {
    echo self::Bye;
  }
}

// Inheritance, Sub class inherits props and methods from the parent class.
class Berry extends Fruit {

  public $type;

  // Inheriting the props from the parent class and adding a self own prop
  function __construct($name, $color, $type) {
    $this->type = $type;
    parent::__construct($name, $color);
  }

  // Polymorphism i.e ability to modify the parent method
  function greetEm() {
    echo "The berry kings are greeting y'all! <br>";
  }
  
  // Calling the protected method.
  function message() {
    echo "This is a berry fruit nigga!!<br>";
  }

  function another() {
    $this -> greetEm();
  }

}

$Blackberry = new Berry('Blackberry', 'Black', 'Black Berry');
$Orange = new Fruit('Orange', 'Orange');


$Orange->set_something('SOMETHING');
$Orange->get_something();


echo "<pre>";
var_dump($Orange);
echo "</pre>";

echo "<pre>";
var_dump($Blackberry);
echo "</pre>";

echo "<pre>";
// var_dump($Blackberry->greetEm());
echo $Blackberry->message();
echo $Blackberry->another();
echo $Blackberry->accessConst();
echo "</pre>";

// First way to access a const
// echo Fruit::Bye;


// Traits are used to declare methods that can be used in multiple classes 

trait sayHello {
  public function greeting() {
    echo "This is hello from a trait, can you say hello too? <br>";
  }
}

trait sayHello2 {
  public function greeting2() {
    echo "This is hello from trait 2.<br>";
  }
}

class Person {
  public $name;

  function __construct($name) {
    $this->name = $name;
  }

  use sayHello;
}

class Cars {
  use sayHello, sayHello2;
}

class Student extends Person {
  public $course;

  function __construct($name, $course) {
    $this->course = $course;
    parent::__construct($name);
  }
}

$stu = new Student("Dean", "GPS");
$car = new Cars();

echo $stu->greeting();
echo $car->greeting();
echo $car->greeting2();


// Static Methods and Props, they can only be called only by the class and not by the instance of the class

class ClassName {
  static $name = "Dean";

  public static function staticMethod() {
    echo "This is a static method. <br>";
  }

  public static function staticMethod2() {
    echo "This is static method 2. <br>";
  }
  
  function accessStatic() {
    self::staticMethod();
  }

  function __construct() {
    self::staticMethod2();
  }
}

class SomeOtherClass {
  function msg() {
    // calling a static method of another class.
    ClassName::staticMethod();
  }
}

class child extends ClassName {
  function __construct() {
    // Inheriting static method from a parent class.
    parent::staticMethod2();  
  }
}

$static = new ClassName();
$static3 = new SomeOtherClass();
$static2 = new child();


echo "<br>";
echo $static->accessStatic();
new ClassName();
echo ClassName::staticMethod();
echo $static2->staticMethod2();
echo $static3->msg();
echo ClassName::$name;