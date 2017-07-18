if(isset($_POST['login'])){
		// php code goes here
		require_once 'conn.php';

		$uname = $_POST['uname'];
		$pwd = $_POST['pwd'];
    
		// check for user name or email address 
		$sql = "SELECT * FROM user WHERE username = '$uname' OR user_email = '$uname'";

		$result = $conn->query($sql);
		if ($result->num_rows < 1){
			header("Location: $url?login=error");
		}
		else {
			if ($row = $result->fetch_assoc()) {
				// de-hashing the password
				$hashedpwdCheck = password_hash($pwd, $row['user_pwd']);
				$type = $row['account_type'];
			if ($hashedpwdCHeck == false)
			{
        //setting session for multipages.
				
				$_SESSION['u_id'] = $row['user_id'];
				$_SESSION['u_first'] = $row['first_name'];
				$_SESSION['u_last'] = $row['last_name'];
				$_SESSION['u_email'] = $row['user_email'];
				$_SESSION['u_type'] = $row['account_type'];
				$_SESSION['u_uid'] = $row['useoutame'];
        
        //check type of user whether its admin or user.
				if($type == 3){
					header("Location: ../dashboard.php?login=success");
					exit();
				}		
				else{
					header("Location: $url?login=success");
					exit();
				}

				

			}
			  				
			}
		}
	}
// logout code 
elseif(isset($_GET['logout'])){
	session_unset();
	session_destroy();
	if($_GET['logout'] == 3){
		header("Location: ../index.php?logout=success");
		exit();
	}
	else
	header("Location: $url?logout=success");
	exit();
}
