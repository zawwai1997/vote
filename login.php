<?php

require_once 'core/init.php';

$token = hash("sha256", time());
$_SESSION['token'] = $token;

?>

<!doctype html>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<meta name="description" content="">
		<meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
		<meta name="generator" content="Jekyll v3.8.5">
		<title>Vote | Login</title>

		<link rel="canonical" href="https://getbootstrap.com/docs/4.3/examples/floating-labels/">

		<!-- Bootstrap core CSS -->
		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">

		<link rel="stylesheet" href="css/custom-style.css">
		<link rel="stylesheet" href="css/login-bg.css">

		<style>
		.bd-placeholder-img {
			font-size: 1.125rem;
			text-anchor: middle;
			-webkit-user-select: none;
			-moz-user-select: none;
			-ms-user-select: none;
			user-select: none;
		}

		@media (min-width: 768px) {
			.bd-placeholder-img-lg {
				font-size: 3.5rem;
			}
		}
		</style>
		<!-- Custom styles for this template -->
		<link href="css/floating-labels.css" rel="stylesheet">
	</head>

	<body>
		<form class="form-signin" method="POST" action="process/login_process.php">
			<div class="text-center mb-4">
				<a href="login.php">
					<div class="menu-item">
						<div class="menu-icon">
							<img src="img/firewall.svg" width="100%" alt="">
						</div>
						<div class="menu-icon-label">
							<span class="badge badge-pill badge-primary">Login to vote</span>
						</div>
					</div>
				</a>
				<p class="text-secondary mt-3">Fill your code to vote</p>
			</div>

			<?php
    if(isset($_SESSION['ERROR']['pswErr'])) {
        ?>

			<div class="alert alert-danger text-center" role="alert" style="border-radius: 5rem; border: 0;">
				<ion-icon name="hand"></ion-icon>
				<!-- <ion-icon name="close-circle-outline"></ion-icon> -->
				<!-- <ion-icon name="warning"></ion-icon> -->
				<?php
            echo $_SESSION['ERROR']['pswErr']
            ?>
			</div>
			<?php
    }
    unset($_SESSION['ERROR']['pswErr']);
    ?>
			<!-- <div class="form-label-group">
				<input type="text" id="inputText" class="form-control input-sm" placeholder="Code Here" autofocus
					name="loginCode">
				<label for="inputText">Enter Code</label>
			</div> -->

			<input type="text" id="inputText" class="form-control mb-3 input-sm" placeholder="Code" autofocus
				name="loginCode">

			<button class="btn btn-primary btn-block" type="submit" name="btnLogin">Shall We?</button>
			<p class="mt-5 mb-3 text-muted text-center">&copy; 2019-2020</p>
			<input type="hidden" name="tok" value="<?php echo $token; ?>">
		</form>
		<p class="text-muted" style="position: absolute; bottom: 0; text-align : center; width: 100%;">
            <small class="text-muted">Proudly developed by <a href="http://www.utycc.edu.mm" style="none" class="our-website" target="_blank" >UTYCC</a></small>
		</p>

		<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
			integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
		</script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
			integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
		</script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
			integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
		</script>
		<script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
	</body>

</html>