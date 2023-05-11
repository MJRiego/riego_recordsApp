<?php
$conn = mysqli_connect("localhost", "root", "root", "records_app");
// Check Connection
if (!$conn) { 
    // Connection Failed
    die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

require('vendor/autoload.php');

$faker = Faker\Factory::create();
for ($i = 1; $i <= 200; $i++) {

    $lastname = mysqli_real_escape_string($conn, $faker->lastname);
    $firstname = mysqli_real_escape_string($conn, $faker->firstname);
    $officeid = mysqli_real_escape_string($conn, $faker->numberBetween($min = 1, $max = 200));
    $address = mysqli_real_escape_string($conn, $faker->address);

    $query = "INSERT INTO records_app.employee(lastname, firstname, office_id, address) VALUES ('$lastname','$firstname','$officeid', '$address')";
    mysqli_query($conn, $query);
}

mysqli_close($conn);
?>

