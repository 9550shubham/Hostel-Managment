<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();



// Check if the form was submitted
if (isset($_POST['submit'])) {
    // Get the values from the form
    $student_name = $_POST['studentname'];
    $payment_date = $_POST['paymentdate'];
    $amount = $_POST['amount'];

    // Prepare the SQL statement
    $stmt = $mysqli->prepare("INSERT INTO payment (student_name, payment_date, amount) VALUES (?, ?, ?)");

    // Bind the parameters to the statement
    $stmt->bind_param("ssd", $student_name, $payment_date, $amount);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Data inserted successfully.";
    } else {
        echo "Error inserting data: " . $stmt->error;
    }

    // Close the statement and the database connection
    $stmt->close();
    $mysqli->close();
}




?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Hostel Management System </title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="vendors/feather/feather.css">
    <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
    <link rel="stylesheet" href="vendors/typicons/typicons.css">
    <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
    <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="vendors/datatables.net-bs4/dataTables.bootstrap4.css">
    <link rel="stylesheet" href="js/select.dataTables.min.css">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="css/vertical-layout-light/style.css">
    <!-- endinject -->
    <link rel="shortcut icon" href="images/favicon.png" />
    <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>

</head>

<body>
    <div class="container-scroller">
        <!-- partial:partials/_navbar.html -->
        <?php include "includes/navbar.php"; ?>
        <!-- partial -->
        <div class="container-fluid page-body-wrapper">
            <?php include "includes/sidebar.php" ?>
            <!-- partial -->
            <div class="main-panel">
                <div class="content-wrapper">
                    <div class="row">

                        <h3>Bank Details: 100001010182</h3>
                        <h3>IFSC Code: 010182</h3>

                        <br><br><br>

                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Leave Entry</h4>

                                    

                                    <form class="forms-sample" method="post">
                                        <div class="form-group row">
                                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Student Name</label>
                                            <div class="col-sm-9">
                                                <select name="studentname" class="form-control" required>
                                                    <?php
                                                    $query = "SELECT * FROM `userregistration` WHERE id = $session_id";
                                                    $stmt2 = $mysqli->prepare($query);
                                                    $stmt2->execute();
                                                    $res = $stmt2->get_result();
                                                    while ($row = $res->fetch_object()) {
                                                        $student_name = $row->firstName;
                                                    ?>
                                                        <option value="<?php echo $student_name; ?>" selected readonly> <?php echo $student_name; ?></option>
                                                    <?php } ?>
                                                </select>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Payment Date</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="paymentdate" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Amount</label>
                                            <div class="col-sm-9">
                                                <input type="text" name="amount" class="form-control">
                                            </div>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary me-2">Submit</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">View Payment Details</h4>
                                    <p class="card-description">
                                        Payment data
                                    </p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Student Name</th>
                                                    <th>Payment Date</th>
                                                    <th>Amount</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Validate and sanitize the session id


                                                // Prepare the SQL query with a parameterized statement
                                                $query = "SELECT * FROM payment JOIN userregistration ON userregistration.firstName = payment.student_name WHERE userregistration.id = ?";
                                                $stmt = $mysqli->prepare($query);
                                                if (!$stmt) {
                                                    echo "Error preparing the query: " . $mysqli->error;
                                                    exit;
                                                }

                                                // Bind the parameter to the statement
                                                $stmt->bind_param("i", $session_id);

                                                // Execute the statement
                                                if (!$stmt->execute()) {
                                                    echo "Error executing the query: " . $stmt->error;
                                                    exit;
                                                }

                                                // Get the results and display them in a table
                                                $res = $stmt->get_result();
                                                if ($res->num_rows > 0) {
                                                    while ($row = $res->fetch_object()) {
                                                ?>
                                                        <tr>
                                                            <td><?php echo $row->id; ?></td>
                                                            <td><?php echo $row->student_name; ?></td>
                                                            <td><?php echo $row->payment_date; ?></td>
                                                            <td><?php echo $row->amount; ?></td>
                                                        </tr>
                                                <?php
                                                    }
                                                } else {
                                                    echo "No results found.";
                                                }

                                                // Close the statement and the database connection
                                                $stmt->close();
                                                $mysqli->close();
                                                ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- content-wrapper ends -->
                <!-- partial:../../partials/_footer.html -->
                <?php include "includes/footer.php"; ?>
                <!-- partial -->
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->


    <!-- plugins:js -->
    <script src="vendors/js/vendor.bundle.base.js"></script>
    <!-- endinject -->
    <!-- Plugin js for this page -->
    <script src="vendors/chart.js/Chart.min.js"></script>
    <script src="vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
    <script src="vendors/progressbar.js/progressbar.min.js"></script>

    <!-- End plugin js for this page -->
    <!-- inject:js -->
    <script src="js/off-canvas.js"></script>
    <script src="js/hoverable-collapse.js"></script>
    <script src="js/template.js"></script>
    <script src="js/settings.js"></script>
    <script src="js/todolist.js"></script>
    <!-- endinject -->
    <!-- Custom js for this page-->
    <script src="js/jquery.cookie.js" type="text/javascript"></script>
    <script src="js/dashboard.js"></script>
    <script src="js/Chart.roundedBarCharts.js"></script>
    <!-- End custom js for this page-->
</body>

</html>