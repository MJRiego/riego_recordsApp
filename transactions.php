<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="assets/img/favicon.ico">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <title>Light Bootstrap Dashboard - Free Bootstrap 4 Admin Dashboard by Creative Tim</title>
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
        name='viewport' />
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />
    <!-- CSS Files -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" />
    <link href="assets/css/light-bootstrap-dashboard.css?v=2.0.0 " rel="stylesheet" />
    <!-- CSS Just for demo purpose, don't include it in your project -->
    <link href="assets/css/demo.css" rel="stylesheet" />
</head>

<body>
    <?php
    require('config/config.php');
    require('config/db.php');

    $result_per_page = 10;

    $query = "SELECT * FROM transaction";
    $result = mysqli_query($conn, $query);
    $number_of_result = mysqli_num_rows($result);

    $number_of_page = ceil($number_of_result / $result_per_page);

    if (!isset($_GET['page'])) {
        $page = 1;
    } else {
        $page = $_GET['page'];
    }

    $page_first_result = ($page - 1) * $result_per_page;

    // Create Query
    $query = 'SELECT transaction.datelog, transaction.documentcode, transaction.action, office.name as office_name, CONCAT(employee.lastname, ", ", employee.firstname) as fullname, transaction.remarks
FROM transaction
JOIN office ON transaction.office_id = office.id
JOIN employee ON transaction.employee_id = employee.id
ORDER BY transaction.id LIMIT ' . $page_first_result . ',' . $result_per_page . '';

    // Get the result
    $result = mysqli_query($conn, $query);

    // Fetch the result data
    $transactions = mysqli_fetch_all($result, MYSQLI_ASSOC);

    // Free the result data
    mysqli_free_result($result);

    // Close the connection
    mysqli_close($conn);
    ?>

    <div class="wrapper">
        <?php include('includes/sidebar.php') ?>
        <div class="main-panel">
            <!-- Navbar -->
            <?php include('includes/navbar.php') ?>
            <!-- End Navbar -->
            <div class="content">
                <div class="container-fluid">
                    <div class="section">
                        <div class="col-md-12">
                            <div class="card strpied-tabled-with-hover">
                                <div class="card-header ">
                                    <div class="addbutton" style="margin-bottom: 50px">
                                        <a href="add-transaction.php">
                                            <button type="submit" name="adds"
                                                class="btn btn-info btn-fill pull-right">Add New Transaction</button>
                                        </a>
                                    </div>
                                    <h4 class="card-title">Transactions</h4>
                                    <p class="card-category">Here is a subtitle for this table</p>
                                </div>
                                <div class="card-body table-full-width table-responsive">
                                    <table class="table table-hover table-striped">
                                        <thead>
                                            <th>Datelog</th>
                                            <th>Document Code</th>
                                            <th>Action</th>
                                            <th>Office</th>
                                            <th>Employee</th>
                                            <th>Remarks</th>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($transactions as $transaction): ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $transaction['datelog']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $transaction['documentcode']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $transaction['action']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $transaction['office_name']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $transaction['fullname']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $transaction['remarks']; ?>
                                                    </td>
                                                </tr>
                                            <?php endforeach ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <style>
                ul {
                    display: flex;
                    list-style: none;
                }

                li {
                    margin: 0 10px;
                }
            </style>

            <div class="table-paginate">

                <ul>
                    <?php if ($page > 3): ?>
                        <li>
                            <a href="transactions.php?page=1">
                                < First </a>
                        </li>
                    <?php endif; ?>

                    <?php if ($page > 1): ?>
                        <li>
                            <a href="transactions.php?page=<?php echo $page - 1; ?>">
                                < Previous </a>
                        </li>
                    <?php endif; ?>



                    <?php for ($i = max(1, $page - 2); $i <= min($page + 2, $number_of_page); $i++): ?>
                        <li>
                            <a href="transactions.php?page=<?php echo $i; ?>">
                                <?php echo $i; ?>
                            </a>
                        </li>
                    <?php endfor; ?>



                    <?php if ($page < $number_of_page): ?>
                        <li>
                            <a href="transactions.php?page=<?php echo $page + 1; ?>">
                                Next >
                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if ($page < $number_of_page - 2): ?>
                        <li>
                            <a href="transactions.php?page=<?php echo $number_of_page; ?>">
                                Last >
                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>


            <footer class="footer">
                <div class="container-fluid">
                    <nav>
                        <ul class="footer-menu">
                            <li>
                                <a href="#">
                                    Home
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Company
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Portfolio
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    Blog
                                </a>
                            </li>
                        </ul>
                        <p class="copyright text-center">
                            ©
                            <script>
                                document.write(new Date().getFullYear())
                            </script>
                            <a href="http://www.creative-tim.com">Creative Tim</a>, made with love for a better web
                        </p>
                    </nav>
                </div>
            </footer>
        </div>
    </div>


</body>
<!--   Core JS Files   -->
<script src="../assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="../assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="../assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
<script src="../assets/js/plugins/bootstrap-switch.js"></script>
<!--  Google Maps Plugin    -->
<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
<!--  Chartist Plugin  -->
<script src="../assets/js/plugins/chartist.min.js"></script>
<!--  Notifications Plugin    -->
<script src="../assets/js/plugins/bootstrap-notify.js"></script>
<!-- Control Center for Light Bootstrap Dashboard: scripts for the example pages etc -->
<script src="../assets/js/light-bootstrap-dashboard.js?v=2.0.0 " type="text/javascript"></script>
<!-- Light Bootstrap Dashboard DEMO methods, don't include it in your project! -->
<script src="../assets/js/demo.js"></script>

</html>