<?php
session_start();
include('includes/config.php');
if (isset($_POST['login'])) {
	$email = $_POST['email'];
	$password = $_POST['password'];
	$stmt = $mysqli->prepare("SELECT email,password,id FROM userregistration WHERE email=? and password=? ");
	$stmt->bind_param('ss', $email, $password);
	$stmt->execute();
	$stmt->bind_result($email, $password, $id);
	$rs = $stmt->fetch();
	$stmt->close();
	$_SESSION['id'] = $id;
	$_SESSION['login'] = $email;
	$uip = $_SERVER['REMOTE_ADDR'];
	$ldate = date('d/m/Y h:i:s', time());
	if ($rs) {
		$uid = $_SESSION['id'];
		$uemail = $_SESSION['login'];
		$ip = $_SERVER['REMOTE_ADDR'];
		$geopluginURL = 'http://www.geoplugin.net/php.gp?ip=' . $ip;
		$addrDetailsArr = unserialize(file_get_contents($geopluginURL));
		$city = $addrDetailsArr['geoplugin_city'];
		$country = $addrDetailsArr['geoplugin_countryName'];
		$log = "insert into userLog(userId,userEmail,userIp,city,country) values('$uid','$uemail','$ip','$city','$country')";
		$mysqli->query($log);
		if ($log) {
			header("location:dashboard.php");
		}
	} else {
		echo "<script>alert('Invalid Username/Email or password');</script>";
	}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Hostel Management System</title>
  <!-- plugins:css -->
  <link rel="stylesheet" href="vendors/feather/feather.css">
  <link rel="stylesheet" href="vendors/mdi/css/materialdesignicons.min.css">
  <link rel="stylesheet" href="vendors/ti-icons/css/themify-icons.css">
  <link rel="stylesheet" href="vendors/typicons/typicons.css">
  <link rel="stylesheet" href="vendors/simple-line-icons/css/simple-line-icons.css">
  <link rel="stylesheet" href="vendors/css/vendor.bundle.base.css">
  <!-- endinject -->
  <!-- Plugin css for this page -->
  <!-- End plugin css for this page -->
  <!-- inject:css -->
  <link rel="stylesheet" href="css/vertical-layout-light/style.css">
  <!-- endinject -->
  <link rel="shortcut icon" href="images/favicon.png" />
  <script type="text/javascript" src="http://code.jquery.com/jquery.min.js"></script>
	<script type="text/javascript">
		function valid() {
			if (document.registration.password.value != document.registration.cpassword.value) {
				alert("Password and Re-Type Password Field do not match  !!");
				document.registration.cpassword.focus();
				return false;
			}
			return true;
		}
	</script>
</head>

<body>
  <div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
      <div class="content-wrapper d-flex align-items-center auth px-0">
        <div class="row w-100 mx-0">
          <div class="col-lg-4 mx-auto">
            <div class="auth-form-light text-left py-5 px-4 px-sm-5">
              <div class="brand-logo">
                <!-- <img src="images/logo.svg" alt="logo"> -->
                <h1>Hostel Management System</h1>
              </div>
              <h5 class="fw-light"><a href="admin/">Admin Panel</a> </h5>
              <h6 class="fw-light">Sign in to continue.</h6>
              <form class="pt-3 mt" method="post">
                <div class="form-group">
                  <input type="email" name="email"  class="form-control form-control-lg" id="exampleInputEmail1" placeholder="Username">
                </div>
                <div class="form-group">
                  <input type="password" name="password" class="form-control form-control-lg" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="mt-3">
                  <input class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" type="submit" name="login" value="Login">
                </div>
                <div class="text-center mt-4 fw-light">
                  Don't have an account? <a href="registration.php" class="text-primary">Create</a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  <script src="vendors/js/vendor.bundle.base.js"></script>
  <!-- endinject -->
  <!-- Plugin js for this page -->
  <script src="vendors/bootstrap-datepicker/bootstrap-datepicker.min.js"></script>
  <!-- End plugin js for this page -->
  <!-- inject:js -->
  <script src="js/off-canvas.js"></script>
  <script src="js/hoverable-collapse.js"></script>
  <script src="js/template.js"></script>
  <script src="js/settings.js"></script>
  <script src="js/todolist.js"></script>
  <!-- endinject -->
</body>

</html>
