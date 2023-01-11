<?php
include "dbconnect.php";
$checkq="SELECT * from iips;";
$checkedq=$conn->query($checkq);
if($checkedq)
{
    $countcheck=0;
    while($r=$checkedq->fetch_assoc())
    {
        if($r["EnrollmentNo"]==$_POST["enroll"] && $r["ClassRollNo"]==$_POST["roll"])
        {
            $countcheck=1;
        }
    }
}
?>