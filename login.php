 <?php
    session_start();
    include 'config.php';
    include 'dbconnect.php';
    include 'header.php';

    if (isset($_SESSION['login_error_message'])) {
        echo '<script>alert("' . $_SESSION['login_error_message'] . '");</script>';
        unset($_SESSION['login_error_message']); // Remove the error message from the session
    }
?>

 <!-- Modal For Login Form -->
        <div class="modal">
            <!-- Modal content -->
            <div class="modal-content">
                <div class="modal-header">
                    <!-- <span class="close">&times;</span> -->
                    <h2>Login Here</h2>
                </div>

                <div class="modal-body">
                    <!-- Form -->
                    <form action="userLogin.php" method ="POST" class="myForm">
                        <div class="customer_login"> 
                            <div class="form-group">
                                <label>Username / Email</label>
                                <input type="email" name="username" class="form-control username" placeholder="Username" autocomplete="off" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control password" placeholder="password" autocomplete="off" required>
                            </div>
                            <input type="submit" name="submit" class="btn" value="login"/>
                            <span>Don't Have an Account? <a href="register.php">Register</a></span>
                        </div>
                    </form>
                    <!-- /Form -->
                </div>
            </div>
        </div>


    <script src="js/index.js"></script>
    <script src="js/jquery-1.10.2.min.js"></script>
</body>

</html>