<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
//code for add courses
if ($_POST['submit']) {
    $seater = $_POST['seater'];
    $fees = $_POST['fees'];
    $id = $_GET['id'];
    $query = "update rooms set seater=?,fees=? where id=?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('iii', $seater, $fees, $id);
    $stmt->execute();
    echo "<script>alert('Room Details has been Updated successfully');</script>";
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
                                    <h4 class="card-title">Edit Room</h4>

                                    <?php if (isset($_POST['submit'])) { ?>
                                        <p style="color: red"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
                                    <?php } ?>
                                    <form method="post" class="forms-sample">
                                        <?php
                                        $id = $_GET['id'];
                                        $ret = "select * from rooms where id=?";
                                        $stmt = $mysqli->prepare($ret);
                                        $stmt->bind_param('i', $id);
                                        $stmt->execute(); //ok
                                        $res = $stmt->get_result();
                                        //$cnt=1;
                                        while ($row = $res->fetch_object()) {
                                        ?>
                                            <div class="hr-dashed"></div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label">Seater </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="seater" value="<?php echo $row->seater; ?>" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label">Room no </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="rmno" id="rmno" value="<?php echo $row->room_no; ?>" disabled>
                                                    <span class="help-block m-b-none">
                                                        Room no can't be changed.</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label">Fees (PM) </label>
                                                <div class="col-sm-8">
                                                    <input type="text" class="form-control" name="fees" value="<?php echo $row->fees; ?>">
                                                </div>
                                            </div>


                                        <?php } ?>
                                        <div class="col-sm-8 col-sm-offset-2">

                                            <input class="btn btn-primary" type="submit" name="submit" value="Update Room Details ">
                                        </div>
                                </div>
                            </div>
                            </form>
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