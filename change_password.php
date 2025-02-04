<?php
include("session.php");

$errorMessage = "";

if (isset($_POST['updatepassword'])) {
    $curr_password = $_POST['curr_password'];
    $new_password = $_POST['new_password'];
    $confirm_new_password = $_POST['confirm_new_password'];

    $curr_password_hash = md5($curr_password);
    $fetch_password_query = "SELECT password FROM users WHERE user_id = '$userid'";
    $result = mysqli_query($con, $fetch_password_query);

    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $stored_password_hash = $row['password'];

        if ($curr_password_hash === $stored_password_hash && $new_password === $confirm_new_password) {
            $new_password_hash = md5($new_password);

            $update_password_query = "UPDATE users SET password = '$new_password_hash' WHERE user_id = '$userid'";
            if (mysqli_query($con, $update_password_query)) {
                $errorMessage = "<div class='alert alert-success text-center' role='alert'>Password updated successfully.</div>";
            } else {
                $errorMessage = "<div class='alert alert-danger text-center' role='alert'>Error updating password: " . mysqli_error($con) . "</div>";
            }
        } else {
            $errorMessage = "<div class='alert alert-danger text-center' role='alert'>Current password is incorrect or new passwords do not match.</div>";
        }
    } else {
        $errorMessage = "<div class='alert alert-danger text-center' role='alert'>Error fetching password: " . mysqli_error($con) . "</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>DompetKu - Change Password</title>

    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">

    <!-- Feather JS for Icons -->
    <script src="js/feather.min.js"></script>

    <style>
        @media (max-width: 767px) {
            /* Adjust the font size for smaller screens */
            footer {
                font-size: 12px; /* You can adjust the size as needed */
            }
        }
    </style>

</head>

<body>

    <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="border-right" id="sidebar-wrapper">
            <div class="user">
                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="120">
                <h5><?php echo $username ?></h5>
                <p><?php echo $useremail ?></p>
            </div>
            <div class="sidebar-heading">Management</div>
            <div class="list-group list-group-flush">
            <a href="index.php" class="list-group-item list-group-item-action"><span data-feather="home"></span> Dashboard</a>
                <a href="add_expense.php" class="list-group-item list-group-item-action "><span data-feather="plus-square"></span> Add Expense</a>
                <a href="manage_expense.php" class="list-group-item list-group-item-action"><span data-feather="dollar-sign"></span> Manage Expense</a>
                <a href="add_income.php" class="list-group-item list-group-item-action "><span data-feather="plus-square"></span> Add Income</a>
                <a href="manage_income.php" class="list-group-item list-group-item-action"><span data-feather="dollar-sign"></span> Manage Income</a>
            </div>
            <div class="sidebar-heading">Settings </div>
            <div class="list-group list-group-flush">
                <a href="profile.php" class="list-group-item list-group-item-action"><span data-feather="user"></span> Profile</a>
                <a href="change_password.php" class="list-group-item list-group-item-action sidebar-active"><span data-feather="key"></span> Change Password</a>
                <a href="logout.php" class="list-group-item list-group-item-action"><span data-feather="power"></span> Logout</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->

        <!-- Page Content -->
        <div id="page-content-wrapper">

            <nav class="navbar navbar-expand-lg navbar-light  border-bottom">


                <button class="toggler" type="button" id="menu-toggle" aria-expanded="false">
                    <span data-feather="menu"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Link</a>
                        </li> -->
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="img img-fluid rounded-circle" src="<?php echo $userprofile ?>" width="25">
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="#">Your Profile</a>
                                <a class="dropdown-item" href="#">Edit Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php">Logout</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <div class="container-fluid">
                <div class="row justify-content-center">
                    <div class="col-md-6">
                        <h3 class="mt-4 text-center">Change Password</h3>
                        <hr>
                        <?php echo $errorMessage; ?>
                        <form class="form" action="" method="post" id="changePasswordForm" autocomplete="off">
                            <div class="form-group">
                                <label for="curr_password">Enter Current Password</label>
                                <input type="password" class="form-control" name="curr_password" id="curr_password" placeholder="Current Password" required>
                            </div>
                            <div class="form-group">
                                <label for="new_password">Enter New Password</label>
                                <input type="password" class="form-control" name="new_password" id="new_password" placeholder="New Password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_new_password">Confirm New Password</label>
                                <input type="password" class="form-control" name="confirm_new_password" id="confirm_new_password" placeholder="Confirm New Password" required>
                            </div>
                            <div class="form-group mt-4">
                                <button class="btn btn-block btn-primary" name="updatepassword" type="submit">Update Password</button>
                            </div>
                        </form>

                        <!-- Additional form elements as per your design -->
                        <!-- ... -->

                    </div>
                </div>
            </div>
        </div>
        <!-- /#page-content-wrapper -->

    </div>
    <!-- /#wrapper -->

    <!-- Bootstrap core JavaScript -->
    <script src="js/jquery.slim.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/Chart.min.js"></script>
    <!-- Menu Toggle Script -->
    <script>
        $("#menu-toggle").click(function(e) {
            e.preventDefault();
            $("#wrapper").toggleClass("toggled");
        });
    </script>
    <script>
        feather.replace()
    </script>

      <!-- Footer Section -->
  <footer class="bg-success text-white text-center py-3">
    <div class="container" style="margin-bottom: -15px;">
      <p>&copy; <?php echo date("Y"); ?> DompetKu. All rights reserved.<br>
      CREDITS:
      Malvin Leonardo Hartanto (NRP 5025221033) & Ranto Bastara Hamonangan Sitorus (NRP 5025221228)<br>
      Kuliah Pemrograman Web Jurusan Teknik Informatika ITS (2023). Dosen: Imam Kuswardayan, S.Kom, M.T</p>
    </div>
  </footer>
</body>

</html>