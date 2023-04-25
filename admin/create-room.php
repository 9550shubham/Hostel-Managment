<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
//code for add courses
if ($_POST['submit']) {
    $seater = $_POST['seater'];
    $roomno = $_POST['rmno'];
    $fees = $_POST['fee'];
    $sql = "SELECT room_no FROM rooms where room_no=?";
    $stmt1 = $mysqli->prepare($sql);
    $stmt1->bind_param('i', $roomno);
    $stmt1->execute();
    $stmt1->store_result();
    $row_cnt = $stmt1->num_rows;;
    if ($row_cnt > 0) {
        echo "<script>alert('Room alreadt exist');</script>";
    } else {
        $query = "insert into  rooms (seater,room_no,fees) values(?,?,?)";
        $stmt = $mysqli->prepare($query);
        $rc = $stmt->bind_param('iii', $seater, $roomno, $fees);
        $stmt->execute();
        echo "<script>alert('Room has been added successfully');</script>";
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
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Create Room</h4>

                                    <?php if (isset($_POST['submit'])) { ?>
                                        <p style="color: red"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
                                    <?php } ?>
                                    <form method="post" class="forms-sample">

                                        <div class="hr-dashed"></div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">Select Seater </label>
                                            <div class="col-sm-8">
                                                <Select name="seater" class="form-control" required>
                                                    <option value="">Select Seater</option>
                                                    <option value="1">Single Seater</option>
                                                    <option value="2">Two Seater</option>
                                                    <option value="3">Three Seater</option>
                                                    <option value="4">Four Seater</option>
                                                    <option value="5">Five Seater</option>
                                                </Select>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">Room No.</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="rmno" id="rmno" value="" required="required">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">Fee(Per Student)</label>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" name="fee" id="fee" value="" required="required">
                                            </div>
                                        </div>

                                        <div class="col-sm-8 col-sm-offset-2">
                                            <input class="btn btn-primary" type="submit" name="submit" value="Create Room ">
                                        </div>
                                    </form>
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