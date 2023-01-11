<?php
include "dbconnect.php";

$count=0;
$response;$appid;
if(!empty($_POST["resp"]) && !empty($_POST["app"]))
{
    $response=filter_input(INPUT_POST,"resp");
    $appid=$_POST["app"];
}
else
{
    $count=1;
}

if($count==0)
{
    $s="UPDATE iips set Library_NoDues = '$response' where Application_ID = $appid;";
    $res=$conn->query($s);
    if($res)
    {
        echo"<script>window.location.reload();</script>";
    }
}
?>