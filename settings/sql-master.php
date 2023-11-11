<?php
	session_start();
	include_once('master-class.php');

	$con = new MasterClass;

	//get action
	$action = '';
	if(isset($_GET['action'])){
		$action = $_GET['action'];
	}

	function checkUsername($username){
		$get_username = $con->getRows('system_users', 
							array('where'=>'username="'.$username.'"', 'return_type'=>'single'));
		return $get_username?$get_username:false;
	}

	//user login
	if(isset($_POST['signin'])){
		$username 		= $con->clean($_POST['username']);
		$password 	= sha1($con->clean($_POST['password']));

		$check_user = $con->getRows('system_users', 
							array('where'=>'username="'.$username.'" and password="'.$password.'"', 'return_type'=>'single'));
		if(!empty($check_user)){
			$name = '';
			$band = '';
			if($check_user['member_of'] == 0){
				$get_name = $con->getRows('muscco_members', 
								  array('where'=>'muscco_member_id="'.$check_user['member_id'].'"', 'return_type'=>'single'));
				$name = ucwords($get_name['first_name']);
				$band = $get_name['band_id'];
			}elseif($check_user['member_of'] == 999){
				$get_name = $con->getRows('des', 
								  array('where'=>'de_id="'.$check_user['member_id'].'"', 'return_type'=>'single'));
				$name = ucwords($get_name['first_name']);
			}else{
				$get_name = $con->getRows('sacco_members', 
								  array('where'=>'sacco_member_id="'.$check_user['member_id'].'"', 'return_type'=>'single'));
				$name = ucwords($get_name['first_name']);
			}
			//checks the account status
			if($check_user['account_status'] == 0){
				//account needs password setting
				$_SESSION['USR_ID']	  = $check_user['member_id'];
				$_SESSION['USR_SESS'] = "SET_PASS";
				$_SESSION['USR_NME']  = $name;
				$_SESSION['USR_TYP']  = $check_user['user_role'];
				$_SESSION['USR_OF']   = $check_user['member_of'];
				$_SESSION['USR_BD']	  = $band;
				echo "6";
			}elseif($check_user['account_status'] == 1){
				$_SESSION['USR_ID']	  = $check_user['member_id'];
				$_SESSION['USR_SESS'] = "VAL";
				$_SESSION['USR_NME']  = $name;
				$_SESSION['USR_TYP']  = $check_user['user_role'];
				$_SESSION['USR_OF']   = $check_user['member_of'];
				$_SESSION['USR_BD']	  = $band;
				$con->userRedirect($check_user['user_role']);
			}elseif($check_user['account_status'] == 2){
				//deactivated
				echo "7";
			}elseif($check_user['account_status'] == 3){
				//blocked account
				echo "8";
			}
		}else{
			//wrong password/email
			echo "9";
		}
	}

	//unlock account after inactivity or just normal locking
	if(isset($_POST['unlock_account'])){
		$password = $con->clean($_POST['pass']);
		$user_id  = $con->clean($_POST['user_id']);
		$url 	  = $con->clean($_POST['url']);

		$unlock   = $con->getRows('system_users', 
							array('where'=>'member_id="'.$user_id.'" and password="'.sha1($password).'"', 'return_type'=>'single'));
		if(!empty($unlock)){
			$_SESSION['USR_SESS'] = "VAL";
			echo $url;
		}else{
			echo "1";
		}
	}

	//deactivate account
	if($action == "deactivate_account"){
		$deactivate = $con->update('system_users',array('account_status'=>2), array('member_id'=>$con->clean($_GET['id'])));
		if(!empty($deactivate)){
			echo "1";
		}else{
			echo "2";
		}
	}

	//reactivate account
	//Once the account has been reactivated, the password must also be reset
	if($action == "reactivate_account"){
		$reactivate = $con->update('system_users',array('account_status'=>0), array('member_id'=>$con->clean($_GET['id'])));
		if(!empty($reactivate)){
			echo "1";
		}else{
			echo "2";
		}
	}

	//grant_access rights to the user
	if($action == "grant_access"){
		$member_id = $con->clean($_GET['member']);
		$permission_id = $con->clean($_GET['id']);

		//some permission are not to be assigned to anyone, so it checks if the selected member qualifies

		//checks if the given permission is already assigned.
		$check_access = $con->getRows('permissions_granted', array('where'=>'member_id="'.$member_id.'" 
						and permission_id="'.$permission_id.'"', 'return_type'=>'single'));
		if(empty($check_access)){
			//if everything is in order grant access
			$grant = $con->insert('permissions_granted', array('member_id'=>$member_id, 'permission_id'=>$permission_id, 'assigned_by'=>$_SESSION['USR_ID']));
			if(!empty($grant)){
				//depending with the permission granted, it may update the system user table especially the role column
				if($permission_id == 1){
					//if the permission is super user, please update the role column
					$con->update('system_users', array('user_role'=>0), array('member_id'=>$member_id));					
				}
				echo "1";
			}else{
				echo "2";
			}
		}else{
			echo "3";
		}

		
	}

	//revoke access
	if($action == "revoke_permision"){
		$member_id = $con->clean($_GET['member']);
		$permission_id = $con->clean($_GET['pem']);

		$revoke = $con->delete('permissions_granted', array('granted_id'=>$con->clean($_GET['id'])));
		if(!empty($revoke)){
			if($permission_id == 1){
				//if the permission is super user, please update the role column
				$con->update('system_users', array('user_role'=>2), array('member_id'=>$member_id));					
			}
			echo "1";
		}else{
			echo "2";
		}
	}

	//admin reset password for other members
	if(isset($_POST['reset_password'])){
		$password = $con->clean($_POST['password']);
		$uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number    = preg_match('@[0-9]@', $password);
		$specialChars = preg_match('@[^\w]@', $password);

		if(!$uppercase || !$lowercase || !$number || strlen($password) < 8 || !$specialChars) {
		  // tell the user something went wrong
			echo "3";
			exit();
		}

		$reset_password = $con->update(
									'system_users',
									array('password'=>sha1($con->clean($_POST['password']))), 
									array('member_id'=>$con->clean($_POST['user_id']))
								);
		

		if(!empty($reset_password)){
			echo "1";
		}else{
			echo "2";
		}
	}

	//user change password
	if(isset($_POST['reset_password_user'])){
		//confirm the current password
		$current_password = $con->getRows('system_users', array('where'=>'member_id="'.$_POST['user_id'].'"','return_type'=>'single'));
		if($current_password['password'] != sha1($_POST['old_password'])){
			echo "3";
			exit();
		}

		// Validate alphanumeric
		/*
		if (!preg_match('/^[a-zA-Z]+[a-zA-Z0-9._]+$/', $_POST['password'])) {
		    // Valid
			echo "4";
			exit();
		} */
		$password = $con->clean($_POST['password']);
		$uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number    = preg_match('@[0-9]@', $password);
		$specialChars = preg_match('@[^\w]@', $password);

		if(!$uppercase || !$lowercase || !$number || strlen($password) < 8 || !$specialChars) {
		  // tell the user something went wrong
			echo "4";
			exit();
		}


		$reset_password = $con->update(
									'system_users',
									array('password'=>sha1($con->clean($_POST['password']))), 
									array('member_id'=>$con->clean($_POST['user_id']))
								);
		if(!empty($reset_password)){
			echo "1";
		}else{
			echo "2";
		}

	}

	//admin change username
	if(isset($_POST['change_username'])){
		$username = $con->clean($_POST['username']);
		//checks if the entered username is being used by another team
		$check = $con->getRows('system_users', array('where'=>'username="'.$username.'"'));
		if(!empty($check)){
			echo "5";
			exit();
		}
		$change = $con->update('system_users', array('username'=>$username), array('member_id'=>$con->clean($_POST['user_id'])));
		if(!empty($change)){
			echo "3";
		}else{
			echo "4";
		}
	}


	//register muscco staff member
	if(isset($_POST['save_staff'])){
		$id = $con->get_random_string_max(60);
		$profile_picture = "";

		//checks password validity
		$password = $con->clean($_POST['password']);
		$uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number    = preg_match('@[0-9]@', $password);
		$specialChars = preg_match('@[^\w]@', $password);

		if(!$uppercase || !$lowercase || !$number || strlen($password) < 8 || !$specialChars) {
		  // tell the user something went wrong
			echo "5";
			exit();
		}


		//checks if the profile picture has been uploaded
		if(!empty($_FILES['file']['name'])){
			//upload directory
	        $fileDir  = "../uploads/profiles/";

	        //allowed file types to upload
	        $fileTypes = array('.jpeg','.jpg','.png', '.gif'); 

	        //file names
	        $fileName  = "";

	        $file = $_FILES['file']['name'];
	        $file_ext= substr($file, strripos($file, '.')); // get file name
	        $file_basename = substr($file, 0, strripos($file, '.')); // get file extention
	        $fileName = $_POST['first_name']."_".time(). $file_ext;//renames the file

	        //checks if the file type is valid
	        if (!in_array(strtolower($file_ext),$fileTypes)) {
	            echo "8";
	            exit();
	        }

	        //if everything is in order upload the picture
	        $file_temp =$_FILES['file']['tmp_name'];

	        if(move_uploaded_file($file_temp, $fileDir.$fileName)){
	        	$profile_picture = $fileName;
	        }
		}


		$data = array(
				'muscco_member_id' => $id,
				'employee_id'	   => $con->clean($_POST['emp_number']),
				'first_name'	   => $con->clean($_POST['first_name']),
				'last_name'		   => $con->clean($_POST['last_name']),
				'email_address'	   => $con->clean($_POST['email']),
				'phone_number'	   => $con->clean($_POST['phone']),
				'position_id'	   => $con->clean($_POST['position']),
				'department_id'	   => $con->clean($_POST['department']),
				'dob'			   => $con->clean($_POST['dob']),
				'join_date'		   => $con->clean($_POST['dos']),
				'band_id'		   => $con->clean($_POST['band']),
				'thumb'			   => $profile_picture,
				'branch'		   => $con->clean($_POST['branch'])
			);
		$save_staff = $con->insert('muscco_members', $data);
		if(!empty($save_staff)){
			$login_data = array(
								'member_id' => $id,
								'username'  => $con->clean($_POST['username']),
								'password'  => sha1($password),
								'user_role' => 2,
								'member_of' => 0
							);
			$con->insert('system_users', $login_data);
			echo "1";
		}else{
			echo "2";
		}
	}

	//add des
	if(isset($_POST['save_de'])){
		$id = $con->get_random_string_max(60);
		$profile_picture = "";

		//checks if the username is already in use
		$get_username = $con->getRows('system_users', 
							array('where'=>'username="'.$_POST['username'].'"', 'return_type'=>'single'));
		if(!empty($get_username)){
			echo "10";
			exit();
		}


		//checks if the profile picture has been uploaded
		if(!empty($_FILES['file']['name'])){
			//upload directory
	        $fileDir  = "../uploads/profiles/";

	        //allowed file types to upload
	        $fileTypes = array('.jpeg','.jpg','.png', '.gif'); 

	        //file names
	        $fileName  = "";

	        $file = $_FILES['file']['name'];
	        $file_ext= substr($file, strripos($file, '.')); // get file name
	        $file_basename = substr($file, 0, strripos($file, '.')); // get file extention
	        $fileName = $_POST['first_name']."_".time(). $file_ext;//renames the file

	        //checks if the file type is valid
	        if (!in_array(strtolower($file_ext),$fileTypes)) {
	            echo "8";
	            exit();
	        }

	        //if everything is in order upload the picture
	        $file_temp =$_FILES['file']['tmp_name'];

	        if(move_uploaded_file($file_temp, $fileDir.$fileName)){
	        	$profile_picture = $fileName;
	        }
		}

		$data = array(
					'first_name'	=> $con->clean($_POST['first_name']),
					'last_name'	=> $con->clean($_POST['last_name']),
					'phone_number'	=> $con->clean($_POST['phone']),
					'email_address'	=> $con->clean($_POST['email']),
					'location'	=> $con->clean($_POST['location']),
					'de_id'	=> $id,
					'sponsored_by' => $con->clean($_POST['sponsor']),
					'graduation_date' => $con->clean($_POST['year']),
					'profile_pic'	  => $profile_picture	
				);
		$save = $con->insert('des', $data);
		if(!empty($save)){
			echo "3";
			$login_data = array(
								'member_id' => $id,
								'username'  => $con->clean($_POST['username']),
								'password'  => sha1($con->clean($_POST['password'])),
								'user_role' => 4,
								'member_of' => 999
							);
			$con->insert('system_users', $login_data);
		}else{
			echo "4";
		}
	}

	//update de's details
	if(isset($_POST['update_de'])){
		$profile_picture = $_POST['pic'];
		//checks if the profile picture has been uploaded
		if(!empty($_FILES['file']['name'])){
			//upload directory
	        $fileDir  = "../uploads/profiles/";

	        //allowed file types to upload
	        $fileTypes = array('.jpeg','.jpg','.png', '.gif'); 

	        //file names
	        $fileName  = "";

	        $file = $_FILES['file']['name'];
	        $file_ext= substr($file, strripos($file, '.')); // get file name
	        $file_basename = substr($file, 0, strripos($file, '.')); // get file extention
	        $fileName = $_POST['first_name']."_".time(). $file_ext;//renames the file

	        //checks if the file type is valid
	        if (!in_array(strtolower($file_ext),$fileTypes)) {
	            echo "8";
	            exit();
	        }

	        //if everything is in order upload the picture
	        $file_temp =$_FILES['file']['tmp_name'];

	        if(move_uploaded_file($file_temp, $fileDir.$fileName)){
	        	$profile_picture = $fileName;
	        }
		}


		$data = array(
					'first_name'	=> $con->clean($_POST['first_name']),
					'last_name'	=> $con->clean($_POST['last_name']),
					'phone_number'	=> $con->clean($_POST['phone']),
					'email_address'	=> $con->clean($_POST['email']),
					'location'	=> $con->clean($_POST['location']),
					'sponsored_by' => $con->clean($_POST['sponsor']),
					'graduation_date' => $con->clean($_POST['year']),
					'profile_pic'	  => $profile_picture	
				);
		$update = $con->update('des', $data, array('de_id'=>$_POST['id']));
		if($update){
			echo "6";
		}else{
			echo "7";
		}
	}

	//update_updates
	if(isset($_POST['update_updates'])){
		$data = array(
					'current_job' => $con->clean($_POST['to_do']),
					'project' => $con->clean($_POST['project'])
				);
		$update = $con->update('des', $data, array('de_id'=>$_POST['id']));
		if($update){
			echo "6";
		}else{
			echo "7";
		}
	}

	//delete DE
	if($action == 'delete_de'){
		$id = $con->clean($_GET['id']);
		$delete = $con->delete('des', array('de_id'=>$id));
		if(!empty($delete)){
			echo "1";
		}else{
			echo "2";
		}
	}

	//add sacco member
	if(isset($_POST['save_member'])){
		$id = $con->get_random_string_max(60);

		$data = array(
				'sacco_member_id' => $id,
				'first_name'	   => $con->clean($_POST['first_name']),
				'last_name'		   => $con->clean($_POST['last_name']),
				'email_address'	   => $con->clean($_POST['email']),
				'phone_number'	   => $con->clean($_POST['phone']),
				'position_id'	   => $con->clean($_POST['position']),
				'department_id'	   => $con->clean($_POST['department']),
				'sacco_id' 		   => $_SESSION['USR_OF']
			);
		$save_staff = $con->insert('sacco_members', $data);
		if(!empty($save_staff)){
			$login_data = array(
								'member_id' => $id,
								'username'  => $con->clean($_POST['username']),
								'password'  => sha1($con->clean($_POST['password'])),
								'user_role' => 3,
								'member_of' => $_SESSION['USR_OF']
							);
			$con->insert('system_users', $login_data);
			echo "1";
		}else{
			echo "2";
		}
	}

	//update sacco member
	if(isset($_POST['update_sacco_member'])){
		$id = $con->get_random_string_max(60);

		$data = array(
				'first_name'	   => $con->clean($_POST['first_name']),
				'last_name'		   => $con->clean($_POST['last_name']),
				'email_address'	   => $con->clean($_POST['email']),
				'phone_number'	   => $con->clean($_POST['phone']),
				'position_id'	   => $con->clean($_POST['position']),
				'department_id'	   => $con->clean($_POST['department'])
			);
		$update = $con->update('sacco_members', $data, array('sacco_member_id'=>$_SESSION['USR_ID']));
		if(!empty($update)){
			echo "4";
		}else{
			echo "5";
		}
	}

	//update staff by the admin
	if(isset($_POST['update_staff'])){
		$profile_picture = '';
		if(!empty($_POST['current_image'])){
			$profile_picture = $_POST['current_image'];
		}
		//checks if the profile picture has been uploaded
		if(!empty($_FILES['file']['name'])){
			//upload directory
	        $fileDir  = "../uploads/profiles/";

	        //allowed file types to upload
	        $fileTypes = array('.jpeg','.jpg','.png', '.gif'); 

	        //file names
	        $fileName  = "";

	        $file = $_FILES['file']['name'];
	        $file_ext= substr($file, strripos($file, '.')); // get file name
	        $file_basename = substr($file, 0, strripos($file, '.')); // get file extention
	        $fileName = $_POST['first_name']."_".time(). $file_ext;//renames the file

	        //checks if the file type is valid
	        if (!in_array(strtolower($file_ext),$fileTypes)) {
	            echo "8";
	            exit();
	        }

	        //if everything is in order upload the picture
	        $file_temp =$_FILES['file']['tmp_name'];

	        if(move_uploaded_file($file_temp, $fileDir.$fileName)){
	        	$profile_picture = $fileName;
	        }
		}

		$data = array(
				'employee_id'	   => $con->clean($_POST['emp_number']),
				'first_name'	   => $con->clean($_POST['first_name']),
				'last_name'		   => $con->clean($_POST['last_name']),
				'email_address'	   => $con->clean($_POST['email']),
				'phone_number'	   => $con->clean($_POST['phone']),
				'position_id'	   => $con->clean($_POST['position']),
				'department_id'	   => $con->clean($_POST['department']),
				'dob'			   => $con->clean($_POST['dob']),
				'join_date'		   => $con->clean($_POST['dos']),
				'band_id'		   => $con->clean($_POST['band']),
				'branch'		   => $con->clean($_POST['branch']),
				'thumb'			   => $profile_picture
			);
		$save_staff = $con->update('muscco_members', $data, array('muscco_member_id'=>$con->clean($_POST['id'])));
		if(!empty($save_staff)){
			echo "1";
		}else{
			echo "9";
		}
	}

	//update staff by the admin
	if(isset($_POST['update_user_details'])){

		$data = array(
				'first_name'	   => $con->clean($_POST['first_name']),
				'last_name'		   => $con->clean($_POST['last_name']),
				'email_address'	   => $con->clean($_POST['email']),
				'phone_number'	   => $con->clean($_POST['phone']),
				'dob'			   => $con->clean($_POST['dob']),
			);
		$save_staff = $con->update('muscco_members', $data, array('muscco_member_id'=>$con->clean($_POST['id'])));
		if(!empty($save_staff)){
			echo "1";
		}else{
			echo "9";
		}
	}

	//update profile picture
	if(isset($_POST['update_profile_picture'])){
		$id = $con->clean($_POST['id']);

		//upload directory
        $fileDir  = "../uploads/profiles/";

        //allowed file types to upload
        $fileTypes = array('.jpeg','.jpg','.png', '.gif'); 

        //file names
        $fileName  = "";


        $file = $_FILES['file']['name'];
        $file_ext= substr($file, strripos($file, '.')); // get file name
        $file_basename = substr($file, 0, strripos($file, '.')); // get file extention
        $fileName = $_SESSION['USR_NME']."_".time(). $file_ext;//renames the file

        //checks if the file type is valid
        if (!in_array(strtolower($file_ext),$fileTypes)) {
            echo "3";
            exit();
        }

        //if everything is in order upload the picture
        $file_temp =$_FILES['file']['tmp_name'];

        if(move_uploaded_file($file_temp, $fileDir.$fileName)){
        	$update = $con->update('muscco_members', array('thumb'=>$fileName), array('muscco_member_id'=>$id));
        	if(!empty($update)){
        		echo "1";
        	}else{
        		echo "2";
        	}
        }else{
        	echo "2";
        }
	}

	//remove staff
	if($action == 'remove_staff'){
		$id = $con->clean($_GET['id']);
		$remove = $con->delete('muscco_members', array('muscco_member_id'=>$id));
		if(!empty($remove)){
			//removes the login details
			$con->delete('system_users', array('member_id'=>$id));
			echo "1";
		}else{
			echo "2";
		}
	}

	//register sacco
	if(isset($_POST['save_sacco'])){
		$password = $con->clean($_POST['password']);
		$uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number    = preg_match('@[0-9]@', $password);
		$specialChars = preg_match('@[^\w]@', $password);

		$logo = '';

		//checks if the profile picture has been uploaded
		if(!empty($_FILES['file']['name'])){
			//upload directory
	        $fileDir  = "../uploads/logos/";

	        //allowed file types to upload
	        $fileTypes = array('.jpeg','.jpg','.png', '.gif'); 

	        //file names
	        $fileName  = "";

	        $file = $_FILES['file']['name'];
	        $file_ext= substr($file, strripos($file, '.')); // get file name
	        $file_basename = substr($file, 0, strripos($file, '.')); // get file extention
	        $fileName = $_POST['first_name']."_".time(). $file_ext;//renames the file

	        //checks if the file type is valid
	        if (!in_array(strtolower($file_ext),$fileTypes)) {
	            echo "4";
	            exit();
	        }

	        //if everything is in order upload the picture
	        $file_temp =$_FILES['file']['tmp_name'];

	        if(move_uploaded_file($file_temp, $fileDir.$fileName)){
	        	$logo = $fileName;
	        }
		}

		if(!$uppercase || !$lowercase || !$number || strlen($password) < 8 || !$specialChars) {
		  // tell the user something went wrong
			echo "3";
			exit();
		}

		//checks if the username is already in use
		$get_username = $con->getRows('system_users', 
							array('where'=>'username="'.$_POST['username'].'"', 'return_type'=>'single'));
		if(!empty($get_username)){
			echo "5";
			exit();
		}

		//sacco details
		$data = array(
					'sacco_name'		=> $con->clean($_POST['name']),
					'registered_date'	=> $con->clean($_POST['date']),
					'location'			=> $con->clean($_POST['location']),
					'phone_number'		=> $con->clean($_POST['phone_number']),
					'email_address'		=> $con->clean($_POST['email_address']),
					'physical_address'	=> $con->clean($_POST['address']),
					'sacco_president'	=> $con->clean($_POST['president']),
					'assets'			=> $con->clean($_POST['assets']),
					'shares'			=> $con->clean($_POST['shares']),
					'deposits'			=> $con->clean($_POST['deposits']),
					'profits'			=> $con->clean($_POST['profits']),
					'loans'				=> $con->clean($_POST['loans']),
					'male_membership'	=> $con->clean($_POST['male']),
					'female_membership'	=> $con->clean($_POST['famale']),
					'youth_membership'	=> $con->clean($_POST['youth']),
					'other_membership'	=> $con->clean($_POST['other_members']),
					'logo'				=> $logo
				);
		$add_sacco = $con->insert('sacco', $data);
		if(!empty($add_sacco)){
			//add admin details
			$id = $con->get_random_string_max(60);
			$admin = array(
						'sacco_member_id'=> $id,
						'first_name'	=> $con->clean($_POST['first_name']),
						'last_name'		=> $con->clean($_POST['last_name']),
						'email_address'	=> $con->clean($_POST['email']),
						'phone_number'	=> $con->clean($_POST['phone']),
						'sacco_id'		=> $add_sacco
					);
			//save admin
			$add_admin = $con->insert('sacco_members', $admin);
			if(!empty($add_admin)){
				$login_data = array(
								'member_id' => $id,
								'username'  => $con->clean($_POST['username']),
								'password'  => sha1($con->clean($_POST['password'])),
								'user_role' => 1,
								'member_of' => $add_sacco
							);
				$con->insert('system_users', $login_data);
				echo"1";
			}else{
				echo"2";
			}

		}else{
			echo "2";
		}
	}

	//remove sacco
	if($action == 'remove_sacco'){
		//remove sacco details		
		$remove_sacco = $con->delete('sacco', array('sacco_id'=>$con->clean($_GET['id'])));
		if(!empty($remove_sacco)){
			//remove users associated with this sacco
			$con->delete('sacco_members', array('sacco_id'=>$con->clean($_GET['id'])));
			echo "1";
		}else{
			echo "2";
		}
	}

	//updates different sections of sacco
	//updates sacco info
	if(isset($_POST['update_sacco'])){
		$data = array(
					'sacco_name'		=> $con->clean($_POST['name']),
					'registered_date'	=> $con->clean($_POST['date']),
					'location'			=> $con->clean($_POST['location']),
					'phone_number'		=> $con->clean($_POST['phone_number']),
					'email_address'		=> $con->clean($_POST['email_address']),
					'physical_address'	=> $con->clean($_POST['address']),
					'sacco_president'	=> $con->clean($_POST['president'])					
				);
		$update_sacco = $con->update('sacco', $data, array('sacco_id'=>$con->clean($_POST['sacco_id'])));
		if(!empty($update_sacco)){
			echo "1";
		}else{
			echo "2";
		}
	}

	//update assets
	if(isset($_POST['update_assets'])){
		$data = array(
					'assets'			=> $con->clean($_POST['assets']),
					'shares'			=> $con->clean($_POST['shares']),
					'deposits'			=> $con->clean($_POST['deposits']),
					'loans'				=> $con->clean($_POST['loans']),
					'profits'			=> $con->clean($_POST['profits']),
					);
		$update_sacco = $con->update('sacco', $data, array('sacco_id'=>$con->clean($_POST['sacco_id'])));
		if(!empty($update_sacco)){
			echo "1";
		}else{
			echo "2";
		}
	}
	//update membership
	if(isset($_POST['update_membership'])){
		$data = array(
					'male_membership'	=> $con->clean($_POST['male']),
					'female_membership'	=> $con->clean($_POST['famale']),
					'youth_membership'	=> $con->clean($_POST['youth']),
					'other_membership'	=> $con->clean($_POST['other_members'])
					);
		$update_sacco = $con->update('sacco', $data, array('sacco_id'=>$con->clean($_POST['sacco_id'])));
		if(!empty($update_sacco)){
			echo "1";
		}else{
			echo "2";
		}
	}


	//setup password
	if(isset($_POST['set_password'])){
		$password = $con->clean($_POST['password']);
		$uppercase = preg_match('@[A-Z]@', $password);
		$lowercase = preg_match('@[a-z]@', $password);
		$number    = preg_match('@[0-9]@', $password);
		$specialChars = preg_match('@[^\w]@', $password);

		if(!$uppercase || !$lowercase || !$number || strlen($password) < 8 || !$specialChars) {
		  // tell the user something went wrong
			echo "11";
			exit();
		}

		$set_password = $con->update('system_users', 
									array('password'=>sha1($password), 'account_status'=>1), 
									array('member_id'=>$_SESSION['USR_ID'])
								);
		if(!empty($set_password)){
			$_SESSION['USR_SESS'] = "VAL";
			$con->userRedirect($_SESSION['USR_TYP']);
		}else{
			echo "10";
		}
	}

	/************company settings/configurations*****/
	//sacco settings 
	//departments, positions etc
	//add department
	if(isset($_POST['add_department'])){
		$add_department = $con->insert('departments', 
									    array('department'=>$con->clean($_POST['department']), 'member_of'=>$_SESSION['USR_OF'])
									);
		if(!empty($add_department)){
			echo"1";
		}else{
			echo "2";
		}
	}

	//update department
	if(isset($_POST['update_department'])){
		$update_department = $con->update('departments', 
									    array('department'=>$con->clean($_POST['department'])),
									    array('department_id'=> $con->clean($_POST['id']) )
									);
		if(!empty($update_department)){
			echo"3";
		}else{
			echo "4";
		}
	}

	//delete department
	if($action == 'delete_department'){
		$delete_department = $con->delete('departments', 
									    array('department_id'=> $con->clean($_GET['id']) )
									);
		if(!empty($delete_department)){
			echo"1";
		}else{
			echo "2";
		}
	}
	
	//add position
	if(isset($_POST['add_position'])){
		$add = $con->insert('positions', array('position'=>$con->clean($_POST['position']), 'member_of'=>$_SESSION['USR_OF']));
		if(!empty($add)){
			echo "1";
		}else{
			echo "2";
		}
	}

	//delete position
	if($action == 'delete_position'){
		$delete = $con->delete('positions', array('position_id'=>$con->clean($_GET['id'])));
		if(!empty($delete)){
			echo "1";
		}else{
			echo "2";
		}
	}

	//add branches
	if(isset($_POST['add_branch'])){
		$add = $con->insert('branches', array('branch_name'=>$con->clean($_POST['branch'])));
		if(!empty($add)){
			echo "1";
		}else{
			echo "2";
		}
	}

	//delete branch
	if($action == 'delete_branch'){
		$delete = $con->delete('branches', array('branch_id'=>$con->clean($_GET['id'])));
		if(!empty($delete)){
			echo "1";
		}else{
			echo "2";
		}
	}

	/*****************Invoices****************************/

		//invoices 
		//add invoice
		if(isset($_POST['add_invoice'])){
			//checks if the invoice file is attached
	        if(empty($_FILES['invoice']['name'])){
	            echo "5";
	            exit();
	        }

	        //upload directory
	        $fileDir  = "../uploads/invoices/";

	        //allowed file types to upload
	        $fileTypes = array('.pdf','.docx','.doc','.jpeg','.jpg','.png'); 

	        //file names
	        $fileName  = "";

	        $file = $_FILES['invoice']['name'];
	        $file_ext= substr($file, strripos($file, '.')); // get file name
	        $file_basename = substr($file, 0, strripos($file, '.')); // get file extention
	        $fileName = "muscco_invoice_".$_POST['invoice_number']. $file_ext;//renames the file

	        //checks if the file type is valid
	        if (!in_array(strtolower($file_ext),$fileTypes)) {
	            echo "4";
	            exit();
	        }

	        //if everything is in order upload the invoice
	        $file_temp =$_FILES['invoice']['tmp_name'];

	        if(move_uploaded_file($file_temp, $fileDir.$fileName)){
	        	//add invoice information in the database
	        	$data = array(
						'invoice_number'	=> $con->clean($_POST['invoice_number']),
						'sacco_id'			=> $con->clean($_POST['sacco']),
						'description'		=> $con->clean($_POST['description']),
						'amount'			=> $con->clean($_POST['amount']),
						'amount_paid'		=> $con->clean($_POST['amount_paid']),
						'invoice_file'		=> $fileName,
						'posted_by'			=> $_SESSION['USR_ID'],
						'due_date'			=> $con->clean($_POST['due_date']),
						'date_posted'		=> date('Y-m-d')
					);
	        	$add_invoice = $con->insert('invoices', $data);
	        	if(!empty($add_invoice)){
	        		//send
	        		echo "1";
	        		//compose notifications to send to sacco informing them of the new invoice posted        		
	        		//gets the receiver of the notification
	        		$receiver = $con->getRows('sacco_members a, permissions_granted b', array('where'=>'a.sacco_member_id=b.member_id and b.permission_id=3'));
	        		if(!empty($receiver)){
	        			foreach($receiver as $row){
	        				$subject = "New invoice (#".$_POST['invoice_number'].") has been posted";
		        			$message = "Hey ".ucwords($row['first_name']).", a new invoice (#".$_POST['invoice_number'].") with description '".$_POST['description']."' from Muscco has been posted in the portal. Please signin and  check.";
		        			$to = $row['member_id'];
		        			$con->sendNotification($to,$_SESSION['USR_ID'],$subject,$message);
		        			$con->sendMail($row['email_address'],$message, $subject);
	        			}       			

	        		}
	        		
	        	}else{
	        		echo "2";
	        	}
	        }else{
	        	echo "3";
	        }		
		}

		//update invoice status
		if(isset($_POST['update_invoice_status'])){
			//file name
		    $fileName  = "";
			//checks if the file  is attached
	        if(!empty($_FILES['file']['name'])){
	            //upload directory
		        $fileDir  = "../uploads/invoices/";

		        //allowed file types to upload
		        $fileTypes = array('.pdf','.docx','.doc','.jpeg','.jpg','.png'); 	        

		        $file = $_FILES['file']['name'];
		        $file_ext= substr($file, strripos($file, '.')); // get file name
		        $file_basename = substr($file, 0, strripos($file, '.')); // get file extention
		        $fileName = "attachment_".$_POST['invoice_number']. $file_ext;//renames the file

		        //checks if the file type is valid
		        if (!in_array(strtolower($file_ext),$fileTypes)) {
		            echo "3";
		            exit();
		        }

		        //if everything is in order upload the invoice
		        $file_temp =$_FILES['file']['tmp_name'];
		        //upload the attached document
		        if(move_uploaded_file($file_temp, $fileDir.$fileName)){

		        }else{
		        	echo "4";
		        }

	        }

	        //if everything is okay, proceed to add data
	        $data = array(
	        				'invoice_id'	=> $con->clean($_POST['invoice_id']),
	        				'comment'		=> $con->clean($_POST['comment']),
	        				'attachment'	=> $fileName,
	        				'updated_by'	=> $_SESSION['USR_ID'],
	        				'paid_amount'	=> $con->clean($_POST['amount'])
	        			);
	        $add_status = $con->insert('invoice_status', $data);
	        if(!empty($add_status)){
	        	//update the status of the invoice in the invoices table
	        	$con->update('invoices', array('invoice_status'=>$con->clean($_POST['status'])), array('invoice_id'=>$con->clean($_POST['invoice_id'])));
	        	echo "3";
	        }else{
	        	echo "2";
	        }
		}

		//update invoice details
		if(isset($_POST['update_invoice'])){
			//set the invoice file name to default i.e the current file 
		    $fileName  = $con->clean($_POST['invoice_attachment']);
			//checks if the invoice file update  is attached
	        if(!empty($_FILES['invoice_file']['name'])){
	            //upload directory
		        $fileDir  = "../uploads/invoices/";

		        //allowed file types to upload
		        $fileTypes = array('.pdf','.docx','.doc','.jpeg','.jpg'); 	        

		        $file = $_FILES['invoice_file']['name'];
		        $file_ext= substr($file, strripos($file, '.')); // get file name
		        $file_basename = substr($file, 0, strripos($file, '.')); // get file extention
		        $fileName = rand()."_muscco_invoice_".$_POST['invoice_number']. $file_ext;//renames the file

		        //checks if the file type is valid
		        if (!in_array(strtolower($file_ext),$fileTypes)) {
		            echo "4";
		            exit();
		        }

		        //if everything is in order upload the invoice
		        $file_temp =$_FILES['invoice_file']['tmp_name'];
		        //upload the attached document
		        if(move_uploaded_file($file_temp, $fileDir.$fileName)){

		        }else{
		        	echo "3";
		        }

	        }

	        //if everything is okay, proceed to add data
	        $data = array(
						'invoice_number'	=> $con->clean($_POST['invoice_number']),
						'sacco_id'			=> $con->clean($_POST['sacco']),
						'description'		=> $con->clean($_POST['description']),
						'amount'			=> $con->clean($_POST['amount']),
						'amount_paid'		=> $con->clean($_POST['amount_paid']),
						'invoice_file'		=> $fileName,
						'due_date'			=> $con->clean($_POST['due_date'])
					);
	        $update_invoice = $con->update('invoices', $data, array('invoice_id'=>$con->clean($_POST['invoice_id'])));
	        if(!empty($update_invoice)){
	        	//sends a notification that the invoice has been updated
	        	echo "6";
	        }else{
	        	echo "2";
	        }
		}

	/*********************************************************/

	/***************Sacco Loan Application****************/
		if(isset($_POST['apply_loan'])){
			//checks if the loan application form is attached
	        if(empty($_FILES['file']['name'])){
	            echo "5";
	            exit();
	        }

	        //upload directory
	        $fileDir  = "../uploads/loans/";

	        //allowed file types to upload
	        $fileTypes = array('.pdf','.docx','.doc','.jpeg','.jpg','.png'); 

	        //file names
	        $fileName  = "";

	        $file = $_FILES['file']['name'];
	        $file_ext= substr($file, strripos($file, '.')); // get file name
	        $file_basename = substr($file, 0, strripos($file, '.')); // get file extention
	        $fileName = $_SESSION['USR_OF'].'_'.time(). $file_ext;//renames the file

	        //checks if the file type is valid
	        if (!in_array(strtolower($file_ext), $fileTypes)) {
	            echo "4";
	            exit();
	        }

	        //if everything is in order upload the file
	        $file_temp =$_FILES['file']['tmp_name'];

	        if(move_uploaded_file($file_temp, $fileDir.$fileName)){
	        	//add file information in the database
	        	$data = array(
						'sacco_id'			=> $_SESSION['USR_OF'],
						'purpose'			=> $con->clean($_POST['description']),
						'amount'			=> $con->clean($_POST['amount']),
						'application_form'	=> $fileName,
						'posted_by'			=> $_SESSION['USR_ID']
					);
	        	$add_file = $con->insert('loans', $data);
	        	if(!empty($add_file)){
	        		//send
	        		echo "9";
	        		//compose notifications to send to muscco informing them of the new loan application posted        		
	        		//gets the receiver of the notification
	        		$receiver = $con->getRows('muscco_members a, permissions_granted b', array('where'=>'a.muscco_member_id=b.member_id and b.permission_id=9'));

	        		//gets sender's sacco name
	        		$sacco = $con->getRows('sacco', array('where'=>'sacco_id="'.$_SESSION['USR_OF'].'"', 'return_type'=>'single'));
	        		if(!empty($receiver)){
	        			foreach($receiver as $row){
	        				$subject = "New loan application (#".$add_file.") has been posted";
		        			$message = "Hey ".ucwords($row['first_name']).", a new loan application (#".$add_file.") with description '".$_POST['description']."' from ".$sacco['sacco_name']." has been posted. Please check.";
		        			$to = $row['member_id'];
		        			$con->sendNotification($to,$_SESSION['USR_ID'],$subject,$message);
		        			$con->sendMail($row['email_address'],$message, $subject);
	        			}       			

	        		}
	        		
	        	}else{
	        		echo "10";
	        	}
	        }else{
	        	echo "10";
	        }		
		}

		//update loan
		if(isset($_POST['update_loan'])){
			//set the invoice file name to default i.e the current file 
		    $fileName  = $con->clean($_POST['loan_attachment']);
			//checks if the invoice file update  is attached
	        if(!empty($_FILES['file']['name'])){
	            //upload directory
		        $fileDir  = "../uploads/loans/";

		        //allowed file types to upload
		        $fileTypes = array('.pdf','.docx','.doc','.jpeg','.jpg'); 	        

		        $file = $_FILES['file']['name'];
		        $file_ext= substr($file, strripos($file, '.')); // get file name
		        $file_basename = substr($file, 0, strripos($file, '.')); // get file extention
		        $fileName = $_SESSION['USR_OF'].'_'.time(). $file_ext;//renames the file

		        //checks if the file type is valid
		        if (!in_array(strtolower($file_ext),$fileTypes)) {
		            echo "4";
		            exit();
		        }

		        //if everything is in order upload the invoice
		        $file_temp =$_FILES['file']['tmp_name'];
		        //upload the attached document
		        if(move_uploaded_file($file_temp, $fileDir.$fileName)){

		        }else{
		        	echo "3";
		        }

	        }

	        //if everything is okay, proceed to add data
	        $data = array(
						'sacco_id'			=> $_SESSION['USR_OF'],
						'purpose'			=> $con->clean($_POST['description']),
						'amount'			=> $con->clean($_POST['amount']),
						'application_form'	=> $fileName,
					);
	        $update = $con->update('loans', $data, array('loan_id'=>$con->clean($_POST['loan_id'])));
	        if(!empty($update)){
	        	//sends a notification that the invoice has been updated
	        	echo "6";
	        }else{
	        	echo "2";
	        }
		}

		//update loan status by muscco
		if(isset($_POST['change_loan_status'])){
			//set the invoice file name to default i.e the current file 
		    $fileName  = '';
			//checks if the invoice file update  is attached
	        if(!empty($_FILES['file']['name'])){
	            //upload directory
		        $fileDir  = "../uploads/loans/";

		        //allowed file types to upload
		        $fileTypes = array('.pdf','.docx','.doc','.jpeg','.jpg'); 	        

		        $file = $_FILES['file']['name'];
		        $file_ext= substr($file, strripos($file, '.')); // get file name
		        $file_basename = substr($file, 0, strripos($file, '.')); // get file extention
		        $fileName = 'MUSCCO_'.time(). $file_ext;//renames the file

		        //checks if the file type is valid
		        if (!in_array(strtolower($file_ext),$fileTypes)) {
		            echo "4";
		            exit();
		        }

		        //if everything is in order upload the invoice
		        $file_temp =$_FILES['file']['tmp_name'];
		        //upload the attached document
		        if(move_uploaded_file($file_temp, $fileDir.$fileName)){

		        }else{
		        	echo "3";
		        }

	        }


	        //if everything is okay, proceed to add data
	        $data = array(
						'loan_status'		=> $con->clean($_POST['status']),
						'loan_remarks'		=> $con->clean($_POST['comment']),
						'date_updated'		=> date('Y-m-d'),
						'updated_by'		=> $_SESSION['USR_ID'],
						'muscco_form'		=> $fileName
					);
	        $update = $con->update('loans', $data, array('loan_id'=>$con->clean($_POST['loan_id'])));
	        if(!empty($update)){
	        	//sends a notification that the invoice has been updated
	        	echo "9";
	        	//send a notification to the one who sent the application
	        	$action = '';
	        	$sacco = $con->getRows('sacco_members', array('where'=>'sacco_member_id="'.$_POST['posted_by'].'"','return_type'=>'single'));
	        	if($_POST['status'] == 1){$action="Approved";}else{$action="Declined";}
				$subject = "Your loan application(#".$_POST['loan_id'].") has been ".$action;
		        $message = "Greetings, your loan application(#".$_POST['loan_id'].") that you submitted to MUSCCO has been ".$action.", for more details check the status of the loan application.";
		        $to = $_POST['posted_by'];
		        $con->sendNotification($to,$_SESSION['USR_ID'],$subject,$message);
		        $con->sendMail($sacco['email_address'],$message, $subject);
	        }else{
	        	echo "10";
	        }
		}
	/***************end Sacco Loan Application************/

	//documents upload section
	//add document
	if(isset($_POST['add_document'])){
		//checks if the file is attached
        if(empty($_FILES['file']['name'])){
            echo "5";
            exit();
        }

        //upload directory
        $fileDir  = "../uploads/docs/";

        //allowed file types to upload
        $fileTypes = array('.pdf','.docx','.doc'); 

        //file names
        $fileName  = "";

        $file = $_FILES['file']['name'];
        $file_ext= substr($file, strripos($file, '.')); // get file name
        $file_basename = substr($file, 0, strripos($file, '.')); // get file extention
        $fileName = rand()."_".time(). $file_ext;//renames the file

        //checks if the file type is valid
        if (!in_array(strtolower($file_ext),$fileTypes)) {
            echo "4";
            exit();
        }

        //if everything is in order upload the invoice
        $file_temp =$_FILES['file']['tmp_name'];

        if(move_uploaded_file($file_temp, $fileDir.$fileName)){
        	//add invoice information in the database
        	$data = array(
					'title'					=> $con->clean($_POST['title']),
					'category_id'			=> $con->clean($_POST['category']),
					'access_rights'			=> $con->clean($_POST['access_rights']),
					'document_file'			=> $fileName,
					'posted_by'				=> $_SESSION['USR_ID'],
				);
        	$add_document = $con->insert('documents', $data);
        	if(!empty($add_document)){
        		//send
        		echo "1";
        	}else{
        		echo "2";
        	}
        }else{
        	echo "3";
        }
	}

	//delete document
	if($action == "delete_document"){
		//print_r($_GET);
		//delete document information in the table
		$delete_document = $con->delete('documents', array('document_id'=>$con->clean($_GET['id'])));
		if(!empty($delete_document)){
			echo "1";
			//remove the old file
	        if(file_exists("../uploads/docs/".$_GET['doc'])){
	        	//echo "true";
	            unlink("../uploads/docs/".$_GET['doc']);
	        }
		}else{
			echo"2";
		}
	}
	//delete document category
	if($action == "delete_category"){
		$delete = $con->delete('document_categories', array('category_id'=>$_GET['id']));
		if(!empty($delete)){
			echo "1";
		}else{
			echo "2";
		}
	}
	//add document category
	if(isset($_POST['add_docu_category'])){
		$add_category = $con->insert('document_categories', array('category'=>$con->clean($_POST['category_name'])));
		if(!empty($add_category)){
			echo "7";
		}else{
			echo "8";
		}
	} 
	//delete document category
	//edit document category

	//events management
	//add event
	if(isset($_POST['add_event'])){
		//checks if the dates are valid i.e not dates in the past of the start date can not be higher than the end date
		if($_POST['date_from'] < date('Y-m-d')){
			echo "5";
			exit();
		}
		if($_POST['date_from'] > $_POST['date_to']){
			echo "6";
			exit();
		}
		//set the file name to default i.e empty 
	    $fileName  = '';
		//checks if the file  is attached
        if(!empty($_FILES['file']['name'])){
            //upload directory
	        $fileDir  = "../uploads/event/";

	        //allowed file types to upload
	        $fileTypes = array('.pdf','.docx','.doc','.jpeg','.jpg','.png'); 	        

	        $file = $_FILES['file']['name'];
	        $file_ext= substr($file, strripos($file, '.')); // get file name
	        $file_basename = substr($file, 0, strripos($file, '.')); // get file extention
	        $fileName = rand()."_muscco_event". $file_ext;//renames the file

	        //checks if the file type is valid
	        if (!in_array(strtolower($file_ext),$fileTypes)) {
	            echo "4";
	            exit();
	        }

	        //if everything is in order upload the invoice
	        $file_temp =$_FILES['file']['tmp_name'];
	        //upload the attached document
	        if(move_uploaded_file($file_temp, $fileDir.$fileName)){

	        }else{
	        	echo "3";
	        }
        }
        //if the attachement is present and has been uploaded successfully, event details will be added
        $data = array(
        			'event_title'		=> $con->clean($_POST['title']),
        			'event_description'	=> $con->clean($_POST['description']),
        			'venue'				=> $con->clean($_POST['venue']),
        			'date_from'			=> $con->clean($_POST['date_from']),
        			'date_to'			=> $con->clean($_POST['date_to']),
        			'time_from'			=> $con->clean($_POST['time_from']),
        			'time_to'			=> $con->clean($_POST['time_to']),
        			'event_attachment'	=> $fileName,
        			'posted_by'			=> $_SESSION['USR_ID'],
        			'event_permision'	=> $con->clean($_POST['access_rights'])
        	);
        $add_event = $con->insert('events', $data);
        if(!empty($add_event)){
        	echo "1";
        }else{
        	echo "2";
        }
	}

	if(isset($_POST['update_event'])){
		//checks if the dates are valid i.e not dates in the past of the start date can not be higher than the end date
		if($_POST['date_from'] < date('Y-m-d')){
			echo "5";
			exit();
		}
		if($_POST['date_from'] > $_POST['date_to']){
			echo "6";
			exit();
		}
		//set the file name to default i.e empty 
	    $fileName  = $con->clean($_POST['attachment']);
	    $event_id  = $con->clean($_POST['event_id']);
		//checks if the file  is attached
        if(!empty($_FILES['file']['name'])){
            //upload directory
	        $fileDir  = "../uploads/event/";

	        //allowed file types to upload
	        $fileTypes = array('.pdf','.docx','.doc','.jpeg','.jpg','.png'); 	        

	        $file = $_FILES['file']['name'];
	        $file_ext= substr($file, strripos($file, '.')); // get file name
	        $file_basename = substr($file, 0, strripos($file, '.')); // get file extention
	        $fileName = rand()."_muscco_event". $file_ext;//renames the file

	        //checks if the file type is valid
	        if (!in_array(strtolower($file_ext),$fileTypes)) {
	            echo "4";
	            exit();
	        }

	        //if everything is in order upload the invoice
	        $file_temp =$_FILES['file']['tmp_name'];
	        //upload the attached document
	        if(move_uploaded_file($file_temp, $fileDir.$fileName)){

	        }else{
	        	echo "3";
	        }
        }
        //if the attachement is present and has been uploaded successfully, event details will be added
        $data = array(
        			'event_title'		=> $con->clean($_POST['title']),
        			'event_description'	=> $con->clean($_POST['description']),
        			'venue'				=> $con->clean($_POST['venue']),
        			'date_from'			=> $con->clean($_POST['date_from']),
        			'date_to'			=> $con->clean($_POST['date_to']),
        			'time_from'			=> $con->clean($_POST['time_from']),
        			'time_to'			=> $con->clean($_POST['time_to']),
        			'event_attachment'	=> $fileName,
        			'event_permision'	=> $con->clean($_POST['access_rights'])
        	);
        $add_event = $con->update('events', $data, array('event_id'=>$event_id));
        if(!empty($add_event)){
        	echo "1";
        }else{
        	echo "2";
        }
	}

	//delete event
	if($action == 'delete_event'){
		$delete = $con->delete('events', array('event_id'=>$_GET['id']));
		if(!empty($delete)){
			echo "1";
			//remove the old file
	        if(file_exists("../../uploads/events/".$_GET['file'])){
	            unlink("../../uploads/events/".$_GET['file']);
	        }
		}else{
			echo "2";
		}
	}

	//cancel event
	if($action == 'cancel_event'){
		$cancel = $con->update('events', array('event_status'=>2), array('event_id'=>$_GET['id']));
		if(!empty($cancel)){
			echo "1";
		}else{
			echo "2";
		}
	}

	//complete event
	if($action == 'complete_event'){
		$complete = $con->update('events', array('event_status'=>1), array('event_id'=>$_GET['id']));
		if(!empty($complete)){
			echo "1";
		}else{
			echo "2";
		}
	}

	/******************manage faqs******************/
	//add faqs
	if(isset($_POST['add_faq'])){
		$add_faq = $con->insert('faqs', 
						  array(
						  		'question'=>$con->clean($_POST['question']), 
						  		'answer'=>$con->clean($_POST['answer']),
						  		'posted_by'=>$_SESSION['USR_ID']
						  	)
						);
		if(!empty($add_faq)){
			echo "3";
		}else{
			echo "4";
		}
	}

	//update faq
	if(isset($_POST['update_faq'])){
		$update_faq = $con->update('faqs', 
						  array(
						  		'question'=>$con->clean($_POST['question']), 
						  		'answer'=>$con->clean($_POST['answer'])
						  	),
						  array('faq_id'=>$con->clean($_POST['faq_id']))
						);
		if(!empty($update_faq)){
			echo "5";
		}else{
			echo "4";
		}
	}

	if($action == 'faq_delete'){
		$delete = $con->delete('faqs', array('faq_id'=>$con->clean($_GET['id'])));
		if(!empty($delete)){
			echo "1";
		}else{
			echo "2";
		}
	}

	/**************Help desk tickets*****************/
	//add products
	if(isset($_POST['add_product'])){
		$product = $con->insert('products', array('product'=>$con->clean($_POST['product_name'])));
		if(!empty($product)){
			echo "1";
		}else{
			echo "2";
		}
	}
	//delete product
	if($action == "delete_product"){
		$delete = $con->delete('products', array('product_id'=>$con->clean($_GET['id'])));
		if(!empty($delete)){
			echo "1";
		}else{
			echo "2";
		}
	}
	//add ticket category
	if(isset($_POST['add_ticket_category'])){
		$category = $con->insert('ticket_categories', array('ticket_category'=>$con->clean($_POST['category_name'])));
		if(!empty($category)){
			echo "3";
		}else{
			echo "4";
		}
	}
	//delete_ticket_category
	if($action == "delete_ticket_category"){
		$delete = $con->delete('ticket_categories', array('ticket_category_id'=>$con->clean($_GET['id'])));
		if(!empty($delete)){
			echo "1";
		}else{
			echo "2";
		}
	}
	//add ticket
	if(isset($_POST['add_ticket'])){
		//checks if any attachment is attached
		//set the file name to default null
	    $fileName  = null;
		//checks if the invoice file update  is attached
        if(!empty($_FILES['file']['name'])){
            //upload directory
	        $fileDir  = "../uploads/tickets/";

	        //allowed file types to upload
	        $fileTypes = array('.jpeg','.jpg','.png'); 	        

	        $file = $_FILES['file']['name'];
	        $file_ext= substr($file, strripos($file, '.')); // get file name
	        $file_basename = substr($file, 0, strripos($file, '.')); // get file extention
	        $fileName = rand()."_".time(). $file_ext;//renames the file

	        //checks if the file type is valid
	        if (!in_array(strtolower($file_ext),$fileTypes)) {
	            echo "4";
	            exit();
	        }

	        //if everything is in order upload the invoice
	        $file_temp =$_FILES['file']['tmp_name'];
	        //upload the attached document
	        if(move_uploaded_file($file_temp, $fileDir.$fileName)){

	        }else{
	        	echo "3";
	        }

        }

        //if everything is okay, proceed to add data
        $data = array(
					'posted_by'	=> $_SESSION['USR_ID'],
					'ticket_title'			=> $con->clean($_POST['title']),
					'ticket_description'	=> $con->clean($_POST['description']),
					'ticket_category'		=> $con->clean($_POST['category']),
					'ticket_product'		=> $con->clean($_POST['product']),
					'ticket_priority'		=> $con->clean($_POST['priority']),
					'ticket_attachment'		=> $fileName,
					'member_of'				=> $_SESSION['USR_OF']
				);
        $add_ticket = $con->insert('tickets', $data);
        if(!empty($add_ticket)){
        	//sends a notification that the invoice has been updated
        	echo "1";
        }else{
        	echo "2";
        }

	}

	//send ticket message
	if(isset($_POST['add_response'])){
		$data = array(
					'ticket_id'	=> $con->clean($_POST['id']),
					'member_id'	=> $_SESSION['USR_ID'],
					'response'	=> $con->clean($_POST['response'])
				);
		$send = $con->insert('ticket_response', $data);
		if(!empty($send)){
			echo "1";
		}else{
			echo "2";
		}
	}

	//close a ticket
	if(isset($_POST['close_ticket'])){
		$close = $con->update('tickets', array('date_closed'=>date('Y-m-d H:i:s'), 'ticket_status'=>1, 'closing_remarks'=>$con->clean($_POST['remark'])), array('ticket_id'=>$_POST['id']));
		if(!empty($close)){
			echo "1";
		}else{
			echo"2";
		}
	}
	//delete ticket
	if($action == 'ticket_delete'){
		$delete = $con->delete('tickets', array('ticket_id'=>$_GET['id']));
		if(!empty($delete)){
			echo "1";
			//delete replies in the database 
			$con->delete('ticket_response', array('ticket_id'=>$_GET['id']));
			//delete screenshots 
			if(!empty($_GET['file'])){
				if(file_exists("../uploads/tickets/".$_GET['file'])){
		            unlink("../uploads/tickets/".$_GET['file']);
		        }
			}
	        
		}else{
			echo"2";
		}
	}

	//update progress
	if(isset($_POST['update_progress'])){
		$update = $con->update('tickets', array('ticket_progress'=>$con->clean($_POST['progress'])), array('ticket_id'=>$con->clean($_POST['ticket_id'])));
		if(!empty($update)){
			echo "5";
		}else{
			echo "6";
		}
	}
	/***************end help desk********************/

	/**************Leave Application****************/
	//add leave types
	if(isset($_POST['add_leave'])){
		$save = $con->insert('leave_types', array('name'=>$con->clean($_POST['name']),'description'=>$con->clean($_POST['desc'])));
		if(!empty($save)){
			echo "1";
		}else{
			echo "2";
		}
	}

	//delete_leave_type
	if($action == 'delete_leave_type'){
		$delete = $con->delete('leave_types', array('type_id'=>$_GET['id']));
		if(!empty($delete)){
			echo "1";
		}else{
			echo "2";
		}
	}

	//add employee leave_entitlement
	if(isset($_POST['leave_entitlement'])){
		$days = $con->clean($_POST['days']);
		//gets the current financial year
		$fy = $con->getRows('leave_fy', array('where'=>'fy_status=0','order_by'=>'fy_id desc','return_type'=>'single'));

		$data = array(
					'member_id' => $con->clean($_POST['id']),
					'type_id'	=> $con->clean($_POST['leave']),
					'entitlement'=>$con->clean($_POST['days'])
				);
		//checks if the entitlement has already been added, if it is, it is updated.
		$check = $con->getRows('leave_entitlement',array('where'=>'member_id="'.$_POST['id'].'" and 
								type_id="'.$_POST['leave'].'"','return_type'=>'single'));
		if(!empty($check)){
			$save = $con->update('leave_entitlement', $data, array('member_id'=>$con->clean($_POST['id']),
								 'type_id'=>$con->clean($_POST['leave'])));
			//updates this years leave days table
			$leave_days = $con->getRows('leave_days', array('where'=>'user_id="'.$_POST['id'].'" and fy_id="'.$fy['fy_id'].'" and leave_id="'.$con->clean($_POST['leave']).'"','return_type'=>'single'));
			$balance = 0;
			$taken = 0;
			if(!empty($leave_days)){
				$balance = $leave_days['days_remaining'];
				$taken = $leave_days['days_taken'];
			}
			$con->update('leave_days', array('days_entitled'=>$days, 'days_remaining'=>$days-$taken), 
						array('fy_id'=>$fy['fy_id'], 'leave_id'=>$con->clean($_POST['leave']), 'user_id'=>$con->clean($_POST['id'])));
		}else{
			$save = $con->insert('leave_entitlement', $data);
			$record = $con->insert('leave_days', array('days_entitled'=>$days, 'days_remaining'=>$days, 'days_taken'=>0, 'fy_id'=>$fy['fy_id'], 'leave_id'=>$con->clean($_POST['leave']), 'updated_by'=>$_SESSION['USR_ID'], 'user_id'=>$con->clean($_POST['id']))
				);
			if(!empty($record)){
				//echo "string";
			}
		}
		//$save = '';
		
		if(!empty($save)){
			echo "3";
		}else{
			echo "4";
		}
	}

	//update current financial year
	if($action == 'update_fy'){
		$current_year = $_GET['id'];
		$new_year = $current_year + 1;

		$update = $con->insert('leave_fy', 
							array('fy'=>$new_year, 'updated_by'=>$_SESSION['USR_ID'])
						);		

		if(!empty($update)){
			echo "1";
			$con->update('leave_fy', array('fy_status'=>1), array('fy'=>$current_year));
		}else{
			echo "2";
		}

	}

	//add public holidays
	if(isset($_POST['add_holiday'])){
		$data = array(
					'fy_id'		=> $con->clean($_POST['fy']),
					'holiday'	=> $con->clean($_POST['holiday']),
					'date'		=> $con->clean($_POST['date'])
				);
		$save = $con->insert('public_holidays', $data);

		if(!empty($save)){
			echo "9";
		}else{
			echo "10";
		}
	}

	//delete leave
	if($action == "delete_holiday"){
		$id = $con->clean($_GET['id']);
		$delete = $con->delete('public_holidays', array('holiday_id'=>$id));
		if(!empty($delete)){
			echo "1";
		}else{
			echo "2";
		}
	}

	//apply leave
	if(isset($_POST['apply_leave'])){
		$today = date('Y-m-d');
		$startDate = $con->clean($_POST['date_from']);
		$endDate   = $con->clean($_POST['date_to']);
		$totalDays = $con->dateTimesToDays($startDate, $endDate);
		$leaveType = $con->clean($_POST['type']);
		$leaveDays = 0;		
		$weekends  = 0;
		$holidays  = 0;

		//gets the current financial year

		//checks if the dates are inline i.e are in order
		if($startDate > $endDate){
			echo "5";
			exit();
		}
		//checks the public holiday days in the selected dates
		$holidays = $con->getRows('public_holidays', array('where'=>'date BETWEEN "'.$startDate.'" AND "'.$endDate.'"', 
								  'return_type'=>'count'));

		//checks the weekends in the selected dates
		$weekends = $con->countWeekends($startDate, $endDate);

		$leaveDays =$totalDays - ($holidays + $weekends);

		if($leaveDays <= 0){
			echo "4";
			exit();
		}

		//checks if the leave days remaining is enough to grant new holiday...
		//$leave_days = $con->getRows('')

		
		//checks the entitlement balance of the employee
		$days = $con->getRows('leave_days a, leave_fy b', array('where'=>'a.user_id="'.$_SESSION['USR_ID'].'" AND a.leave_id="'.$leaveType.'" and a.fy_id=b.fy_id and b.fy_status=0', 'return_type'=>'single'));
		
		$remaining_days = 0;
		$days_taken = 0;
		$days_entitled =0;
		if(!empty($days)){
			$remaining_days = $days['days_remaining'];
			$days_taken = $days['days_taken'];
			$days_entitled = $days['days_entitled'];
		}else{
			echo "6";
			exit();
		}
		$leaveDays.' - '. $remaining_days;

		if(($leaveDays > $remaining_days) && $leaveDays !=0){
			echo "7";
			exit();
		}

		//exit();
		//checks the financial year of the application
		if($startDate < $today || $endDate < $today){
			echo "3";
			exit();
		}
		$data = array(
					'member_id'		=> $con->clean($_POST['user_id']),
					'leave_type'	=> $leaveType,
					'date_start'	=> $startDate,
					'date_end'		=> $endDate,
					'reason'		=> $con->clean($_POST['reasons']),
					'fy_id'			=> $con->clean($_POST['fy']),
					'leave_roaster' => $con->clean($_POST['leave_roaster']),
					'leave_grant'	=> $con->clean($_POST['leave_grant']),
					'leave_days'	=> $leaveDays
				);
		$apply = $con->insert('leave_applications', $data);
		if(!empty($apply)){
			echo "1";
			//update remaining leave days
			//
			$days_taken = $days_taken + $leaveDays;
			$days_remaining = $remaining_days - $leaveDays;
			$get_days = $con->update('leave_days', array('days_taken'=>$days_taken, 'days_remaining'=>$days_remaining),
						array('record_id'=>$days['record_id']));
			if(empty($get_days)){
				echo "string";
			}
			//inform heads of departments to check the newly posted leave application
			$checkers = $con->getRows('muscco_members a, permissions_granted b', array('where'=>'a.muscco_member_id=b.member_id and b.permission_id=6 and a.muscco_member_id != "'.$_SESSION['USR_ID'].'"'));
			if(!empty($checkers)){
				foreach ($checkers as $checker) {
					$subject = "You have received a new leave application(#".$apply.") to check";
			        $message = "Hey ".ucwords($checker['first_name']).", Please go to 'Check Leave' section to check the newly posted leave application";
			        $to = $checker['member_id'];
			        $con->sendNotification($to,$_SESSION['USR_ID'],$subject,$message);
			        $con->sendMail($checker['email_address'], $message, $subject);
				}
			}
		}else{
			echo "2";
		}
	}

	//check leave
	if(isset($_POST['check_leave'])){
		$data = array();

		if($_POST['action'] == 1){
			$data = array(
						'checked_by' 	=> $_SESSION['USR_ID'],
						'date_checked'	=> date('Y-m-d H:i:s'),
						'leave_status'	=> 1,
						'check_reasons' => $con->clean($_POST['reasons'])
					);
		}else{
			$data = array(
					'date_declined'	=> date('Y-m-d H:i:s'),
					'leave_status'	=> 4,
					'decline_reason'=> $con->clean($_POST['reasons']),
					'declined_by'	=> $_SESSION['USR_ID']
				);
		}
		$check = $con->update('leave_applications',$data, array('application_id'=>$con->clean($_POST['application_id'])));
		if(!empty($check)){
			echo "7";

			if($_POST['action'] == 1){
				//inform admin to verify the newly posted leave application

				$checkers = $con->getRows('muscco_members a, permissions_granted b', array('where'=>'a.muscco_member_id=b.member_id and b.permission_id=8'));
				if(!empty($checkers)){
					foreach ($checkers as $checker) {
						$subject = "You have received a new leave application(#".$_POST['application_id'].") to verify";
				        $message = "Hey ".ucwords($checker['first_name']).", Please go to 'Verify Leave' section to verify the newly posted leave application";
				        $to = $checker['member_id'];
				        $con->sendNotification($to,$_SESSION['USR_ID'],$subject,$message);
					}
				}
			}else{
				$id = $con->clean($_POST['application_id']);
				//before deleting the application, get the leave type and leave days and update the leave days taken
				$days = $con->getRows('leave_applications',  array('where'=>'application_id="'.$id.'"','return_type'=>'single'));
				if(!empty($days)){
					$days_taken = $days['leave_days'];
					$leave_type = $days['leave_type'];
					$fy_id = $days['fy_id'];

					$leave_days = $con->getRows('leave_days', array('where'=>'fy_id="'.$fy_id.'" and user_id="'.$days['member_id'].'" and leave_id="'.$leave_type.'"', 'return_type'=>'single'));
					if(!empty($leave_days)){
						$daysTaken = $leave_days['days_taken'] - $days_taken;
						$remaining_days = $leave_days['days_remaining'] + $days_taken;

						$con->update('leave_days', array('days_taken'=>$daysTaken, 'days_remaining'=>$remaining_days),
								array('record_id'=>$leave_days['record_id']));
					}
				}

				$subject = "Your leave application(#".$_POST['application_id'].") has been denied";
		        $message = "Hey ".ucwords($_POST['name']).", your leave application has been denied, the reason(s) given are '".$_POST['reasons']."'.";
		        $to = $_POST['user_id'];
		        $con->sendNotification($to,$_SESSION['USR_ID'],$subject,$message);
			}
		}else{
			echo "8";
		}
	}

	//verify leave applications
	if(isset($_POST['verify_leave'])){
		$data = array();

		if($_POST['action'] == 2){
			$data = array(
					'date_verified'	=> date('Y-m-d H:i:s'),
					'leave_status'	=> 2,
					'verify_reasons'=> $con->clean($_POST['reasons']),
					'verified_by'	=> $_SESSION['USR_ID'],
				);
		}else{
			$data = array(
					'date_declined'	=> date('Y-m-d H:i:s'),
					'leave_status'	=> 4,
					'decline_reason'=> $con->clean($_POST['reasons']),
					'declined_by'	=> $_SESSION['USR_ID']
				);
		}
		
		$verify = $con->update('leave_applications', $data, array('application_id'=>$con->clean($_POST['application_id'])));
		if(!empty($verify)){
			echo "7";
			if($_POST['action'] == 2){
				//inform CE to approve the newly posted leave application
				$checkers = $con->getRows('muscco_members a, permissions_granted b', array('where'=>'a.muscco_member_id=b.member_id and b.permission_id=7'));
				if(!empty($checkers)){
					foreach ($checkers as $checker) {
						$subject = "You have received a new leave application(#".$_POST['application_id'].") to approve";
				        $message = "Hey ".ucwords($checker['first_name']).", Please go to 'Approve Leave' section to approve the newly posted leave application";
				        $to = $checker['member_id'];
				        $con->sendNotification($to,$_SESSION['USR_ID'],$subject,$message);
					}
				}
			}else{
				$id = $con->clean($_POST['application_id']);
				//before deleting the application, get the leave type and leave days and update the leave days taken
				$days = $con->getRows('leave_applications',  array('where'=>'application_id="'.$id.'"','return_type'=>'single'));
				if(!empty($days)){
					$days_taken = $days['leave_days'];
					$leave_type = $days['leave_type'];
					$fy_id = $days['fy_id'];

					$leave_days = $con->getRows('leave_days', array('where'=>'fy_id="'.$fy_id.'" and user_id="'.$days['member_id'].'" and leave_id="'.$leave_type.'"', 'return_type'=>'single'));
					if(!empty($leave_days)){
						$daysTaken = $leave_days['days_taken'] - $days_taken;
						$remaining_days = $leave_days['days_remaining'] + $days_taken;

						$con->update('leave_days', array('days_taken'=>$daysTaken, 'days_remaining'=>$remaining_days),
								array('record_id'=>$leave_days['record_id']));
					}
				}
				$subject = "Your leave application(#".$_POST['application_id'].") has been denied";
		        $message = "Hey ".ucwords($_POST['name']).", your leave application has been denied, the reason(s) given are '".$_POST['reasons']."'.";
		        $to = $_POST['user_id'];
		        $con->sendNotification($to,$_SESSION['USR_ID'],$subject,$message);
			}
		}else{
			echo "8";
		}
	}

	//approve leave application
	if(isset($_POST['approve_leave'])){
		$data = array();

		if($_POST['action'] == 3){
			$data = array(
					'date_approved'	=> date('Y-m-d H:i:s'),
					'leave_status'	=> 3,
					'approve_reasons'=> $con->clean($_POST['reasons']),
					'approved_by'	=> $_SESSION['USR_ID']
				);
		}else{
			$data = array(
					'date_declined'	=> date('Y-m-d H:i:s'),
					'leave_status'	=> 4,
					'decline_reason'=> $con->clean($_POST['reasons']),
					'declined_by'	=> $_SESSION['USR_ID']
				);
		}
		
		$approve = $con->update('leave_applications', $data, array('application_id'=>$con->clean($_POST['application_id'])));
		if(!empty($approve)){
			echo "7";
			if($_POST['action'] == 3){
				//compose notification
				$subject = "Your leave application(#".$_POST['application_id'].") has been approved";
		        $message = "Hey ".ucwords($_POST['name']).", your leave application has been approved, the note(s) given are '".$_POST['reasons']."'.";
		        $to = $_POST['user_id'];
		        $con->sendNotification($to,$_SESSION['USR_ID'],$subject,$message);
		    }else{
		    	$id = $con->clean($_POST['application_id']);
				//before deleting the application, get the leave type and leave days and update the leave days taken
				$days = $con->getRows('leave_applications',  array('where'=>'application_id="'.$id.'"','return_type'=>'single'));
				if(!empty($days)){
					$days_taken = $days['leave_days'];
					$leave_type = $days['leave_type'];
					$fy_id = $days['fy_id'];

					$leave_days = $con->getRows('leave_days', array('where'=>'fy_id="'.$fy_id.'" and user_id="'.$days['member_id'].'" and leave_id="'.$leave_type.'"', 'return_type'=>'single'));
					if(!empty($leave_days)){
						$daysTaken = $leave_days['days_taken'] - $days_taken;
						$remaining_days = $leave_days['days_remaining'] + $days_taken;

						$con->update('leave_days', array('days_taken'=>$daysTaken, 'days_remaining'=>$remaining_days),
								array('record_id'=>$leave_days['record_id']));
					}
				}
		    	$subject = "Your leave application(#".$_POST['application_id'].") has been denied";
		        $message = "Hey ".ucwords($_POST['name']).", your leave application has been denied, the reason(s) given are '".$_POST['reasons']."'.";
		        $to = $_POST['user_id'];
		        $con->sendNotification($to,$_SESSION['USR_ID'],$subject,$message);
		    }
		}else{
			echo "8";
		}
	}

	//decline leave
	if(isset($_POST['decline_leave'])){

		$data = array(
					'date_declined'	=> date('Y-m-d H:i:s'),
					'leave_status'	=> 4,
					'decline_reason'=> $con->clean($_POST['reasons']),
					'declined_by'	=> $_SESSION['USR_ID']
				);
		$decline = $con->update('leave_applications', $data, array('application_id'=>$con->clean($_POST['application_id'])));
		if(!empty($decline)){
			echo "7";

			$id = $con->clean($_GET['application_id']);
			//before deleting the application, get the leave type and leave days and update the leave days taken
			$days = $con->getRows('leave_applications',  array('where'=>'application_id="'.$id.'"','return_type'=>'single'));
			if(!empty($days)){
				$days_taken = $days['leave_days'];
				$leave_type = $days['leave_type'];
				$fy_id = $days['fy_id'];

				$leave_days = $con->getRows('leave_days', array('where'=>'fy_id="'.$fy_id.'" and user_id="'.$days['member_id'].'" and leave_id="'.$leave_type.'"', 'return_type'=>'single'));
				if(!empty($leave_days)){
					$daysTaken = $leave_days['days_taken'] - $days_taken;
					$remaining_days = $leave_days['days_remaining'] + $days_taken;

					$con->update('leave_days', array('days_taken'=>$daysTaken, 'days_remaining'=>$remaining_days),
							array('record_id'=>$leave_days['record_id']));
				}
			}
			$subject = "Your leave application(#".$_POST['application_id'].") has been denied";
	        $message = "Hey ".ucwords($_POST['name']).", your leave application has been denied, the reason(s) given are '".$_POST['reasons']."'.";
	        $to = $_POST['user_id'];
	        $con->sendNotification($to,$_SESSION['USR_ID'],$subject,$message);
		}else{
			echo "8";
		}
	}

	//delete leave
	if($action == "btn_delete_leave"){
		$id = $con->clean($_GET['id']);
		//before deleting the application, get the leave type and leave days and update the leave days taken
		$days = $con->getRows('leave_applications',  array('where'=>'application_id="'.$id.'"','return_type'=>'single'));
		if(!empty($days)){
			$days_taken = $days['leave_days'];
			$leave_type = $days['leave_type'];
			$fy_id = $days['fy_id'];

			$leave_days = $con->getRows('leave_days', array('where'=>'fy_id="'.$fy_id.'" and user_id="'.$days['member_id'].'" and leave_id="'.$leave_type.'"', 'return_type'=>'single'));
			if(!empty($leave_days)){
				$daysTaken = $leave_days['days_taken'] - $days_taken;
				$remaining_days = $leave_days['days_remaining'] + $days_taken;

				$con->update('leave_days', array('days_taken'=>$daysTaken, 'days_remaining'=>$remaining_days),
						array('record_id'=>$leave_days['record_id']));
			}
		}
		$delete = $con->delete('leave_applications', array('application_id'=>$id));
		if(!empty($delete)){
			echo "1";
		}else{
			echo "2";
		}
	}

	/*************************************************/
	//add topic
	if(isset($_POST['add_topic'])){
		$data = array(
					'topic'	=>$con->clean($_POST['title']),
					'description'	=> $con->clean($_POST['description']),
					'access_rights'	=> $con->clean($_POST['access_rights']),
					'posted_by'		=> $_SESSION['USR_ID']
				);
		$add = $con->insert('discussions', $data);
		if(!empty($add)){
			echo "1";
		} else{
			echo "2";
		}
	}

	//add comment
	if(isset($_POST['add_comment'])){
		$data = array(
					'topic_id' => $con->clean($_POST['topic_id']),
					'reply'	   => $con->clean($_POST['comment']),
					'replied_by' => $_SESSION['USR_ID'],
					'member_of'  => $_SESSION['USR_OF']
				);
		$comment = $con->insert('discussion_replies', $data);
		if(!empty($comment)){
			echo "3";
		} else{
			echo "4";
		}
	}

	//delete_topic
	if($action == 'delete_topic'){
		$delete = $con->delete('discussions', array('topic_id'=>$_GET['id']));
		if(!empty($delete)){
			echo "1";

			//delete comments
			$con->delete('discussion_replies', array('topic_id'=>$_GET['id']));
		}else{
			echo "2";
		}
	}

	/*******************vehicle request*****************/
		//add request
		if(isset($_POST['vehicle_request'])){
			$data = array(
						'requested_by'	=> $con->clean($_POST['user_id']),
						'driver_name'	=> $con->clean($_POST['driver']),
						'activity_name'	=> $con->clean($_POST['activity']),
						'date_from'		=> $con->clean($_POST['date_from']),
						'date_to'		=> $con->clean($_POST['date_to']),
						'destination'	=> $con->clean($_POST['to']),
						'departure_from'	=> $con->clean($_POST['from']),
						);
			$post_req = $con->insert('vehicle_requests', $data);
			if(!empty($post_req)){
				echo "1";
			}else{
				echo "2";
			}
		}

		//assign vehicle
		if(isset($_POST['assign_vehicle'])){
			$tools = '';
			foreach ($_POST['tools'] as $tool) {
				$tools =$tools." ".$tool;
			}

			$data = array(
						'vehicle_assigned'	=> $con->clean($_POST['reg_number']),
						'open_mileage'		=> $con->clean($_POST['mileage']),
						'fuel_level'		=> $con->clean($_POST['fuel']),
						'tools'				=> $tools,
						'dents'				=> $con->clean($_POST['dent']),
						'spare_tyre'		=> $con->clean($_POST['spare']),
						'cleanliness'		=> $con->clean($_POST['clean']),
						'checked_by'		=> $_SESSION['USR_ID'],
						'date_checked'		=> date('Y-m-d'),
						'request_status'    => 2
					);
			$assign = $con->update('vehicle_requests', $data, array('request_id'=>$con->clean($_POST['request_id'])));
			if($assign){
				echo "1";
			}else{
				echo "2";
			}
		}

		//authorize_vehicle
		if(isset($_POST['authorize_vehicle'])){
			$data = array(
						'authorize_remarks' => $con->clean($_POST['remarks']),
						'authorized_by'		=> $_SESSION['USR_ID'],
						'date_authorized'	=> date('Y-m-d'),
						'request_status'	=> $con->clean($_POST['action'])
					);
			$authorize = $con->update('vehicle_requests', $data, array('request_id'=>$con->clean($_POST['request_id'])));
			if(!empty($authorize)){
				echo "3";
			}else{
				echo "4";
			}
		}

		//receive vehicle
		if(isset($_POST['received_vehicle'])){
			$data = array(
						'date_received' => date('Y-m-d'),
						'request_status'=> 3						
					);
			$receive = $con->update('vehicle_requests', $data, array('request_id'=>$_POST['request_id']));
			if(!empty($receive)){
				echo "5";
			}else{
				echo "6";
			}
		}

		//return vehicle 
		if(isset($_POST['return_vehicle'])){
			$tools = '';
			foreach ($_POST['tools'] as $tool) {
				$tools =$tools." ".$tool;
			}

			$data = array(
						'close_mileage'		=> $con->clean($_POST['mileage']),
						'return_fuel_level'	=> $con->clean($_POST['fuel']),
						'return_tools'		=> $tools,
						'return_dents'		=> $con->clean($_POST['dent']),
						'return_spare_tyre'	=> $con->clean($_POST['spare']),
						'return_cleanliness'=> $con->clean($_POST['clean']),
						'fuel_used'	    	=> $con->clean($_POST['fuel_used']),
						'distance_covered' 	=> $con->clean($_POST['distance']),
						'date_returned'		=> $con->clean($_POST['date']),
						'request_status'    => 4
					);
			$assign = $con->update('vehicle_requests', $data, array('request_id'=>$con->clean($_POST['request_id'])));
			if($assign){
				echo "1";
			}else{
				echo "2";
			}
		}
	/***************************************************/

	/****************petty cash requisition*************/
		//post petty cash requisition
		if(isset($_POST['post_petty_cash'])){
			$data = array(
						'requested_by'	=> $_SESSION['USR_ID'],
						'subject'		=> $con->clean($_POST['subject']),
						'sponsor'		=> $con->clean($_POST['sponsor']),
						'amount'		=> $con->clean($_POST['amount']),
						'description'	=> $con->clean($_POST['reasons']),
						'department_id' => $con->clean($_POST['department_id'])
					);
			$post = $con->insert('petty_cash_requisitions', $data);
			if(!empty($post)){
				echo "1";
				//send a notification to the one who approves petty cash requisitions
				$approvers = $con->getRows('muscco_members a, permissions_granted b', array('where'=>'a.muscco_member_id=b.member_id and b.permission_id=12'));
				if(!empty($approvers)){
					foreach ($approvers as $approver) {
						$subject = "You have received a new petty cash requisition(#".sprintf('%04d',$post).")";
				        $message = "Hey ".ucwords($approver['first_name']).", you have received a new petty cash requisition(#".sprintf('%04d',$post).") that needs your attention";
				        $to = $approver['member_id'];
				        $con->sendNotification($to,$_SESSION['USR_ID'],$subject,$message);
					}
				} 
				
			}else{
				echo "2";
			}
		}

		//approve petty cash
		if(isset($_POST['approve_petty_cash'])){
			$data = array(
							'approved_by'	=> $_SESSION['USR_ID'],
							'date_approved' => date('Y-m-d'),
							'remarks'		=> $con->clean($_POST['remarks']),
							'requisition_status'=> $con->clean($_POST['action'])
						);
			$approve = $con->update('petty_cash_requisitions', $data, array('requisition_id'=>$con->clean($_POST['request_id'])));
			if(!empty($approve)){
				echo "3";
				//send a notification to the one who approves petty cash requisitions
				$action = '';
				if($_POST['action'] == 1){
					$action = 'Approved';
				}else{
					$action = 'Declined';
				}
				$subject = "Your petty cash requisition(#".sprintf('%04d',$_POST['request_id']).") has been ".$action;
		        $message = "Hey, your petty cash requisition(#".sprintf('%04d',$_POST['request_id']).") that you posted has been ".$action.", go to details to check the update";
		        $to = $con->clean($_POST['posted_by']);
		        $con->sendNotification($to,$_SESSION['USR_ID'],$subject,$message);
					

			}else{
				echo "4";
			}
		}

		//delete petty cash
		if($action == "btn_pettycash"){
			$id = $con->clean($_GET['id']);
			//print_r($_GET);
			$delete = $con->delete('petty_cash_requisitions', array('requisition_id'=>$id));
			if(!empty($delete)){
				echo "1";
			}else{
				echo "2";
			}
		}
	/**************************************************/
	/*****************staff advance**************************/
		//request advance
		if(isset($_POST['request_advance'])){
			//firstly it checks the months to see if they are in order
			if($_POST['end'] < $_POST['start']){
				echo "4";
				exit();
			}
			$months = $con->getMonths($_POST['start'], $_POST['end']); //finds number of months
			$monthly = $_POST['amount']/$months; //finds monhtly installment

			$data = array(
						'requested_by'	=> $_SESSION['USR_ID'],
						'amount'		=> $con->clean($_POST['amount']),
						'start'			=> $con->clean($_POST['start']),
						'end'			=> $con->clean($_POST['end']),
						'purpose'		=> $con->clean($_POST['reasons']),
						'months'		=> $months,
						'monthly_installment' => $monthly,
						'balance'		=> $con->clean($_POST['amount'])
					);
			$post = $con->insert('advance_requests', $data);
			if(!empty($post)){
				echo "1";
				//send notification
				//send a notification to the one who verifies advance requests
				$verifyers = $con->getRows('muscco_members a, permissions_granted b', array('where'=>'a.muscco_member_id=b.member_id and b.permission_id=14'));
				if(!empty($verifyers)){
					foreach ($verifyers as $verify) {
						$subject = "You have received a new advance request(#".sprintf('%04d',$post).")";
				        $message = "Hey ".ucwords($verify['first_name']).", you have received a new staff advance request(#".sprintf('%04d',$post).") that needs your attention.";
				        $to = $verify['member_id'];
				        $con->sendNotification($to,$_SESSION['USR_ID'],$subject,$message);
					}
				} 
			}else{
				echo "2";
			}
		}

		//verify advance
		if(isset($_POST['verify_advance'])){
			$data = array(
						'verified_by'		=> $_SESSION['USR_ID'],
						'verified_date' 	=> date('Y-m-d'),
						'verified_comment'	=> $con->clean($_POST['comment']),
						'advance_status'	=> $con->clean($_POST['action'])
					);
			$verify = $con->update('advance_requests', $data, array('advance_id'=>$con->clean($_POST['request_id'])));
			if(!empty($verify)){
				echo "5";
				//send a notification to the one who checks advances
				$action = '';
				if($_POST['action'] == 1){
					$action = 'Approved';
					//send a notification to the one who verifies advance requests
					$checkers = $con->getRows('muscco_members a, permissions_granted b', array('where'=>'a.muscco_member_id=b.member_id and b.permission_id=14'));
					if(!empty($checkers)){
						foreach ($checkers as $check) {
							$subject = "You have received a new advance request(#".sprintf('%04d',$_POST['request_id']).") to check";
					        $message = "Hey ".ucwords($check['first_name']).", you have received a new staff advance request(#".sprintf('%04d',$_POST['request_id']).") that needs your attention  to verify staff's previous advances";
					        $to = $check['member_id'];
					        $con->sendNotification($to,$_SESSION['USR_ID'],$subject,$message);
						}
					} 
				}else{
					//if the request is declined, inform the one who posted
					$action = 'Declined';
					$subject = "Your advance request(#".sprintf('%04d',$_POST['request_id']).") has been ".$action;
			        $message = "Hey, your advance request(#".sprintf('%04d',$_POST['request_id']).") that you posted has been ".$action.", go to details to check the update";
			        $to = $con->clean($_POST['posted_by']);
			        $con->sendNotification($to,$_SESSION['USR_ID'],$subject,$message);
				}
				
			}else{
				echo "6";
			}
		}

		//check advance
		if(isset($_POST['check_advance'])){
			$data = array(
						'supervised_by'		=> $_SESSION['USR_ID'],
						'date_supervised' 	=> date('Y-m-d'),
						'supervisor_comment'=> $con->clean($_POST['comment']),
						'advance_status'	=> $con->clean($_POST['action'])
					);
			$check = $con->update('advance_requests', $data, array('advance_id'=>$con->clean($_POST['request_id'])));
			if(!empty($check)){
				echo "7";
				//send a notification to the one who checks advances
				$action = '';
				if($_POST['action'] == 3){
					$action = 'Approved';
					//send a notification to the one who verifies advance requests
					$approver = $con->getRows('muscco_members a, permissions_granted b', array('where'=>'a.muscco_member_id=b.member_id and b.permission_id=15'));
					if(!empty($approver)){
						foreach ($approver as $check) {
							$subject = "You have received a new advance request(#".sprintf('%04d',$_POST['request_id']).") to approve";
					        $message = "Hey ".ucwords($check['first_name']).", you have received a new staff advance request(#".sprintf('%04d',$_POST['request_id']).") that needs your approval";
					        $to = $check['member_id'];
					        $con->sendNotification($to,$_SESSION['USR_ID'],$subject,$message);
						}
					} 
				}else{
					//if the request is declined, inform the one who posted
					$action = 'Declined';
					$subject = "Your advance request(#".sprintf('%04d',$_POST['request_id']).") has been ".$action;
			        $message = "Hey, your advance request(#".sprintf('%04d',$_POST['request_id']).") that you posted has been ".$action.", go to details to check the update";
			        $to = $con->clean($_POST['posted_by']);
			        $con->sendNotification($to,$_SESSION['USR_ID'],$subject,$message);
				}
			}else{
				echo "8";
			}
		}

		//approve_advance
		if(isset($_POST['approve_advance'])){
			$data = array(
						'approved_by'		=> $_SESSION['USR_ID'],
						'date_approved' 	=> date('Y-m-d'),
						'approval_remark'	=> $con->clean($_POST['comment']),
						'advance_status'	=> $con->clean($_POST['action'])
					);
			$approve = $con->update('advance_requests', $data, array('advance_id'=>$con->clean($_POST['request_id'])));
			if(!empty($approve)){
				echo "9";
				//send a notification to the one who posted the request
				$action = '';
				if($_POST['action'] == 4){
					$action = 'Approved';
				}else{
					$action = 'Declined';
				}
				$subject = "Your staff advance request(#".sprintf('%04d',$_POST['request_id']).") has been ".$action;
		        $message = "Hey, your petty cash requisition(#".sprintf('%04d',$_POST['request_id']).") that you posted has been ".$action.", go to details to check the update";
		        $to = $con->clean($_POST['posted_by']);
		        $con->sendNotification($to,$_SESSION['USR_ID'],$subject,$message);
			}else{
				echo "10";
			}
		}

		//update payment
		if(isset($_POST['make_payment'])){
			//gets the current amount and balances of the advance 
			
			$advance = $con->getRows('advance_requests', array('where'=>'advance_id="'.$_POST['request_id'].'"', 'return_type'=>'single'));
			$balance = $advance['balance'];
			$amount  = $advance['amount'];
			$paid  = $advance['total_paid'];
			$status = $advance['advance_status'];

			$total_paid =$paid + $con->clean($_POST['amount']); //120 
			$remain_balance = $amount - $total_paid; //100 - 120 = -20

			//checks if the remainin balance is less than 0
			if($remain_balance < 0){
				echo"13";
				exit();
			}
			//checks if the balance is zero
			if($remain_balance == 0){
				$status = '5';
			}

			$data = array(
					'amount_paid'	=> $con->clean($_POST['amount']),
					'date_paid'		=> $con->clean($_POST['paid_date']),
					'recorded_by'	=> $_SESSION['USR_ID'],
					'advance_id'	=> $con->clean($_POST['request_id'])
				);

			$pay = $con->insert('advance_payments', $data);
			if(!empty($pay)){
				echo "11";
				$con->update('advance_requests', array('total_paid'=>$total_paid,'balance'=>$remain_balance, 'advance_status'=>$status), array('advance_id'=>$_POST['request_id']));
			}else{
				echo "12";
			}

		}

		//delete advance..
		if($action == "btn_delete_advance"){
			$id = $con->clean($_GET['id']);
			//print_r($_GET);
			$delete = $con->delete('advance_requests', array('advance_id'=>$id));
			if(!empty($delete)){
				echo "1";
			}else{
				echo "2";
			}
		}
	/********************************************************/

	//***** bands and rates*************
	//add band
	if(isset($_POST['add_band'])){
		$data = array(
				'band_title'					=> $con->clean($_POST['band_title']),
				'accomodation_ceiling'			=> $con->clean($_POST['acc_ceiling']),
				'lumpsum'						=> $con->clean($_POST['lumpsum']),
				'with_accomodation'				=> $con->clean($_POST['meals_acc']),
				'withoutaccomodation_nomeals'	=> $con->clean($_POST['without_meals_acc']),
				'withoutaccomodation_withmeals' => $con->clean($_POST['withmeals_acc'])
		);

		$add = $con->insert('band_rates', $data);
		if(!empty($add)){
			echo "3";
		}else{
			echo "4";
		}
	}

	//update_band
	if(isset($_POST['update_band'])){
		$data = array(
				'band_title'					=> $con->clean($_POST['band_title']),
				'accomodation_ceiling'			=> $con->clean($_POST['acc_ceiling']),
				'lumpsum'						=> $con->clean($_POST['lumpsum']),
				'with_accomodation'				=> $con->clean($_POST['meals_acc']),
				'withoutaccomodation_nomeals'	=> $con->clean($_POST['without_meals_acc']),
				'withoutaccomodation_withmeals' => $con->clean($_POST['withmeals_acc'])
		);

		$update = $con->update('band_rates', $data, array('band_id'=>$con->clean($_POST['band_id'])));
		if(!empty($update)){
			echo "5";
		}else{
			echo "6";
		}
	}

	//delete band
	if($action == 'delete_band'){
		$delete = $con->delete('band_rates', array('band_id'=>$con->clean($_GET['id'])));
		if(!empty($delete)){
			echo "1";
		}else{
			echo "2";
		}
	}

	//travel advance request

	//add daily itinery
	if(isset($_POST['add_itinery'])){
		$id = '';
		//checks if travel_advance_id session is active
		if(!isset($_SESSION['travel_advance_id'])){			
			$id = time().$con->get_random_string_max(50);
		}else{
			$id = $_SESSION['travel_advance_id'];
		}
		$data = array(
					'employee_id'		=> $_SESSION['USR_ID'],
					'travel_advance_id'	=> $id,
					'date'				=> $con->clean($_POST['date']),
					'place_from'		=> $con->clean($_POST['from']),
					'place_to'			=> $con->clean($_POST['to'])		
				);
		$add = $con->insert('daily_itinerary', $data);
		if(!empty($add)){
			echo "1";
			$_SESSION['travel_advance_id'] = $id;
		}else{
			echo "2";
		}
	}

	//delete itinery
	if($action == "delete_DI"){
		$delete = $con->delete('daily_itinerary', array('daily_id'=>$con->clean($_GET['id'])));
		if(!empty($delete)){
			echo "1";
		}else{
			echo "2";
		}
	}

	//post travel_advance_request
	if(isset($_POST['travel_advance_request'])){
		//checks if the daily itenerary has been added
		if(!isset($_SESSION['travel_advance_id'])){
			echo "5";
			exit();
		}
		/*
		if(!empty($_POST['mileage']) || !empty($_POST['fuel'])){
			echo "6";
			exit();
		}*/
		$mileage = 0;
		$fuel = 0;
		if(!empty($_POST['mileage'])){
			$mileage = $con->clean($_POST['mileage']);
			$fuel = $con->clean($_POST['fuel']);
		}
		if(!empty($_POST['fuel'])){
			$fuel = $con->clean($_POST['fuel']);
		}
		//gets band details
		$band = $con->getRows('band_rates', array('where'=>'band_id="'.$_SESSION['USR_BD'].'"', 'return_type'=>'single'));

		//gets the fuel rate
		$fuel = $con->getRows('fuel_prices', array('where'=>'fuel_id="'.$con->clean($_POST['fuel']).'"','return_type'=>'single'));

		//calculate allowance
		$total_allowance = 0;
		$rate_night = '';
		$day_meal = 0;
		$current_price = 0;
		if(!empty($fuel)){
			$current_price = $fuel['current_price'];
		}

		//depending on the logistics
		if($_POST['logistics'] == 1){
			//to be accomodated
			$rate_night = $band['with_accomodation'];
			$total_allowance = ($band['with_accomodation'] * $_POST['nights']) + $band['withoutaccomodation_nomeals'];
			$day_meal = $band['withoutaccomodation_nomeals'];
		}else if($_POST['logistics'] == 2){
			//lumpsum
			$rate_night = $band['lumpsum'];
			$total_allowance = ($band['lumpsum'] * $_POST['nights']) + $band['withoutaccomodation_nomeals'];
			$day_meal = $band['withoutaccomodation_nomeals'];
		}else if($_POST['logistics'] == 3){
			//return same day
			$rate_night = $band['withoutaccomodation_nomeals'];
			$total_allowance = $_POST['nights'] * $band['withoutaccomodation_nomeals'];
			$day_meal = 0;
		}

		//calculate fuel prices
		$total_fuel = 0;
		if(!empty($_POST['mileage'])){
			$total_fuel = ($_POST['mileage']/10) * $current_price;
		}

		//total budget
		$total =$total_allowance + $total_fuel;

		//echo "hello".$fuel;

		$data = array(
						'travel_advance_id' => $_SESSION['travel_advance_id'],
						'employee_id'		=> $_SESSION['USR_ID'],
						'pillar'			=> $con->clean($_POST['pillar']),
						'purpose'			=> $con->clean($_POST['purpose']),
						'logistics'			=> $con->clean($_POST['logistics']),
						'nights'			=> $con->clean($_POST['nights']),
						'rate'				=> $rate_night,
						'day_meal'			=> $day_meal,
						'mileage'			=> $mileage,
						'total_fuel'		=> $total_fuel,
						'fuel'				=> $con->clean($_POST['fuel']),
						'fuel_price'		=> $current_price,
						'total_budget'		=> $total
					);
		$submit = $con->insert('travel_advance_request', $data);
		if(!empty($submit)){
			echo "3";
			unset($_SESSION['travel_advance_id']);
		}else{
			echo "4";
		}
	}

	//check_travel_request
	if(isset($_POST['check_travel_request'])){
		$data = array(
					'checked_by'		=> $_SESSION['USR_ID'],
					'date_checked' 	=> date('Y-m-d'),
					'checker_note'=> $con->clean($_POST['remarks']),
					'request_status'	=> $con->clean($_POST['action'])
				);
		$check = $con->update('travel_advance_request', $data, array('travel_advance_id'=>$con->clean($_POST['request_id'])));
		if(!empty($check)){
			echo "7";
			//send a notification to the one who checks advances
			$action = '';
			if($_POST['action'] == 1){
				$action = 'Approved';
				//send a notification to the one who approves advance requests
				$approver = $con->getRows('muscco_members a, permissions_granted b', array('where'=>'a.muscco_member_id=b.member_id and b.permission_id=18'));
				if(!empty($approver)){
					foreach ($approver as $check) {
						$subject = "You have received a new travel advance request to approve";
				        $message = "Hey ".ucwords($check['first_name']).", you have received a new travel advance request that needs your approval";
				        $to = $check['member_id'];
				        $con->sendNotification($to,$_SESSION['USR_ID'],$subject,$message);
					}
				} 
			}else{
				//if the request is declined, inform the one who posted
				$action = 'Declined';
				$subject = "Your travel advance request has been ".$action;
		        $message = "Hey, your travel advance request that you posted has been ".$action.", go to details to check the update";
		        $to = $con->clean($_POST['posted_by']);
		        $con->sendNotification($to,$_SESSION['USR_ID'],$subject,$message);
			}
		}else{
			echo "8";
		}
	}

	//approve_travel_request
	if(isset($_POST['approve_travel_request'])){
		$data = array(
					'approved_by'		=> $_SESSION['USR_ID'],
					'date_approved' 	=> date('Y-m-d'),
					'approver_note'		=> $con->clean($_POST['remarks']),
					'request_status'	=> $con->clean($_POST['action'])
				);
		$check = $con->update('travel_advance_request', $data, array('travel_advance_id'=>$con->clean($_POST['request_id'])));
		if(!empty($check)){
			echo "9";
			//send a notification to the one who checks advances
			$action = '';
			if($_POST['action'] == 2){
				//if the request is declined, inform the one who posted
				$action = 'Approved';
				$subject = "Your travel advance request has been ".$action;
		        $message = "Hey, your travel advance request that you posted has been ".$action.", go to details to check the update";
		        $to = $con->clean($_POST['posted_by']);
		        $con->sendNotification($to,$_SESSION['USR_ID'],$subject,$message);
			}else{
				//if the request is declined, inform the one who posted
				$action = 'Declined';
				$subject = "Your travel advance request has been ".$action;
		        $message = "Hey, your travel advance request that you posted has been ".$action.", go to details to check the update";
		        $to = $con->clean($_POST['posted_by']);
		        $con->sendNotification($to,$_SESSION['USR_ID'],$subject,$message);
			}
		}else{
			echo "10";
		}
	}

	//delete trave advance request
	//note that not all requests will be deleted, only the pending request
	if($action == "delete_travel_advance_request"){
		$id = $con->clean($_GET['id']);
		$delete = $con->delete('travel_advance_request', array('travel_advance_id'=>$id));
		if(!empty($delete)){
			echo "1";

			//delete daily movements 
			$con->delete('daily_itinerary', array('travel_advance_id'=>$id));
		}else{
			echo "2";
		}
	}


	//liquidate travel advance request
	//post liquidate
	if(isset($_POST['liquidate'])){
		$fileName = '';
		$mileage = 0;
		$fuel = 0;
		$other = 0;
		$request_id = $con->clean($_POST['request_id']);

		//checks if the receipts are attached
		if(!empty($_FILES['file']['name'])){
            //upload directory
	        $fileDir  = "../uploads/receipts/";

	        //allowed file types to upload
	        $fileTypes = array('.jpeg','.jpg','.png','.pdf'); 	        

	        $file = $_FILES['file']['name'];
	        $file_ext= substr($file, strripos($file, '.')); // get file name
	        $file_basename = substr($file, 0, strripos($file, '.')); // get file extention
	        $fileName = $request_id."_".time(). $file_ext;//renames the file

	        //checks if the file type is valid
	        if (!in_array(strtolower($file_ext),$fileTypes)) {
	            echo "10";
	            exit();
	        }

	        //if everything is in order upload the invoice
	        $file_temp =$_FILES['file']['tmp_name'];
	        //upload the attached document
	        if(move_uploaded_file($file_temp, $fileDir.$fileName)){

	        }else{
	        	echo "9";
	        	exit();
	        }

        }

		$info = $con->getRows('travel_advance_request',
                        array('where'=>'travel_advance_id="'.$request_id.'"', 'return_type'=>'single'));

		
		
		if(!empty($_POST['mileage'])){
			$mileage = $con->clean($_POST['mileage']);
			$fuel = $con->clean($_POST['fuel']);
		}
		if(!empty($_POST['fuel'])){
			$fuel = $con->clean($_POST['fuel']);
		}
		//gets band details
		$band = $con->getRows('band_rates', array('where'=>'band_id="'.$_SESSION['USR_BD'].'"', 'return_type'=>'single'));

		//gets the fuel rate
		$fuel = $con->getRows('fuel_prices', array('where'=>'fuel_id="'.$con->clean($_POST['fuel']).'"','return_type'=>'single'));

		//calculate allowance
		$total_allowance = 0;
		$rate_night = '';
		$day_meal = 0;
		if(!empty($_POST['other_amount'])){
			$other = $con->clean($_POST['other_amount']);			
		}

		//depending on the logistics
		if($_POST['logistics'] == 1){
			//to be accomodated
			$rate_night = $info['rate'];
			$total_allowance = ($info['rate'] * $_POST['nights']) + $info['day_meal'];
			$day_meal = $info['day_meal'];
		}else if($_POST['logistics'] == 2){
			//lumpsum
			$rate_night = $info['rate'];
			$total_allowance = ($info['rate'] * $_POST['nights']) + $info['day_meal'];
			$day_meal = $info['day_meal'];
		}else if($_POST['logistics'] == 3){
			//return same day
			$rate_night = $info['rate'];
			$total_allowance = $_POST['nights'] * $info['day_meal'];
			$day_meal = 0;
		}

		//calculate fuel prices
		$total_fuel = 0;
		if(!empty($_POST['mileage'])){
			$total_fuel = ($_POST['mileage']/10) * $info['fuel_price'];
		}

		//total budget
		$total =$total_allowance + $total_fuel + $other;

		$total_balance = $info['total_budget'] - $total;

		//echo "hello".$fuel;

		$data = array(
						'travel_advance_id' 	=> $request_id,
						'liq_logistics'			=> $con->clean($_POST['logistics']),
						'liq_nights'			=> $con->clean($_POST['nights']),
						'liq_day_meal'			=> $con->clean($_POST['day_meal']),
						'liq_mileage'			=> $mileage,
						'liq_fuel'				=> $con->clean($_POST['fuel']),
						'liq_other'				=> $con->clean($_POST['other_expense']),
						'liq_other_amount'		=> $other,
						'liq_receipts'			=> $fileName,
						'total_liquidation'		=> $total,
						'balance_overage'		=> $total_balance
					);
		$submit = $con->insert('travel_advance_liquidations', $data);
		if(!empty($submit)){
			echo "7";
			//change request status
			$con->update('travel_advance_request', array('request_status'=>4), array('travel_advance_id'=>$request_id));
		}else{
			echo "8";
		}
	}


	//approve_travel_liquidation
	if(isset($_POST['approve_travel_liquidation'])){
		$data = array(
					'liq_approved_by'		=> $_SESSION['USR_ID'],
					'liq_date_approved' 	=> date('Y-m-d'),
					'liq_approval_remarks'	=> $con->clean($_POST['remarks']),
					'liq_status'			=> $con->clean($_POST['action'])
				);
		$check = $con->update('travel_advance_liquidations', $data, array('travel_advance_id'=>$con->clean($_POST['request_id'])));
		if(!empty($check)){
			echo "11";
			//change request status
			$con->update('travel_advance_request', array('request_status'=>5), array('travel_advance_id'=>$con->clean($_POST['request_id'])));
			//send a notification to the one who checks advances
			$action = '';
			if($_POST['action'] == 1){
				//if the request is declined, inform the one who posted
				$action = 'Approved';
				$subject = "Your travel advance request has been ".$action;
		        $message = "Hey, your travel advance request that you posted has been ".$action.", go to details to check the update";
		        $to = $con->clean($_POST['posted_by']);
		        $con->sendNotification($to,$_SESSION['USR_ID'],$subject,$message);

			}else{
				//if the request is declined, inform the one who posted
				$action = 'Declined';
				$subject = "Your travel advance request has been ".$action;
		        $message = "Hey, your travel advance request that you posted has been ".$action.", go to details to check the update";
		        $to = $con->clean($_POST['posted_by']);
		        $con->sendNotification($to,$_SESSION['USR_ID'],$subject,$message);
			}
		}else{
			echo "12";
		}
	}

	
	


	/************************************************************************/
	//delete nofication
	if($action == "delete_notification"){
		$id = $con->clean($_GET['id']);
		$delete = $con->delete('notifications', array('notification_id'=>$id));
		if(!empty($delete)){
			echo "1";
		}else{
			echo "2";
		}
	}

	//system backup
	//print_r($_POST);
	if(isset($_POST['save_backup'])){
		$title = $con->clean($_POST['title']);
		$dbb = $con->backup();
		//echo 'hello there'.$title;

		if(!empty($dbb)){
			$data = array(
						'backedup_by' => $_SESSION['USR_ID'],
						'file_title'  => $title,
						'file_name'   => $dbb
					);
			$add = $con->insert('db_backups', $data);
			if(!empty($add)){
				echo "3";
			}else{
				echo "4";
			}
		}
	}

	//delete delete_backup
	if($action == 'delete_backup'){
		$id = $_GET['id'];
		$file = $_GET['file'];

		$delete = $con->delete('db_backups', array('backup_id'=>$id));
		if(!empty($delete)){
			echo "1";
			//delete screenshots 
			if(!empty($file)){
				if(file_exists("../db/".$file)){
		            unlink("../db/".$file);
		        }
			}	        
		}else{
			echo"2";
		}
	}


	//add/update personale statement
	if(isset($_POST['add_statement'])){
		$id = $_POST['id'];
		$statement = $con->clean($_POST['statement']);
		$query = $con->update('muscco_members', array('profile'=>$statement), array('muscco_member_id'=>$id));
		if(!empty($query)){
			echo "1";
		}else{
			echo "2";
		}
		
	}

	//update branch
	if(isset($_POST['update_branch'])){
		$update = $con->update('branches', array('branch_name'=>$con->clean($_POST['branch'])), array('branch_id'=>$_POST['id']));
		if(!empty($update)){
			echo "3";
		}else{
			echo "4";
		}
	}