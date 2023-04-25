<?php
session_start();
include('includes/config.php');
include('includes/checklogin.php');
check_login();
//code for registration
if (isset($_POST['submit'])) {
    $roomno = $_POST['room'];
    $seater = $_POST['seater'];
    $feespm = $_POST['fpm'];
    $foodstatus = $_POST['foodstatus'];
    $stayfrom = $_POST['stayf'];
    $duration = $_POST['duration'];
    $course = $_POST['course'];
    $regno = $_POST['regno'];
    $fname = $_POST['fname'];
    $mname = $_POST['mname'];
    $lname = $_POST['lname'];
    $gender = $_POST['gender'];
    $contactno = $_POST['contact'];
    $emailid = $_POST['email'];
    $emcntno = $_POST['econtact'];
    $gurname = $_POST['gname'];
    $gurrelation = $_POST['grelation'];
    $gurcntno = $_POST['gcontact'];
    $caddress = $_POST['address'];
    $ccity = $_POST['city'];
    $cstate = $_POST['state'];
    $cpincode = $_POST['pincode'];
    $paddress = $_POST['paddress'];
    $pcity = $_POST['pcity'];
    $pstate = $_POST['pstate'];
    $ppincode = $_POST['ppincode'];
    $query = "insert into  registration(roomno,seater,feespm,foodstatus,stayfrom,duration,course,regno,firstName,middleName,lastName,gender,contactno,emailid,egycontactno,guardianName,guardianRelation,guardianContactno,corresAddress,corresCIty,corresState,corresPincode,pmntAddress,pmntCity,pmnatetState,pmntPincode) values(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)";
    $stmt = $mysqli->prepare($query);
    $rc = $stmt->bind_param('iiiisisissssisississsisssi', $roomno, $seater, $feespm, $foodstatus, $stayfrom, $duration, $course, $regno, $fname, $mname, $lname, $gender, $contactno, $emailid, $emcntno, $gurname, $gurrelation, $gurcntno, $caddress, $ccity, $cstate, $cpincode, $paddress, $pcity, $pstate, $ppincode);
    $stmt->execute();
    echo "<script>alert('Student Succssfully register');</script>";
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
    <script>
        function getSeater(val) {
            $.ajax({
                type: "POST",
                url: "get_seater.php",
                data: 'roomid=' + val,
                success: function(data) {
                    //alert(data);
                    $('#seater').val(data);
                }
            });

            $.ajax({
                type: "POST",
                url: "get_seater.php",
                data: 'rid=' + val,
                success: function(data) {
                    //alert(data);
                    $('#fpm').val(data);
                }
            });
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
                        <div class="col-md-3 grid-margin stretch-card">
                        </div>
                        <div class="col-md-6 grid-margin stretch-card">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title">Booking Details</h4>


                                    <form method="post" action="" class="forms-sample">
                                        <?php
                                        $uid = $_SESSION['login'];
                                        $stmt = $mysqli->prepare("SELECT emailid FROM registration WHERE emailid=? ");
                                        $stmt->bind_param('s', $uid);
                                        $stmt->execute();
                                        $stmt->bind_result($email);
                                        $rs = $stmt->fetch();
                                        $stmt->close();
                                        if ($rs) { ?>
                                            <h3 style="color: red" align="left">You have already booked room.</h3>
                                        <?php } else {
                                            echo "";
                                        }
                                        ?>
                                        <div class="form-group row">
                                            <label class="col-sm-4 control-label">
                                                <h4 style="color: green" align="left">Room Details </h4>
                                            </label>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">Room no. </label>
                                            <div class="col-sm-8">
                                                <select name="room" id="room" class="form-control" onChange="getSeater(this.value);" onBlur="checkAvailability()" required>
                                                    <option value="">Select Room</option>
                                                    <?php $query = "SELECT * FROM rooms";
                                                    $stmt2 = $mysqli->prepare($query);
                                                    $stmt2->execute();
                                                    $res = $stmt2->get_result();
                                                    while ($row = $res->fetch_object()) {
                                                    ?>
                                                        <option value="<?php echo $row->room_no; ?>"> <?php echo $row->room_no; ?></option>
                                                    <?php } ?>
                                                </select>
                                                <span id="room-availability-status" style="font-size:12px;"></span>

                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">Seater</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="seater" id="seater" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">Fees Per Month</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="fpm" id="fpm" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">Food Status</label>
                                            <div class="col-sm-8">
                                                <input type="radio" value="0" name="foodstatus" checked="checked"> Without Food
                                                <input type="radio" value="1" name="foodstatus"> With Food(Rs 2000.00 Per Month Extra)
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">Stay From</label>
                                            <div class="col-sm-8">
                                                <input type="date" name="stayf" id="stayf" class="form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">Duration</label>
                                            <div class="col-sm-8">
                                                <select name="duration" id="duration" class="form-control">
                                                    <option value="">Select Duration in Month</option>
                                                    <option value="1">1</option>
                                                    <option value="2">2</option>
                                                    <option value="3">3</option>
                                                    <option value="4">4</option>
                                                    <option value="5">5</option>
                                                    <option value="6">6</option>
                                                    <option value="7">7</option>
                                                    <option value="8">8</option>
                                                    <option value="9">9</option>
                                                    <option value="10">10</option>
                                                    <option value="11">11</option>
                                                    <option value="12">12</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">Total Amount</label>
                                            <div class="col-sm-8">
                                                <input type="text" name="ta" id="ta" class="result form-control">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">
                                                <h4 style="color: green" align="left">Personal info </h4>
                                            </label>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">course </label>
                                            <div class="col-sm-8">
                                                <select name="course" id="course" class="form-control" required>
                                                    <option value="">Select Course</option>
                                                    <?php $query = "SELECT * FROM courses";
                                                    $stmt2 = $mysqli->prepare($query);
                                                    $stmt2->execute();
                                                    $res = $stmt2->get_result();
                                                    while ($row = $res->fetch_object()) {
                                                    ?>
                                                        <option value="<?php echo $row->course_fn; ?>"><?php echo $row->course_fn; ?>&nbsp;&nbsp;(<?php echo $row->course_sn; ?>)</option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

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

                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label">Registration No : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="regno" id="regno" class="form-control" value="<?php echo $row->regNo; ?>" readonly>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label">First Name : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="fname" id="fname" class="form-control" value="<?php echo $row->firstName; ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label">Middle Name : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="mname" id="mname" class="form-control" value="<?php echo $row->middleName; ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label">Last Name : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="lname" id="lname" class="form-control" value="<?php echo $row->lastName; ?>" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label">Gender : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="gender" value="<?php echo $row->gender; ?>" class="form-control" readonly>
                                                </div>
                                            </div>

                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label">Contact No : </label>
                                                <div class="col-sm-8">
                                                    <input type="text" name="contact" id="contact" value="<?php echo $row->contactNo; ?>" class="form-control" readonly>
                                                </div>
                                            </div>


                                            <div class="form-group row">
                                                <label class="col-sm-2 control-label">Email id : </label>
                                                <div class="col-sm-8">
                                                    <input type="email" name="email" id="email" class="form-control" value="<?php echo $row->email; ?>" readonly>
                                                </div>
                                            </div>
                                        <?php } ?>
                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">Emergency Contact: </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="econtact" id="econtact" class="form-control" required="required">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">Guardian Name : </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="gname" id="gname" class="form-control" required="required">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">Guardian Relation : </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="grelation" id="grelation" class="form-control" required="required">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">Guardian Contact no : </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="gcontact" id="gcontact" class="form-control" required="required">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 control-label">
                                                <h4 style="color: green" align="left">Correspondense Address </h4>
                                            </label>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">Address : </label>
                                            <div class="col-sm-8">
                                                <textarea rows="5" name="address" id="address" class="form-control" required="required"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">City : </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="city" id="city" class="form-control" required="required">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">State </label>
                                            <div class="col-sm-8">
                                                <select name="state" id="state" class="form-control" required>
                                                    <option value="">Select State</option>
                                                    <?php $query = "SELECT * FROM states";
                                                    $stmt2 = $mysqli->prepare($query);
                                                    $stmt2->execute();
                                                    $res = $stmt2->get_result();
                                                    while ($row = $res->fetch_object()) {
                                                    ?>
                                                        <option value="<?php echo $row->State; ?>"><?php echo $row->State; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">Pincode : </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="pincode" id="pincode" class="form-control" required="required">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-3 control-label">
                                                <h4 style="color: green" align="left">Permanent Address </h4>
                                            </label>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-sm-5 control-label">Permanent Address same as Correspondense address : </label>
                                            <div class="col-sm-4">
                                                <input type="checkbox" name="adcheck" value="1" />
                                            </div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">Address : </label>
                                            <div class="col-sm-8">
                                                <textarea rows="5" name="paddress" id="paddress" class="form-control" required="required"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">City : </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="pcity" id="pcity" class="form-control" required="required">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">State </label>
                                            <div class="col-sm-8">
                                                <select name="pstate" id="pstate" class="form-control" required>
                                                    <option value="">Select State</option>
                                                    <?php $query = "SELECT * FROM states";
                                                    $stmt2 = $mysqli->prepare($query);
                                                    $stmt2->execute();
                                                    $res = $stmt2->get_result();
                                                    while ($row = $res->fetch_object()) {
                                                    ?>
                                                        <option value="<?php echo $row->State; ?>"><?php echo $row->State; ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="col-sm-2 control-label">Pincode : </label>
                                            <div class="col-sm-8">
                                                <input type="text" name="ppincode" id="ppincode" class="form-control" required="required">
                                            </div>
                                        </div>


                                        <div class="col-sm-6 col-sm-offset-4">
                                            <button class="btn btn-default" type="submit">Cancel</button>
                                            <input type="submit" name="submit" Value="Register" class="btn btn-primary">
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
    <script type="text/javascript">
        $(document).ready(function() {
            $('input[type="checkbox"]').click(function() {
                if ($(this).prop("checked") == true) {
                    $('#paddress').val($('#address').val());
                    $('#pcity').val($('#city').val());
                    $('#pstate').val($('#state').val());
                    $('#ppincode').val($('#pincode').val());
                }

            });
        });
    </script>
    <script>
        function checkAvailability() {
            $("#loaderIcon").show();
            jQuery.ajax({
                url: "check_availability.php",
                data: 'roomno=' + $("#room").val(),
                type: "POST",
                success: function(data) {
                    $("#room-availability-status").html(data);
                    $("#loaderIcon").hide();
                },
                error: function() {}
            });
        }
    </script>


    <script type="text/javascript">
        $(document).ready(function() {
            $('#duration').keyup(function() {
                var fetch_dbid = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: "ins-amt.php?action=userid",
                    data: {
                        userinfo: fetch_dbid
                    },
                    success: function(data) {
                        $('.result').val(data);
                    }
                });


            })
        });
    </script>

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