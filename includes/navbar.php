<nav class="navbar default-layout col-lg-12 col-12 p-0 fixed-top d-flex align-items-top flex-row">
    <div class="text-center navbar-brand-wrapper d-flex align-items-center justify-content-start">
        <div class="me-3">
            <button class="navbar-toggler navbar-toggler align-self-center" type="button" data-bs-toggle="minimize">
                <span class="icon-menu"></span>
            </button>
        </div>
        <div>
            <a class="navbar-brand brand-logo" href="dashboard.php">
                <h4 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 20px; color: #333;">Thapar College</h4>
            </a>
            <a class="navbar-brand brand-logo-mini" href="dashboard.php">
                <h4 style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; font-size: 20px; color: #333;">Thapar College</h4>
            </a>
        </div>

    </div>
    <div class="navbar-menu-wrapper d-flex align-items-top">
        <ul class="navbar-nav">
            <li class="nav-item font-weight-semibold d-none d-lg-block ms-0">
                <?php
                // assuming $session_id contains the current session ID
                $sql = "SELECT `id`, `regNo`, `firstName`, `middleName`, `lastName`, `gender`, `contactNo`, `email`, `password`, `regDate`, `updationDate`, `passUdateDate` FROM `userregistration` WHERE id = $session_id";
                $result = mysqli_query($conn, $sql);
                $row = mysqli_fetch_assoc($result);
                $studentName = $row['firstName'];
                $studentEmail = $row['email'];
                $studentlastName = $row['lastName'];

            

                ?>

                <h1 class="welcome-text">Hello, <span class="text-black fw-bold"><?php echo $studentName ?> </span></h1>

                <h3 class="welcome-sub-text">Your Home Away from Home </h3>
            </li>
        </ul>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown d-none d-lg-block user-dropdown">
                <a class="nav-link" id="UserDropdown" href="#" data-bs-toggle="dropdown" aria-expanded="false">
                    <img class="img-xs rounded-circle" style="width: 40px; height: 40px;" src="images/faces/user.png" alt="Profile image"> </a>
                <div class="dropdown-menu dropdown-menu-right navbar-dropdown" aria-labelledby="UserDropdown">
                    <div class="dropdown-header text-center">
                        <img class="img-md rounded-circle" style="width: 40px; height: 40px;" src="images/faces/user.png" alt="Profile image">
                        <p class="mb-1 mt-3 font-weight-semibold"><?php echo $studentName ?> <?php echo $studentlastName ?> </p>
                        <p class="fw-light text-muted mb-0"><?php echo $studentEmail ?></p>
                    </div>
                    <a href="my-profile.php" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-account-outline text-primary me-2"></i> My Profile <span class="badge badge-pill badge-danger">1</span></a>
                    <a href="logout.php" class="dropdown-item"><i class="dropdown-item-icon mdi mdi-power text-primary me-2"></i>Sign Out</a>
                </div>
            </li>
        </ul>
        <button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-bs-toggle="offcanvas">
            <span class="mdi mdi-menu"></span>
        </button>
    </div>
</nav>