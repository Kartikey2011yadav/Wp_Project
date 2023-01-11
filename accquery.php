<?php
include "dbconnect.php";

$count=0;
$response;$appid;$amt;
$flag=0;
if(!empty($_POST["resp"]) && !empty($_POST["app"]))
{
    $response=filter_input(INPUT_POST,"resp");
    $appid=$_POST["app"];
    if($response=='Yes')
    {
        $amt=$_POST["amtdue"];
        $flag=1;
    }
}
else
{
    $count=1;
}

if($count==0)
{
    $s;
    if($flag==0)
    {
        $s="UPDATE iips set Fees_NoDues = '$response' where Application_ID = $appid;";
    }
    if($flag==1)
    {
        $s="UPDATE iips set Fees_NoDues = '$response' , Amount_Due = $amt where Application_ID = $appid;";
    }
    $res=$conn->query($s);
    if($res)
    {
        echo"<script>window.location.reload();</script>";
    }
    else
    {
        echo"$conn->error";
    }
}
?>