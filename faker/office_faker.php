<?php
$conn = mysqli_connect("localhost", "root", "root", "records_app");
// Check Connection
if (!$conn) {
    // Connection Failed 
    die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

require('vendor/autoload.php');

$faker = Faker\Factory::create('en_PH');
for ($i = 1; $i <= 200; $i++) {

    $officeName = mysqli_real_escape_string($conn, $faker->company);
    $contactnum = mysqli_real_escape_string($conn, $faker->phoneNumber);
    $email = mysqli_real_escape_string($conn, $faker->email);
    $address = mysqli_real_escape_string($conn, $faker->streetAddress);
    $city = mysqli_real_escape_string($conn, $faker->city);
    $country = mysqli_real_escape_string($conn, $faker->country);
    $postal = mysqli_real_escape_string($conn, $faker->postcode);

    $query = "INSERT INTO records_app.office(name, contactnum, email, address, city, country, postal) VALUES ('$officeName','$contactnum','$email','$address','$city', '$country', '$postal')";
    mysqli_query($conn, $query);
}

mysqli_close($conn);
?>