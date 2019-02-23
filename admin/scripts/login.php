<?php 

function login($username, $password, $ip){
	require_once('connect.php');

	$check_exist_query = 'SELECT COUNT(*) FROM tbl_user';
	$check_exist_query .= ' WHERE user_name = :username';
	$user_set = $pdo->prepare($check_exist_query);
	$user_set->execute(
		array(
			':username'=>$username
		)
	);

	if($user_set->fetchColumn()>0){
		$get_user_query = 'SELECT * FROM tbl_user WHERE user_name = :username';
		$get_user_query .= ' AND user_pass = :password';
		$get_user_set = $pdo->prepare($get_user_query);
		$get_user_set->execute(
			array(
				':username'=>$username,
				':password'=>$password
			)
		);

		while($found_user = $get_user_set->fetch(PDO::FETCH_ASSOC)){
			$id = $found_user['user_id'];
			$_SESSION['user_id'] = $id;
			$_SESSION['user_fname'] = $found_user['user_fname'];
			$_SESSION['user_name'] = $found_user['user_name'];
			$_SESSION['user_pass'] = $found_user['user_pass'];
			$_SESSION['user_email'] = $found_user['user_email'];
			$_SESSION['user_date'] = $found_user['user_date'];

			$update_ip_query = 'UPDATE tbl_user SET user_ip=:ip WHERE user_id=:id';
			$update_ip_set = $pdo->prepare($update_ip_query);
			$update_ip_set->execute(
				array(
					':ip'=>$ip,
					':id'=>$id
				)
			);

			date_default_timezone_set('America/Toronto');
                $update_date_query = 'UPDATE tbl_user SET user_date = NOW() WHERE user_id = :id';
                $update_date_set = $pdo->prepare($update_date_query);
                $update_date_set->execute(
                    array(
                        ':id' => $_SESSION['user_id']
                    )
                );
            }

		if(empty($id)){
			$message = 'Login Failed!';
			return $message;
		}

		redirect_to('index.php');
	}else{
		$message = 'User does not exist!';
		return $message;
	}
}

?>