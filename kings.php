<?php

require_once 'core/init.php';

if (isset($_SESSION['token']) && $_GET['id'] == $_SESSION['token']) {

    $status = $vote->hasVotingClosed();

    $content_obj = $vote->getContent();

    $user = $_SESSION['loginCode'];
    $status_king = $vote->hasVotedKQ('person', 'is_king_voted', $user); // false

    $_kings = $vote->getDataFrom('kings');
    $i = 1;
    foreach($_kings as $king) {
        $kings_data_arr["king$i"]['name'] = $king['name'];
        $kings_data_arr["king$i"]['details'] = $king['details'];
        $i++;
    }

    $salt = time();
    $king_token = hash("sha256",$salt);
    $_SESSION['vote_token'] = $king_token;
    $_SESSION['vote_person'] = 'king';

    ?>


    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <title>Projects | Vote</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css"
              integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
        <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
        <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
        <link rel="stylesheet" href="css/custom-style.css">
        <link rel="stylesheet" href="css/custom-theme.css">
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
                <!--Start of Title Division-->
                <!--					<div class="theme-cover-title">-->
                <!--						<h3>--><?php //echo $content_obj->heading_label_1; ?>
                <!--						</h3>-->
                <!--						<label>--><?php //echo $content_obj->heading_label_2; ?><!--</label>-->
                <!--					</div>-->
                <!--End of Title Division-->
            </div>
            <div class="theme-overlay">

            </div>
            <div class="main-body-div">
                <div class="profile-icon mb-3">
                    <img src="img/ist.png" width="100%" alt="">
                </div>
                <h5>Information Science and Technology</h5>
                <?php flash('success') ?>
                <?php flash('fail') ?>
                <div class="container-fluid mt-3">
                    <div class="kqlist-container">

                        <?php
                        $i = 1;
                        foreach($kings_data_arr as $king_arr => $king) {
                            ?>

                            <div class="list-div d-flex flex-wrap">
                                <div id="hi" class="">
                                    <?php echo "<img src='img/kings/{$i}.png' width='300px;' height='250px;' alt='' class='img-fluid img-thumbnail'>"; ?>
                                </div>
                                <div class="name mt-4 align-self-center mx-auto">
                                    <h6 class="font-unicode">
                                        <?php echo $king['name']; ?>
                                    </h6>
                                    <button class="btn btn-sm theme-button king<?php echo "{$i}"; ?>" type="button"
                                            name="button" data-toggle="modal" data-target="#kmodal"><span
                                                class="ion-ios-eye"></span>
                                        View Details</button>

                                    <?php
                                    if(!$status && !$status_king) {
                                        ?>

                                        <button class="btn btn-sm theme-button king<?php echo "{$i}"; ?>" type="button"
                                                name="button" data-toggle="modal" data-target="#kvote"
                                                onclick="vote(<?php echo $i; ?>)"><span class="ion-ios-star"></span>
                                            Vote</button>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php
                            $i++;
                        }
                        ?>
                    </div>
                    <p class="mt-5"><small class="text-muted">Proudly developed by <a href="http://www.utycc.edu.mm" style="none" class="our-website" target="_blank" >UTYCC</a></small></p>
                </div>

            </div>
        </div>

        <!--Modal-->
        <div class="modal fade" id="kmodal" tabindex="-1" role="dialog" aria-labelledby="ModalTitle"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalTitle">
                            Description</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="bio text-left font-unicode">
                            <?php
                            $i = 1;
                            foreach($kings_data_arr as $kings => $king) {
                                ?>
                                <p class="king<?php echo $i; ?>-bio">
                                    Name - <?php echo $kings_data_arr["king$i"]['name']; ?>

                                </p>
                                <p class="king<?php echo $i; ?>-bio">
                                    Details - <?php echo $kings_data_arr["king$i"]['details']; ?>

                                </p>
                                <?php
                                $i++;
                            }
                            ?>
                        </div>
                        <img class="imgOne mb-2" src="" width="100%" alt="">
                        <!-- <img class="imgTwo mb-2" src="" width="100%" alt="">
                        <img class="imgThree mb-2" src="" width="100%" alt="">
                        <img class="imgFour mb-2" src="" width="100%" alt=""> -->
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="kvote" tabindex="-1" role="dialog" aria-labelledby="ModalTitle"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="ModalTitle">
                            Vote</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <form class="" action="process/vote_process.php" method="post">
                        <div class="modal-body">
                            <div class="bio text-left font-unicode">
                                <?php
                                $i = 1;
                                foreach($kings_data_arr as $kings => $king) {
                                    ?>
                                    <p class="king<?php echo $i; ?>-bio">
                                        Name - <?php echo $kings_data_arr["king$i"]['name']; ?>
                                    </p>
                                    <?php
                                    $i++;
                                }
                                ?>
                            </div>

                            <input class="hidden-value" type="text" name="" value="" hidden>
                        </div>
                        <div class="modal-footer">

                            <input type="hidden" name="vote_token" value="<?php echo $king_token; ?>">

                            <input class="btn btn-primary" type="submit" name="vote" value="Vote">

                        </div>
                        <input type="hidden" value="" name="vote_person" id="hidden">
                    </form>
                </div>
            </div>
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
    <script src="js/custom.js" charset="utf-8"></script>

    <script>
        function vote(major) {

            document.getElementById("hidden")
                .value = major;
        }
    </script>

    </html>
    <?php
}
else{
    session_destroy();
    header("location: error/404.php");
    exit();
}
?>
<!-- <span class="badge badge-pill badge-primary prek-vote-count">743</span> -->
<!-- below View Profile
                                                                             <button class="btn btn-sm theme-button ictk" type="button" name="button"
                                                                                                                    data-toggle="modal" data-target="#kvote"><span class="ion-ios-star"></span>
                                                                                                                      Vote</button> -->
