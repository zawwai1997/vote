<?php

require_once '../core/init.php';

if(
    isset($_POST['vote']) && 
    isset($_SESSION['vote_token']) && 
    $_SESSION['vote_token'] == $_POST['vote_token']) {
   
        $voted_person = $_POST['vote_person'];

        $token = $_SESSION['token'];

        if(isset($_SESSION['vote_person']) && $_SESSION['vote_person'] == 'king') {
            $table = 'kings';
            $elected_obj = 'is_king_voted';
            unset($_SESSION['vote_person']);
        } else if(isset($_SESSION['vote_person']) && $_SESSION['vote_person'] == 'queen') {
            $table = 'queens';
            $elected_obj = 'is_queen_voted';
            unset($_SESSION['vote_person']);
        }
        if($vote->hasVotingClosed()){   //Voting is closed
            flash('fail', "Sorry! <br> Voting has been closed.<br>");
            header("location: ../" . $table . ".php?id=$token&status=true");
            exit;
        }else{
            $boolean = $vote->updateVoteCount($table, $voted_person);
        }



        
        if($boolean == true)
        {
            $boo = $vote->userVote('person', $elected_obj, $_SESSION['loginCode']);
            
            if($boo == true)
            {
                flash('success', "Congratulations! <br> You've successfully voted.");
                header("location: ../" . $table . ".php?id=$token&status=true");
                exit;
            }
            else{
                header("location: ../" . $table . ".php?id=$token&status=error1");
                exit;
            }
   }
   else
    {
        header("location: kings.php?id=$token&status=error");
   }

}
else if(isset($_POST['queenVote']))
{
    $_POST['vote_major'];
    $vote_major= $_POST['vote_major'];

    $table= "king_queen";
    $id=1;
    $token =$_SESSION['token'];
    $boolean= $vote->updateVoteCount($table,$vote_major);
    if($boolean==true)
    {
        $roll= $_SESSION['user_roll'];   //4IST-59
        $user_id =$_SESSION['user_id'];


        $table = substr($roll, 0, 1) . "student";
        if($_SESSION['user_roll']=='teacher')
        {
            $table="teacher";

        }

        $status="status_queen";
        $boo= $vote->userVote($table,$status,$user_id);
        if($boo==true)
        {
            header("location: queens.php?id=$token&status=true");
        }
        else{
            header("location: queens.php?id=$token&status=error1");
        }

    }
    else
    {
        header("location: queens.php?id=$token&status=error");
    }
}

else {
    session_destroy();
    header("location: error/404.php");
    exit();
}
?>