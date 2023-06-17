<?php
include 'config.php';
include 'dbconnect.php';

session_start();

if (isset($_SESSION['login_success']) && $_SESSION['login_success'] === true) {
    echo '<script>alert("Login Successful");</script>';
    // Clear the flag from the session after displaying the alert
    $_SESSION['login_success'] = null;
} elseif (isset($_SESSION['login_success']) && $_SESSION['login_success'] === false) {
    echo '<script>alert("Login Failed");</script>';
    // Clear the flag from the session after displaying the alert
    $_SESSION['login_success'] = null;
}

// session_start();
// if(!isset($_SESSION["user_id"]) && $_SESSION["user_role"] != "user") {
//     header("location: " . $hostname);
// }
include 'header.php'; ?>

    <section id="user_profile" class="user_profile section-pad1">
        <h2>My Profile</h2>
        <?php
            $user_id = $_SESSION["user_id"];
            $sql = "SELECT * FROM user WHERE user_id = $user_id";
            $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
            $count = mysqli_num_rows($result);

            if ($count == 1)
            { 
                while($rows = mysqli_fetch_assoc($result))
                {
                    ?>
                    <table>
                        <tbody>
                            <tr>
                                <th>First Name :</th>
                                <td><?php echo $rows["f_name"]; ?></td>
                            </tr>
                            <tr>
                                <th>Last Name :</th>
                                <td><?php echo $rows["l_name"]; ?></td>
                            </tr>
                            <tr>
                                <th>Username <br> /Email :</th>
                                <td><?php echo $rows["username"]; ?></td>
                            </tr>
                            <tr>
                                <th>Mobile :</th>
                                <td><?php echo $rows["mobile"]; ?></td>
                            </tr>
                            <tr>
                                <th>Address :</th>
                                <td><?php echo $rows["address"]; ?></td>
                            </tr>
                            <tr>
                                <th>City :</th>
                                <td><?php echo $rows["city"]; ?></td>
                            </tr>
                        </tbody>
                    </table>
                    <?php
                }
            }?>
    </section>


    <!-- <div id="user_profile-content">
        <div class="container">
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <h2 class="section-head">My Profile</h2>
                    <?php
                        $user_id = $_SESSION["user_id"];
                        $sql = "SELECT * FROM user WHERE 'user_id' = '$user_id'";
                        $result = mysqli_query($conn, $sql) or die(mysqli_error($conn));
                        $count = mysqli_num_rows($result);

                        if ($count == 1) {
                            $table = '<table>';
                            foreach($result as $row) { ?>
                                <table class="table table-bordered table-responsive">
                                    <tr>
                                        <td><b>First Name :</b></td>
                                        <td><?php echo $row["f_name"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Last Name :</b></td>
                                        <td><?php echo $row["l_name"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Username :</b></td>
                                        <td><?php echo $row["username"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Mobile :</b></td>
                                        <td><?php echo $row["mobile"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>Address :</b></td>
                                        <td><?php echo $row["address"]; ?></td>
                                    </tr>
                                    <tr>
                                        <td><b>City :</b></td>
                                        <td><?php echo $row["city"]; ?></td>
                                    </tr>
                                </table>
                            <?php }
                        }
                        ?>
                        <a class="modify-btn btn" href="edit_user.php?user=<?php echo $_SESSION['user_id']; ?>">Modify Details</a>
                        <a class="modify-btn btn" href="change_password.php">Change Password</a>
                </div>
            </div>
        </div>
    </div> -->
    
<?php include 'footer.php'; ?>
