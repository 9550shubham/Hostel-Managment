<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();

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
            <div class="col-sm-12">
              <div class="home-tab">
                <div class="tab-content tab-content-basic">
                  <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview">
                  <br>
                  <br>
                  <br>
                    <div class="row">
                      <?php
                      $timezone = new DateTimeZone("Asia/Kolkata");
                      $current_date_time = new DateTime("now", $timezone);

                      $day = $current_date_time->format("l"); // Day
                      $month = $current_date_time->format("F"); // Month
                      $year = $current_date_time->format("Y"); // Year
                      $time = $current_date_time->format("h:i A"); // Time
                      ?>

                      <br>

                      <div class="col-sm-12 mt-10">
                        <div class="statistics-details d-flex align-items-center justify-content-between">
                          <div>
                            <p class="statistics-title">Day</p>
                            <h3 class="rate-percentage"><?php echo $day; ?></h3>
                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span></span></p>
                          </div>
                          <div>
                            <p class="statistics-title">Month</p>
                            <h3 class="rate-percentage"><?php echo $month; ?></h3>
                            <p class="text-success d-flex"><i class="mdi mdi-menu-up"></i><span></span></p>
                          </div>
                          <div>
                            <p class="statistics-title">Year</p>
                            <h3 class="rate-percentage"><?php echo $year; ?></h3>
                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span></span></p>
                          </div>
                          <div>
                            <p class="statistics-title">Time</p>
                            <h3 class="rate-percentage"><?php echo $time; ?></h3>
                            <p class="text-danger d-flex"><i class="mdi mdi-menu-down"></i><span></span></p>
                          </div>
                        </div>
                      </div>

                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- content-wrapper ends -->
    <!-- partial:partials/_footer.html -->
    <?php include "includes/footer.php" ?>
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