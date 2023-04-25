<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
//code for update email id
if ($_POST['update']) {
    $email = $_POST['emailid'];
    $aid = $_SESSION['id'];
    $udate = date('Y-m-d');
    $query = "update admin set email=?,updation_date=? where id=?";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('ssi', $email, $udate, $aid);
    $stmt->execute();
    echo "<script>alert('Email id has been successfully updated');</script>";
}
// code for change password
if (isset($_POST['changepwd'])) {
    $op = $_POST['oldpassword'];
    $np = $_POST['newpassword'];
    $ai = $_SESSION['id'];
    $udate = date('Y-m-d');
    $sql = "SELECT password FROM admin where password=?";
    $chngpwd = $mysqli->prepare($sql);
    $chngpwd->bind_param('s', $op);
    $chngpwd->execute();
    $chngpwd->store_result();
    $row_cnt = $chngpwd->num_rows;;
    if ($row_cnt > 0) {
        $con = "update admin set password=?,updation_date=?  where id=?";
        $chngpwd1 = $mysqli->prepare($con);
        $chngpwd1->bind_param('ssi', $np, $udate, $ai);
        $chngpwd1->execute();
        $_SESSION['msg'] = "Password Changed Successfully !!";
    } else {
        $_SESSION['msg'] = "Old Password not match !!";
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
    <script type="text/javascript">
        function valid() {

            if (document.changepwd.newpassword.value != document.changepwd.cpassword.value) {
                alert("Password and Re-Type Password Field do not match  !!");
                document.changepwd.cpassword.focus();
                return false;
            }
            return true;
        }
    </script>
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
                                    <h4 class="card-title">Admin Details</h4>

                                    <?php
                                    $aid = $_SESSION['id'];
                                    $ret = "select * from admin where id=?";
                                    $stmt = $mysqli->prepare($ret);
                                    $stmt->bind_param('i', $aid);
                                    $stmt->execute(); //ok
                                    $res = $stmt->get_result();
                                    //$cnt=1;
                                    while ($row = $res->fetch_object()) {
                                    ?>
                                        <form class="forms-sample" method="post">
                                            <div class="form-group row">
                                                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Username</label>
                                                <div class="col-sm-10">
                                                    <input type="text" value="<?php echo $row->username; ?>" disabled class="form-control"><span class="help-block m-b-none">
                                                        Username can't be changed.</span>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Email</label>
                                                <div class="col-sm-10">
                                                    <input type="email" class="form-control" name="emailid" id="emailid" value="<?php echo $row->email; ?>" required="required">

                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Reg Date</label>
                                                <div class="col-sm-10">
                                                    <input type="text" class="form-control" value="<?php echo $row->reg_date; ?>" disabled>
                                                </div>
                                            </div>
                                            <button type="submit" name="update" class="btn btn-primary me-2">Update Profile</button>
                                        </form>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Admin Details</h4>
                                    <form class="forms-sample" method="post">
                                        <?php if (isset($_POST['changepwd'])) { ?>

                                            <p style="color: red"><?php echo htmlentities($_SESSION['msg']); ?><?php echo htmlentities($_SESSION['msg'] = ""); ?></p>
                                        <?php } ?>
                                        <div class="form-group row">
                                            <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Old Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" value="" name="oldpassword" id="oldpassword" class="form-control" onBlur="checkpass()" required="required">
                                                <span id="password-availability-status" class="help-block m-b-none" style="font-size:12px;"></span>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">New Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" name="newpassword" id="newpassword" value="" required="required">
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="exampleInputEmail2" class="col-sm-3 col-form-label">Confirm Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" value="" required="required" id="cpassword" name="cpassword">
                                            </div>
                                        </div>
                                        <button type="submit" name="changepwd" class="btn btn-primary me-2">Change Password</button>
                                    </form>
                                </div>
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