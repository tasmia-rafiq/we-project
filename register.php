<?php
include 'config.php';
session_start();
if(isset($_SESSION['user_id']) && $_SESSION['user_role'] == 'user') {
    include 'config.php';
    header("Location: " . $hostname."/user_profile.php");
}else{

    include 'header.php'; ?>

        <section class="registration_form section-pad1">
            <!-- Form -->
            <form id="register_sign_up" class="signup_form" action="user.php" method="POST">
                <h2>register here</h2>
                <div class="form-group">
                    <label>First Name</label>
                    <input type="text" name="f_name" class="form-control first_name" placeholder="First Name" requried />
                </div>
                <div class="form-group">
                    <label>Last Name</label>
                    <input type="text" name="l_name" class="form-control last_name" placeholder="Last Name" requried />
                </div>
                <div class="form-group">
                    <label>Username / Email</label>
                    <input type="email" name="username" class="form-control user_name" placeholder="Email Address" requried />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" name="password" class="form-control pass_word" placeholder="Password" requried />
                </div>
                <div class="form-group">
                    <label>Mobile</label>
                    <input type="phone" name="mobile" class="form-control mobile" placeholder="Mobile" requried />
                </div>
                <div class="form-group">
                    <label>Address</label>
                    <input type="text" name="address" class="form-control address" placeholder="Address" requried>
                </div>
                <div class="form-group">
                    <label>City</label>
                    <input type="text" name="city" class="form-control city" placeholder="City" requried>
                </div>
                <input type="submit" name="signup" class="btn" value="sign up"/>
                <p>Already Have an Account? <a href="login.php">Login</a></p>
                <div id="register_alert" class="register_alert"></div>
            </form>
            <!-- /Form -->
        </section> 
<?php
} ?>

<?php include 'footer.php' ?>
