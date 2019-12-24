<?php
 require_once 'core/init.php';

$permitted_chars = '23456789abcdefghijkmnpqrstuvwxyz';
// Output: 54esmdr0qf
$code="";
for($i=1;$i<101;$i++){
    $mycode=substr(str_shuffle($permitted_chars), 0, 6);
    $hashCode=hash("sha512", $mycode);
    $user->insert($hashCode);

    $code.= "\n\n".$i."\t\t".$mycode."\n\n";
    $code.="----------------------------------------------------------------------";

    $myfile = fopen("6ict.txt", "w") or die("Unable to open file!");
    fwrite($myfile, $code);
}




fclose($myfile);

?>