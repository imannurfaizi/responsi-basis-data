<!DOCTYPE html>
<html lang="id">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=, initial-scale=1.0">
	<link rel="stylesheet" type="text/css" href="style.css">
	<link rel="preconnect" href="https://fonts.googleapis.com">
	<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
	<link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">
	<title>Login | Code B</title>
</head>

<body>
	<div id="login-page">
		<div class="container">
			<form class="form-login" method="POST">
				<h2 class="form-login-heading">Login</h2>
				<div class="login-wrap">
					<input type="text" name="user" placeholder="Username" class="input-control">
					<input type="password" name="pass" placeholder="Password" class="input-control">
					<input type="submit" name="sumbit" value="SIGN IN" class="btn-input">
				</div>
			</form>
			<?php
			if (isset($_POST['sumbit'])) {
				session_start();
				include 'config.php';

				$user = mysqli_real_escape_string($conn, $_POST['user']);
				$pass = mysqli_real_escape_string($conn, $_POST['pass']);

				$cek = mysqli_query($conn, "SELECT * FROM admin WHERE username = '" . $user . "' AND password = '" . MD5($pass) . "'");
				if ($user == "" && $pass == "") {
					echo '<script>alert("Tuliskan Username dan Password Anda Terlebih Dahulu!")</script>';
				} elseif (mysqli_num_rows($cek) > 0) {
					$d = mysqli_fetch_object($cek);
					$_SESSION['status_login'] = true;
					$_SESSION['a_global'] = $d;
					$_SESSION['id'] = $d->admin_id;
					echo '<script>window.location="dashboard.php"</script>';
				} else {
					echo '<script>alert("Username atau Password Anda Salah!!")</script>';
				}
			}
			?>
		</div>
	</div>

</html>