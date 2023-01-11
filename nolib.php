<?php
include "dbconnect.php";
$id=$_POST["appid"];
$s="UPDATE iips set Library_NoDues = 'No' where Application_ID = $id;";
if($s)
{
    echo"<script>window.history.back();</script>";
}
?>