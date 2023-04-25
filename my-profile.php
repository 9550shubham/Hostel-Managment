<?php
session_start();
include('includes/config.php');
date_default_timezone_set('Asia/Kolkata');
include('includes/checklogin.php');
check_login();
$aid = $_SESSION['id'];
if (isset($_POST['update'])) {

    $regno = $_POST['regno'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $contactno = $_POST['contact'];
    $udate = date('d-m-Y h:i:s', time());
    $query = "update  userRegistration set regNo=?,firstName=?,middleName=?,lastName=?,gender=?,contactNo=?,updationDate=? where id=?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('sssssisi', $regno, $fname, $mname, $lname, $gender, $contactno, $udate, $aid);
    $stmt->execute();
    echo "<script>alert('Profile updated Succssfully');</script>";
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
                                    <h4 class="card-title">My Details</h4>
                                    <p class="card-description">
                                        Update
                                    </p>
                                    <?php
                                    $aid = $_SESSION['id'];
                                    $ret = "select * from userregistration where id=?";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->bind_param('i', $aid);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    //$cnt=1;
                                    while ($row = $res->fetch_object()) {
                                    ?>
                                        <form class="forms-sample" method="post">
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Registration No</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="regno" class="form-control" id="exampleInputUsername2" value="<?php echo $row->regNo; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">First Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="fname" class="form-control" id="exampleInputEmail2" value="<?php echo $row->firstName; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Last Name</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="lname" class="form-control" id="exampleInputEmail2" value="<?php echo $row->lastName; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="col-sm-3 col-form-label">Gender : </label>
                                                <div class="col-sm-8">
                                                    <select name="gender" class="form-control" required="required">
                                                        <option value="<?php echo $row->gender; ?>"><?php echo $row->gender; ?></option>
                                                        <option value="male">Male</option>
                                                        <option value="female">Female</option>
                                                        <option value="others">Others</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-9">
                                                    <input type="email" name="email" class="form-control" id="exampleInputEmail2" value="<?php echo $row->email; ?>" readonly>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputMobile" class="col-sm-3 col-form-label">Mobile</label>
                                                <div class="col-sm-9">
                                                    <input type="text" name="contact" class="form-control" id="exampleInputMobile" value="<?php echo $row->contactNo; ?>">
                                                </div>
                                            </div>

                                            <button type="submit" name="update" class="btn btn-primary me-2">Update</button>
                                        </form>
                                    <?php } ?>
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