<?php
include "dbconnect.php";
$appid=$_POST["appid"];
$enroll=$_POST["enrollment"];
$sql="SELECT * from iips where Application_ID = $appid and EnrollmentNo = '$enroll';";
$result=$conn->query($sql);
$response;
if($result)
{
    while($row=$result->fetch_assoc())
    {
        $response=$row["Amount_Refunded"];
        $feesDue = $row["Fees_NoDues"];
        $libDue = $row["Library_NoDues"];
    }
    if($response!=null && $feesDue!=null && $libDue!=null)
    {
        if($feesDue=='NA'){
            echo"<script>window.alert('Your application is on hold, the account department has not responded to your query yet');</script>";
            echo"<script>window.location.reload();</script>";
        }
        
        else if($feesDue=='Yes'){
            echo"<script>window.alert('Your application is on hold, Kindly clear your dues and contact fees department for more details!!!');</script>";
            echo"<script>window.location.reload();</script>";
        }

        if($libDue=='NA'){
            echo"<script>window.alert('Your application is on hold, the library department has not responded to your query yet');</script>";
            echo"<script>window.location.reload();</script>";
        }

        else if($libDue=='Yes'){
            echo"<script>window.alert('Your application is on hold, Kindly clear your dues and contact Library department for more details!!!');</script>";
            echo"<script>window.location.reload();</script>";
        }
        
        else if($response=='No')
        {
            echo"<script>window.alert('Your request for caution money is still in process!!!');</script>";
            echo"<script>window.location.reload();</script>";
        }

        else if($response=='Yes')
        {
            echo"<script>window.alert('Your request for caution money is accepted and money is been transferred!!!');</script>";
            echo"<script>window.location.reload();</script>";
        }

    }
    else
    {
        echo"<script>window.alert('Enter correct Application ID and Enrollment No.!!!!');</script>";
        echo"<script>window.location.reload();</script>";
    }
}
else
{
    echo"$conn->error";
}
?>