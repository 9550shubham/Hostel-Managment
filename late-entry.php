<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

if (isset($_POST['submit'])) {
    // get the values from the form
    $studentname = $_POST['studentname'];
    $date = $_POST['date'];
    $time = $_POST['time'];

    // insert the data into the database
    $query = "INSERT INTO late_entries (student_name, date, time) VALUES (?, ?, ?)";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param("sss", $studentname, $date, $time);
    $stmt->execute();

    // check if the data was inserted successfully
    if ($stmt->affected_rows > 0) {
        echo "Data inserted successfully";
    } else {
        echo "Error inserting data";
    }
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

                        <div class="col-md-3 grid-margin stretch-card">
                        </div>
                        <div class="col-lg-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">View Late Entry</h4>
                                    <p class="card-description">
                                        Late entry data
                                    </p>
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>ID</th>
                                                    <th>Student Name</th>
                                                    <th>Date</th>
                                                    <th>Time</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                // Use a JOIN to link the late_entries table to the userregistration table on the student name field
                                                // Use aliases to refer to the columns in each table
                                                $query = "SELECT late_entries.id, late_entries.student_name, late_entries.date, late_entries.time 
                  FROM late_entries 
                  JOIN userregistration 
                  ON userregistration.firstName = late_entries.student_name  WHERE userregistration.id = $session_id";
                                                $stmt = $mysqli->prepare($query);
                                                $stmt->execute();
                                                $res = $stmt->get_result();
                                                while ($row = $res->fetch_object()) {
                                                ?>
                                                    <tr>
                                                        <td><?php echo htmlspecialchars($row->id); ?></td>
                                                        <td><?php echo htmlspecialchars($row->student_name); ?></td>
                                                        <td><?php echo htmlspecialchars($row->date); ?></td>
                                                        <td><?php echo htmlspecialchars($row->time); ?></td>
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