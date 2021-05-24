<?php 
	include "./database_con.php";
	header('Content-type: application/json'); 
	
	if ($con->connect_error) {
			die("Connection failed: " . $con->connect_error);
		} 
		
	if (isset($_POST['tag']) && $_POST['tag'] != ''){
		$tag = $_POST['tag'];
		
		if ($tag == 'Register'){
			$phone=$_POST['phone'];
			$name=$_POST['name'];
			$email=$_POST['email'];
			
			$query ="SELECT  * FROM `user_tbl` WHERE `emailid`='".$email."' and `phone`='".$phone."'";
			$r=$con->query($query);
			if ($r->num_rows ==0) {
				$sql ="INSERT INTO `user_tbl`( `phone`, `name`,`emailid`) VALUES ('".$phone."','".$name."','".$email."')";
				$result = $con->query($sql);

				if ($result){
					// output data of each row
					$response['status']="success";
					
					echo json_encode($response);
				}else{
					$response['status']="failed";
					echo json_encode($response);
			   }
		    }else{
					$response['status']="error";
					echo json_encode($response);
			}
		
		}if ($tag == 'Login'){
		
		    $phone=$_POST['phone'];
			
			
			$query ="SELECT  * FROM `user_tbl` WHERE  `phone`='".$phone."'";
			$r=$con->query($query);
			if ($r) {
				    $row=$r->fetch_assoc();
					// output data of each row
					$otp=substr(str_shuffle("0123456789"), 0,6);
					//file_get_contents("http://enterprise.smsgupshup.com/GatewayAPI/rest?method=SendMessage&send_to=$phone&msg=Your%20OTP%20for%20the%20Verification%20is%20$otp%0AThank%20you%20&msg_type=TEXT&userid=1222&auth_scheme=plain&password=1234&v=1.1&format=text");
					$response['status']="success";
					$response['id']=$row['id'];
					$response['phone']=$row['phone'];
					$response['name']=$row['name'];
					$response['email']=$row['emailid'];
					$response['otp']=$otp;	
					echo json_encode($response);
				
		    }else{
					$response['status']="failed";
					echo json_encode($response);
			}
		
		}if ($tag == 'OTP'){
		
		
		}if ($tag == 'UpdateLocation'){
		
		
		}if ($tag == 'Newgroup'){
		
		
		}
		
	
	}
?>