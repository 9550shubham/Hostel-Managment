<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

if(isset($_POST['submit'])) {
    $student_name = $_POST['studentname'];
    $leave_start_date = $_POST['startdate'];
    $leave_end_date = $_POST['enddate'];
    
    // Creating the SQL query to insert data into the database
    $query = "INSERT INTO `leave_entries` (`student_name`, `leave_start_date`, `leave_end_date`) VALUES (?, ?, ?)";

    // Creating a prepared statement to execute the query
    $stmt = $mysqli->prepare($query);

    // Binding parameters to the prepared statement
    $stmt->bind_param("sss", $student_name, $leave_start_date, $leave_end_date);

    // Executing the prepared statement
    if ($stmt->execute()) {
        echo "Data inserted successfully";
    } else {
        echo "Error: " . $mysqli->error;
    }

    // Closing the statement
    $stmt->close();
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

                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Leave Entry</h4>


                                    <form class="forms-sample" method="post">
                                        <div class="form-group row">
                                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Student Name</label>
                                            <div class="col-sm-9">
                                                <select name="studentname" class="form-control" required>
                                                    <option value="">Select Student</option>
                                                    <?php $query = "SELECT * FROM `registration` ";
                                                    $stmt2 = $mysqli->prepare($query);
                                                    $stmt2->execute();
                                                    $res = $stmt2->get_result();
                                                    while ($row = $res->fetch_object()) {
                                                    ?>
                                                        <option value="<?php echo $row->firstName; ?>"> <?php echo $row->firstName; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Start Date</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="startdate" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">End Date</label>
                                            <div class="col-sm-9">
                                                <input type="date" name="enddate" class="form-control">
                                            </div>
                                        </div>
                                        <button type="submit" name="submit" class="btn btn-primary me-2">Apply</button>
                                    </form>

                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">View Leave Entry</h4>
                                    <p class="card-description">
                                        Leave entry data
                                    </p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Student Name</th>
                                                    <th>Start Date</th>
                                                    <th>End Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = "SELECT * FROM leave_entries";
                                                $stmt = $mysqli->prepare($query);
                                                $stmt->execute();
                                                $res = $stmt->get_result();
                                                while ($row = $res->fetch_object()) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo $row->id; ?></td>
                                                        <td><?php echo $row->student_name; ?></td>
                                                        <td><?php echo $row->leave_start_date; ?></td>
                                                        <td><?php echo $row->leave_end_date; ?></td>
                                                    </tr>
                                                <?php } ?>
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