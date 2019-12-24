<?php

include("../core/init.php");
$table='kings';
$attr= 'vote_count';
$count= $vote->allCount($table,$attr);
$totalCount =$count[0][0];

$maxDatas =$vote->getDataFromMaximun($table,$attr,5);




    ?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <title>VOT</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta HTTP-EQUIV="refresh" CONTENT="2">
        <!--===============================================================================================-->
        <!-- Main Style Css -->
        <link rel="stylesheet" href="css/tailwind.min.css">

        <link rel="stylesheet" href="css/index.css">
        <!--===============================================================================================-->
    </head>

    <body>

    <div class=" w-11/12 border-2 mx-auto my-12  rounded-lg shadow-lg p-3">
        <h1 class="text-center text-3xl font-bold">Voting Result</h1>


        <div class="mx-auto my-4 p-3 ">
            <?php
            $i =1;
            foreach($maxDatas as $key => $project) {

                ?>

                <div class="bg-white w-full mx-auto my-4 rounded-lg shadow-md px-3 border-2">
                    <section class="flex p-2">
                        <h2 class="w-1/12"><?php echo $i?>.</h2>
                        <span class="w-11/12"><h2 class="text-center text-xl"><?php echo $project['name'] ?></h2></span>
                        <span class="w-1/12"><h2
                                class=" w-7/12 bg-blue-500 px-3 text-sm rounded-lg text-white"><?php echo round((100/$totalCount)*$project['vote_count'])?>%</h2></span>
                    </section>
                    <div>
                        <div class="w3-progress-container w3-round-xlarge mb-4 ">
                            <div class="w3-progressbar w3-round-xlarge " style="width:<?php echo round((100/$totalCount)*$project['vote_count'])?>%"></div>
                        </div>
                    </div>

                </div>
                <?php
                $i++;
            }
 ?>


        </div>

    </body>

    </html>
    <?php

    ?>
