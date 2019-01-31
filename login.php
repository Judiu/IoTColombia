<?php session_start(); ?>
<?php include('dbcon.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=euc-jp">
	<title>Login IoT Colombia</title>
	
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100">
			<div class="wrap-login100">
				<div class="login100-pic js-tilt" data-tilt>
					<img src="images/U_logo.png" alt="IMG">
				</div>

				<form class="login100-form validate-form" action="#" method="post">
					<span class="login100-form-title">
						Monitor P&J
					</span>

					<div class="wrap-input100 validate-input" data-validate = "Se requiere un usuario valido">
						<input class="input100" type="text" name="user" placeholder="Usuario">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
					</div>

					<div class="wrap-input100 validate-input" data-validate = "Contraseña requerida">
						<input class="input100" type="password" name="pass" placeholder="Contraseña">
						<span class="focus-input100"></span>
						<span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
					</div>
					
					<div class="container-login100-form-btn">
						<input class="login100-form-btn" type="submit" name="login" value="Login" >
							
						</button>
					</div>

					<div class="text-center p-t-12">
						<span class="txt2">
							No eres usuario u olvidaste tu contraseña
						</span>
                        <a class="txt3" href="https://btf.beyondthefuturex.com/admin.php">
							Contacta con el administrador
						</a>
					</div>

					
				</form>
				
				<div class="text-center p-t-2">
						<a class="txt2" href="index.php">
							<?php echo date("Y") ?>. IoT Colombia. Todos los derechos reservados
						</a>
					</div>
				<?php 
					if(isset($_POST['login'])){
						$host=$_SESSION['host'];
						$url=$_SESSION['url'];
						$html="HTTPS://$host$url";
						$username = mysqli_real_escape_string($con,$_POST['user']);
						$password = mysqli_real_escape_string($con,$_POST['pass']);

						$query		= mysqli_query($con,"SELECT * FROM users WHERE password='$password' and username='$username'");
						$row		= mysqli_fetch_array($query);
						$num_row	= mysqli_num_rows($query);
						$enlace		= 'xxxxx';

						if ($num_row > 0 ){
							$_SESSION['user_id'] = $row['user_id'];
							$_SESSION['user_name'] = $row['username'];
							header('location: /index.php');
						}else{
							echo 'Invalid Username and Password combination';
						}
					}
				?>
			</div>
		</div>
	</div>
	
	

	
<!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/tilt/tilt.jquery.min.js"></script>
	<script >
		$('.js-tilt').tilt({
			scale: 1.1
		})
	</script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>
