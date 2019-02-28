<?php
	require_once('scripts/config.php');

	if(!empty($_POST['username']) && !empty($_POST['password'])){
		$username = $_POST['username'];
        $password = $_POST['password'];
        $ip = $_SERVER['REMOTE_ADDR'];

		$message = login($username,$password,$ip);	
	}else{
		if(isset($_POST['username']) || isset($_POST['password'])){
		$message = 'Please fill the required fields';
		}
	}
	
?>

<!doctype html>
<html>
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Admin Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type='text/css' media="all" href="../css/main.css">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400|Oswald:200,400,600|Roboto" rel="stylesheet">
    <script src="../js/main.js"></script>
</head>
<body>
    <div class="adminContainer">
    <div id="loginContainer">
        <h1>Admin Login</h1>
        <form action="admin_login.php" method="POST">
            <label>Username:
                <input type="text" name="username" value="">
            </label>
            <label>Password:
                <input type="password" name="password">
            </label>
            <button type="submit">Login</button>
        </form>
    </div>
    <?php if(!empty($message)):?>
        <p id="error"><?php echo $message;?></p>
    <?php endif?>
    </div>
</body>