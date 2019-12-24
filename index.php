<?php

require_once 'core/init.php';

if (isset($_SESSION['token']) && $_GET['id'] == $_SESSION['token']) {

$is_closed = $vote->hasVotingClosed();

$content_obj = $vote->getContent();

?>
<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<title>Vote | Index</title>
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
			integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
		<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
		<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
		<link rel="stylesheet" href="css/custom-style.css">
		<link rel="stylesheet" href="css/custom-theme.css">
		<style>
		@media screen and (max-width: 972px) {
			.theme-my-guys {
				margin-bottom: 0.5rem;
				margin-top: 1.3rem;
			}
		}
		</style>
	</head>

	<body>
		<div class="loader">
			<span class="circle1 bg-primary"></span>
			<span class="circle2 bg-primary"></span>
			<span class="circle3 bg-primary"></span>
			<span class="circle4 bg-primary"></span>
		</div>
		<div class="wrapper">
			<div class="custom-container">
				<span onclick="window.history.go(-1);" class="ion-chevron-left text-light back-link"
					style="z-index:50;"></span>
				<div class="theme-cover-div text-light">
<!--				Start of	Title Division-->
<!--                    <div class="theme-cover-title">-->
<!--                        <h3>--><?php //echo $content_obj->heading_label_1; ?><!--</h3>-->
<!--                        <label>--><?php //echo $content_obj->heading_label_2; ?><!--</label>-->
<!--                    </div>-->
<!--				End of	Title Division-->
				</div>
				<div class="theme-overlay">

				</div>



				<?php if($is_closed === FALSE) { ?>

				<div class="main-body-div">
					<h3 class="font-unicode">Welcome</h3>
					<div class="container-fluid">
						<p class="font-unicode"><?php echo $content_obj->heading_label_3; ?></p>
						<div class="row mt-4 mb-4">
							<div class="col">
								<a href="kings.php?id=<?php echo $_SESSION['token']?>">
									<div class="menu-item">
										<div class="theme-menu-icon">
											<img src="img/vote.svg" width="100%" alt="">
										</div>
<!--										<div class="theme-menu-icon-label">-->
<!--											<span class="badge badge-pill theme-color theme-text-color ">Kings</span>-->
<!--										</div>-->
									</div>
								</a>
							</div>

						</div>
						<div class="container mt-5">
							<h5 class="text-secondary">Current Voting Points</h5>
							<div class="row text-center " id="my-current-vote-div">

							</div>
						</div>

                        <p class="mt-5"><small class="text-muted">Proudly developed by <a href="http://www.utycc.edu.mm" style="none" class="our-website" target="_blank" >UTYCC</a></small></p>
					</div>
				</div>
				<?php }
                    else{
					   $winner_king = $vote->getWinner('kings'); 

                ?>
				<div class="main-body-div">
					<div class="container-fluid">
						<div class="winner-div">
							<span class="whosking">
								<?php //echo $winner_king; ?>
							</span>
							<div class="theme-kw-icon">

								<div class="thumb-ratio3x3">
									<img src="img/kings/<?php echo $winner_king[0]['id'] ?>.jpg" width="100%" alt="">
								</div>

							</div>
							<div class="w-label theme-color text-light">
								Winner Project
							</div>
							<br>
							<br>
							<?php
									echo '<span style="font-weight: 600">' . $winner_king[0]['name'] . '</span><br>';
                                    echo "Total vote count : " . $winner_king[0]['vote_count'] . "<br>";
                                    ?>
						</div>
						<hr class="mt-4 mb-4">


                        <p class="mt-5"><small class="text-muted">Proudly developed by <a href="http://www.utycc.edu.mm" style="none" class="our-website" target="_blank" >UTYCC</a></small></p>
					</div>
				</div>
				<?php } ?>

			</div>
		</div>
	</body>
	<script src="https://code.jquery.com/jquery-3.2.1.min.js"
		integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"
		integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous">
	</script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js"
		integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous">
	</script>
	<script src="js/custom.js" charset="utf-8"></script>
	<script>
	$(document).ready(function() {
		setInterval(function() {
			$('#my-current-vote-div').load('data.php');
		}, 3000);
	});
	</script>

	<?php
}
else{
   session_destroy();
header("location: login.php");
  exit();
}
		?>