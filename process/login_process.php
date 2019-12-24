<?php

require_once '../core/init.php';

if (isset($_POST['btnLogin']) && $_POST['tok'] == $_SESSION['token']) {


    $code = $user->checkInput($_POST['loginCode']);
    $code = hash("sha512", $code);

    $table = "person";

    $rowCount = $user->login($table, "generate_code", $code);
    
    global $pre;
    if ($rowCount == 1)
    {   // login success
        $_SESSION['loginCode'] = $code;
        header("location: ../index.php?id=$_POST[tok]");
        exit();
    } else {   
        //login fail
        header("location: ../login.php");
        $_SESSION['ERROR']['pswErr'] = "Check your Code again";
        exit();
    }

} else {
    session_destroy();
    header("location: error/404.php");
    exit();

}