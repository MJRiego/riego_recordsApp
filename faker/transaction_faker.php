<?php
$conn = mysqli_connect("localhost", "root", "root", "records_app");
// Check Connection
if (!$conn) {
    // Connection Failed
    die('Failed to connect to MySQL: ' . mysqli_connect_error());
}

require('vendor/autoload.php');

$faker = Faker\Factory::create();
$actions = array('IN', 'OUT', 'COMPLETE');
$remarks = array('Signed', 'On Hold', 'In Progress', 'For Approval', 'Rejected', '');
for ($i = 1; $i <= 200; $i++) {

    $datelog = mysqli_real_escape_string($conn, date("Y-m-d H:i:s"));
    $documentcode = mysqli_real_escape_string($conn, $faker->numberBetween($min = 100, $max = 105));
    $officeid = mysqli_real_escape_string($conn, $faker->numberBetween($min = 1, $max = 200));
    $employeeid = mysqli_real_escape_string($conn, $faker->numberBetween($min = 1, $max = 200));
    $action = mysqli_real_escape_string($conn, $actions[rand(0, 2)]);
    $remark = mysqli_real_escape_string($conn, $remarks[rand(0, 5)]);

    $query = "INSERT INTO records_app.transaction( employee_id, office_id, datelog, action, remarks, documentcode) VALUES ('$employeeid', '$officeid', '$datelog', '$action', '$remark', '$documentcode')";
    mysqli_query($conn, $query);
}

mysqli_close($conn);
?>