<?php
session_start();
include('includes/config.php');
if (isset($_POST['submit'])) {
  $regno = $_POST['regno'];
  $fname = $_POST['fname'];
  $mname = $_POST['mname'];
  $lname = $_POST['lname'];
  $gender = $_POST['gender'];
  $contactno = $_POST['contact'];
  $emailid = $_POST['email'];
  $password = $_POST['password'];
  $query = "insert into  userRegistration(regNo,firstName,middleName,lastName,gender,contactNo,email,password) values(?,?,?,?,?,?,?,?)";
  $stmt = $mysqli->prepare($query);
  $rc = $stmt->bind_param('sssssiss', $regno, $fname, $mname, $lname, $gender, $contactno, $emailid, $password);
  $stmt->execute();
  echo "<script>alert('Student Registered Succssfully');</script>";
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
        alert("Password and Re-enter Password Field do not match  !!");
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
              </div>
              <h6 class="fw-light">Register your account !</h6>

              <form method="post" action="" name="registration" class="forms-sample" onSubmit="return valid();">



                <div class="form-group row">
                  <label class="col-sm-2 control-label"> Registration No : </label>
                  <div class="col-sm-8">
                    <input type="text" name="regno" id="regno" class="form-control" required="required">
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-sm-2 control-label">First Name : </label>
                  <div class="col-sm-8">
                    <input type="text" name="fname" id="fname" class="form-control" required="required">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label">Middle Name : </label>
                  <div class="col-sm-8">
                    <input type="text" name="mname" id="mname" class="form-control">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label">Last Name : </label>
                  <div class="col-sm-8">
                    <input type="text" name="lname" id="lname" class="form-control" required="required">
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label">Gender : </label>
                  <div class="col-sm-8">
                    <select name="gender" class="form-control" required="required">
                      <option value="">Select Gender</option>
                      <option value="male">Male</option>
                      <option value="female">Female</option>
                      <option value="others">Others</option>
                    </select>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label">Contact No : </label>
                  <div class="col-sm-8">
                    <input type="text" name="contact" id="contact" class="form-control" required="required">
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-sm-2 control-label">Email id: </label>
                  <div class="col-sm-8">
                    <input type="email" name="email" id="email" class="form-control" onBlur="checkAvailability()" required="required">
                    <span id="user-availability-status" style="font-size:12px;"></span>
                  </div>
                </div>

                <div class="form-group row">
                  <label class="col-sm-2 control-label">Password: </label>
                  <div class="col-sm-8">
                    <input type="password" name="password" id="password" class="form-control" required="required">
                  </div>
                </div>


                <div class="form-group row">
                  <label class="col-sm-2 control-label">Confirm Password : </label>
                  <div class="col-sm-8">
                    <input type="password" name="cpassword" id="cpassword" class="form-control" required="required">
                  </div>
                </div>

                <div class="col-sm-6 col-sm-offset-4">
                  <a href="index.php" class="btn btn-default" type="submit">Cancel</a>
                  <input type="submit" name="submit" Value="Register" class="btn btn-primary">
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

  <script>
    function checkAvailability() {

      $("#loaderIcon").show();
      jQuery.ajax({
        url: "check_availability.php",
        data: 'emailid=' + $("#email").val(),
        type: "POST",
        success: function(data) {
          $("#user-availability-status").html(data);
          $("#loaderIcon").hide();
        },
        error: function() {
          event.preventDefault();
          alert('error');
        }
      });
    }
  </script>
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