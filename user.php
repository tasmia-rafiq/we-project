<?php
include 'config.php';
include 'dbconnect.php';

//new login
// if(isset($_POST['username'])) {
//     $username = stripslashes($_POST['username']);
//     $username = mysqli_real_escape_string($conn, $username);
//     $password = stripslashes($_POST['password']);
//     $password = mysqli_real_escape_string($conn, $password);

//     $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
//     $result = mysqli_query($conn, $query) or die(mysqli_error($conn));
//     $rows = mysqli_num_rows($result);

//     if ($rows == 1) {
//         session_start();
//         $session_rows = mysqli_fetch_array($result);
//         $_SESSION['user_id'] = $session_rows['user_id'];
//         $_SESSION['username'] = $session_rows['f_name'];
//         $_SESSION['user_role'] = 'user';

//         $_SESSION['login_success'] = true; // Store a flag in the session to indicate successful login
//         header("Location: user_profile.php"); // Redirect the user to user_profile.php
//         exit();

//         // echo '
//         //     <script>
//         //         alert("Login Successful");
//         //         window.location.href = "user_profile.php";
//         //     </script>';
//     } else {
//         // echo '
//         //     <script>
//         //         alert("Login Failed");
//         //         window.location.href = "login.php";
//         //     </script>';
//         $_SESSION['login_success'] = false; // Store a flag in the session to indicate failed login
//         header("Location: login.php"); // Redirect the user back to login.php
//         exit();
//     }
// }


//login
// if(isset($_POST['username'])) {
//     $username = stripslashes($_POST['username']);
//     $username = mysqli_real_escape_string($conn, $username);
//     $password = stripslashes($_POST['password']);
//     $password = mysqli_real_escape_string($conn, $password);

//     $query = "SELECT * FROM user WHERE username = '$username' AND password = '$password'";
//     $result = mysqli_query($conn, $query) or die(mysql_error($conn));
//     $rows = mysqli_num_rows($result);

// 	if(!empty($result)){
// 		if ($rows > 1) {
// 			session_start();
// 			$session_rows = mysqli_fetch_array($result);
// 			$_SESSION['$user_id'] = $session_rows['user_id'];
// 			$_SESSION['$username'] = $session_rows['f_name'];
// 			$_SESSION['$user_role'] = 'user';
// 			// $_SESSION['username'] = $username;
// 			echo "
// 				<script>
// 					console.log('Login Successful');
// 					alert('Login Successful');
// 					window.location.href = 'user_profile.php';
// 				<script>";
// 			exit;
// 			// header("Location: user_profile.php");
// 		} else 
// 		{
// 			echo "
// 				<script>
// 					console.log('Login F');
// 					alert('Login Failed');
// 					window.location.href = 'login.php';
// 				</script>";
// 		}
// 	}else 
// 	{
// 		echo "
// 			<script>
// 				console.log('Login F');
// 				alert('Login Failed');
// 				window.location.href = 'login.php';
// 			</script>";
// 	}
// }

//register
    if(isset($_REQUEST['username'])){
        $f_name = stripslashes($_REQUEST['f_name']);
        $f_name = mysqli_real_escape_string($conn, $f_name);
        $l_name = stripslashes($_REQUEST['l_name']);
        $l_name = mysqli_real_escape_string($conn, $l_name);
        $username = stripslashes($_REQUEST['username']);
        $username = mysqli_real_escape_string($conn, $username);
        $password = stripslashes($_REQUEST['password']);
        $password = mysqli_real_escape_string($conn, $password);
        $mobile = stripslashes($_REQUEST['mobile']);
        $mobile = mysqli_real_escape_string($conn, $mobile);
        $address = stripslashes($_REQUEST['address']);
        $address = mysqli_real_escape_string($conn, $address);
        $city = stripslashes($_REQUEST['city']);
        $city = mysqli_real_escape_string($conn, $city);

		$query = "SELECT username FROM user WHERE username = '$username'";
		$response = mysqli_query($conn, $query) or die(mysqli_error($conn));
		$rows = mysqli_num_rows($response);
		if ($rows > 0) {
			echo '
                <script>
					alert("User Already Exists");
					window.location.href = "register.php";
				</script>';
		}else{

			$s = "INSERT INTO `user` (`f_name`, `l_name`, `username`, `password`, `mobile`, `address`, `city`, `user_role`) VALUES ('$f_name', '$l_name', '$username', '$password', '$mobile', '$address', '$city', '1')";
			$sResult = mysqli_query($conn, $s);

			if($sResult){
				echo '
                <script>
                    alert("You are registered successfully, login to continue!");
                    window.location.href = "login.php";
                </script>';
			}
			else{
				echo '
					<div class="register_alert">
						<h3>required Fields are missing</h3>
					</div>';
			}
		}
    }
