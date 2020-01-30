<?php

// define variables and set to empty values
$nameErr = $mobileErr = $packageErr = $dateErr = "";
$name = $mobile = $package = $date = "";
$stat = array();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
if (empty($_POST["name"])) {
  $nameErr = "Name is required";
  array_push($stat, $nameErr);
} else {
  $name = test_input($_POST["name"]);

  // check if name only contains letters and whitespace
  if (!preg_match("/^[a-zA-Z ]*$/",$name)) {
    $nameErr = "Only letters and white space allowed";
    array_push($stat, $nameErr);
  }
}

if (empty($_POST["mobile"])) {
  $mobileErr = "Email is required";
  array_push($stat, $mobileErr);
} else {
  $mobile = test_input($_POST["mobile"]);

  if(!preg_match("/^[0-9]{3}-[0-9]{4}-[0-9]{4}$/", $phone)) {
    $mobileErr = "Enter as like example";
    array_push($stat, $mobileErr);
  }
}

if (empty($_POST["package"])) {
  $packageErr = "package selection required";
  array_push($stat, $packageErr);
} else {
  $package = test_input($_POST["package"]);
}

if (empty($_POST["date"])) {
  $dateErr = "date is required";
  array_push($stat, $dateErr);
} else {
  $date = test_input($_POST["date"]);
}
}

function test_input($data) {
$data = trim($data);
$data = stripslashes($data);
$data = htmlspecialchars($data);
return $data;
}


echo $name."<br>";
echo $mobile."<br>";
echo $package."<br>";
echo $date."<br>";

 ?>
