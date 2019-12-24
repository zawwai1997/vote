<?php

require_once 'core/init.php';

// $all_votes = $vote->getVotes(); // votes
$kings_arr = $vote->getDataFrom('kings');

?>


<div class="col-12">
	<h6 class="theme-my-guys font-weight-bold">ICT Projects</h6>

	<?php

        foreach($kings_arr as $key => $king) {
    ?>

	<div class="row no-gutters">
		<div class="col-10">
			<div class="name">
				<h6 class="font-unicode" style="display: block;" align="left" align="left">
					<?php echo $king['name']; ?>
					<!-- <span class="rank">1</span> -->
				</h6>
			</div>
		</div>
		<div class="col-2">
			<span
				class="badge badge-pill badge-primary theme-color theme-text-color"><?php echo $king['vote_count']; ?></span>
		</div>
	</div>


	<?php
}

?>

</div>

