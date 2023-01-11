<?php
include "dbconnect.php";

$course;
$fdate;
$tdate;
$process;
$sql="SELECT * from iips;";

// if(!empty($_POST["Course"]))
// {
//     $course=$_POST["Course"];
//     $sql="SELECT * from iips where Program = '$course';";
//     if(!empty($_POST["FromDate"]))
//     {
//         $fdate=$_POST["FromDate"];
//         $sql="SELECT * from iips where Program = '$course' and Date_of_sub >= '$fdate';";
//         if(!empty($_POST["ToDate"]))
//         {
//             $tdate=$_POST["ToDate"];
//             $sql="SELECT * from iips where Program='$course' and Date_of_sub between '$fdate' and '$tdate';";
//         }
//     }
//     else
//     {
//         if(!empty($_POST["ToDate"]))
//         {
//             $tdate=$_POST["ToDate"];
//             $sql="SELECT * from iips where Program = '$course' and Date_of_sub <= '$tdate';";
//         }
//     }
// }
// else if(!empty($_POST["Process"]))
// {
//     $process=$_POST["Process"];
//     $sql="SELECT * from iips where Amount_Refunded = '$process';";
//     if(!empty($_POST["FromDate"]))
//     {
//         $fdate=$_POST["FromDate"];
//         $sql="SELECT * from iips where Amount_Refunded = '$process' and Date_of_sub >= '$fdate';";
//         if(!empty($_POST["ToDate"]))
//         {
//             $tdate=$_POST["ToDate"];
//             $sql="SELECT * from iips where Amount_Refunded = '$process' and Date_of_sub between '$fdate' and '$tdate';";
//         }
//     }
//     else
//     {
//         if(!empty($_POST["ToDate"]))
//         {
//             $tdate=$_POST["ToDate"];
//             $sql="SELECT * from iips where Amount_Refunded = '$process' and Date_of_sub <= '$tdate';";
//         }
//     }
// }
// else if(!empty($_POST["FromDate"]))
// {
//     $fdate=$_POST["FromDate"];
//     $sql="SELECT * from iips where Date_of_sub >= '$fdate';";
//     if(!empty($_POST["ToDate"]))
//     {
//         $tdate=$_POST["ToDate"];
//         $sql="SELECT * from iips where Date_of_sub between '$fdate' and '$tdate';";
//     }
// }
// else if(!empty($_POST["ToDate"]))
// {
//     $tdate=$_POST["ToDate"];
//     $sql="SELECT * from iips where Date_of_sub <= '$tdate';";
// }


if($_POST["que"]=="Yes" && !empty($_POST["FromDate"]) && !empty($_POST["ToDate"]) && !empty($_POST["Process"]))
{
    $course=filter_input(INPUT_POST,"enrolled");
    $fdate=$_POST["FromDate"];
    $tdate=$_POST["ToDate"];
    $process=$_POST["Process"];
    $sql=CourseFromToProcess($course,$fdate,$tdate,$process);
}

if($_POST["que"]=="Yes" && empty($_POST["FromDate"]) && !empty($_POST["ToDate"]) && !empty($_POST["Process"]))
{
    $course=filter_input(INPUT_POST,"enrolled");
    $tdate=$_POST["ToDate"];
    $process=$_POST["Process"];
    $sql=CourseNotFromToProcess($course,$tdate,$process);
}

if($_POST["que"]=="Yes" && !empty($_POST["FromDate"]) && empty($_POST["ToDate"]) && !empty($_POST["Process"]))
{
    $course=filter_input(INPUT_POST,"enrolled");
    $fdate=$_POST["FromDate"];
    $process=$_POST["Process"];
    $sql=CourseFromNotToProcess($course,$fdate,$process);
}

if($_POST["que"]=="Yes" && !empty($_POST["FromDate"]) && !empty($_POST["ToDate"]) && empty($_POST["Process"]))
{
    $course=filter_input(INPUT_POST,"enrolled");
    $fdate=$_POST["FromDate"];
    $tdate=$_POST["ToDate"];
    $sql=CourseFromToNotProcess($course,$fdate,$tdate);
}

if($_POST["que"]=="No" && !empty($_POST["FromDate"]) && !empty($_POST["ToDate"]) && !empty($_POST["Process"]))
{
    $fdate=$_POST["FromDate"];
    $tdate=$_POST["ToDate"];
    $process=$_POST["Process"];
    $sql=NotCourseFromToProcess($fdate,$tdate,$process);
}

if($_POST["que"]=="No" && empty($_POST["FromDate"]) && !empty($_POST["ToDate"]) && !empty($_POST["Process"]))
{
    $tdate=$_POST["ToDate"];
    $process=$_POST["Process"];
    $sql=NotCourseNotFromToProcess($tdate,$process);
}

if($_POST["que"]=="No" && !empty($_POST["FromDate"]) && empty($_POST["ToDate"]) && !empty($_POST["Process"]))
{
    $fdate=$_POST["FromDate"];
    $process=$_POST["Process"];
    $sql=NotCourseFromNotToProcess($fdate,$process);
}

if($_POST["que"]=="No" && !empty($_POST["FromDate"]) && !empty($_POST["ToDate"]) && empty($_POST["Process"]))
{
    $fdate=$_POST["FromDate"];
    $tdate=$_POST["ToDate"];
    $sql=NotCourseFromToNotProcess($fdate,$tdate);
}

if($_POST["que"]=="Yes" && empty($_POST["FromDate"]) && empty($_POST["ToDate"]) && !empty($_POST["Process"]))
{
    $course=filter_input(INPUT_POST,"enrolled");
    $process=$_POST["Process"];
    $sql=CourseNotFromNotToProcess($course,$process);
}

if($_POST["que"]=="Yes" && empty($_POST["FromDate"]) && !empty($_POST["ToDate"]) && empty($_POST["Process"]))
{
    $course=filter_input(INPUT_POST,"enrolled");
    $tdate=$_POST["ToDate"];
    $sql=CourseNotFromToNotProcess($course,$tdate);
}

if($_POST["que"]=="Yes" && !empty($_POST["FromDate"]) && empty($_POST["ToDate"]) && empty($_POST["Process"]))
{
    $course=filter_input(INPUT_POST,"enrolled");
    $fdate=$_POST["FromDate"];
    $sql=CourseFromNotToNotProcess($course,$fdate);
}

if($_POST["que"]=="No" && empty($_POST["FromDate"]) && empty($_POST["ToDate"]) && !empty($_POST["Process"]))
{
    $process=$_POST["Process"];
    $sql=NotCourseNotFromNotToProcess($process);
}

if($_POST["que"]=="No" && empty($_POST["FromDate"]) && !empty($_POST["ToDate"]) && empty($_POST["Process"]))
{
    $tdate=$_POST["ToDate"];
    $sql=NotCourseNotFromToNotProcess($tdate);
}

if($_POST["que"]=="No" && !empty($_POST["FromDate"]) && empty($_POST["ToDate"]) && empty($_POST["Process"]))
{
    $fdate=$_POST["FromDate"];
    $sql=NotCourseFromNotToNotProcess($fdate);
}

if($_POST["que"]=="Yes" && empty($_POST["FromDate"]) && empty($_POST["ToDate"]) && empty($_POST["Process"]))
{
    $course=filter_input(INPUT_POST,"enrolled");
    $sql=CourseNotFromNotToNotProcess($course);
}

function CourseFromToProcess($c,$f,$t,$p)
{
    $s="SELECT * from iips where CourseEnrolled='$c' and Date_of_sub between '$f' and '$t' and Amount_Refunded='$p';";
    return $s;
}

function CourseNotFromToProcess($c,$t,$p)
{
    $s="SELECT * from iips where CourseEnrolled='$c' and Date_of_sub<='$t' and Amount_Refunded='$p';";
    return $s;
}

function CourseFromNotToProcess($c,$f,$p)
{
    $s="SELECT * from iips where CourseEnrolled='$c' and Date_of_sub>='$f' and Amount_Refunded='$p';";
    return $s;
}

function CourseFromToNotProcess($c,$f,$t)
{
    $s="SELECT * from iips where CourseEnrolled='$c' and Date_of_sub between '$f' and '$t';";
    return $s;
}

function NotCourseFromToProcess($f,$t,$p)
{
    $s="SELECT * from iips where Date_of_sub between '$f' and '$t' and Amount_Refunded='$p';";
    return $s;
}

function NotCourseNotFromToProcess($t,$p)
{
    $s="SELECT * from iips where Date_of_sub<='$t' and Amount_Refunded='$p';";
    return $s;
}

function NotCourseFromNotToProcess($f,$p)
{
    $s="SELECT * from iips where Date_of_sub>='$f' and Amount_Refunded='$p';";
    return $s;
}

function NotCourseFromToNotProcess($f,$t)
{
    $s="SELECT * from iips where Date_of_sub between '$f' and '$t';";
    return $s;
}

function CourseNotFromNotToProcess($c,$p)
{
    $s="SELECT * from iips where CourseEnrolled='$c' and Amount_Refunded='$p';";
    return $s;
}

function CourseNotFromToNotProcess($c,$t)
{
    $s="SELECT * from iips where CourseEnrolled='$c' and Date_of_sub<='$t';";
    return $s;
}

function CourseFromNotToNotProcess($c,$f)
{
    $s="SELECT * from iips where CourseEnrolled='$c' and Date_of_sub>='$f';";
    return $s;
}

function NotCourseNotFromNotToProcess($p)
{
    $s="SELECT * from iips where Amount_Refunded='$p';";
    return $s;
}

function NotCourseNotFromToNotProcess($t)
{
    $s="SELECT * from iips where Date_of_sub<='$t';";
    return $s;
}

function NotCourseFromNotToNotProcess($f)
{
    $s="SELECT * from iips where Date_of_sub>='$f';";
    return $s;
}

function CourseNotFromNotToNotProcess($c)
{
    $s="SELECT * from iips where CourseEnrolled='$c';";
    return $s;
}



$result = $conn->query($sql);

if($result)
{
    echo "<h3 style='font-size:xx-large;'>Students` Details</h3>
    <table class='table table-striped table-dark table-bordered table-responsive'>
    <tr>
    <th align='center'>Application ID</th>
    <th align='center'>Student`s Name</th>
    <th align='center'>Father`s Name</th>
    <th align='center'>Mother`s Name</th>
    <th align='center'>Postal Address</th>
    <th align='center'>Email</th>
    <th align='center'>Pincode</th>
    <th align='center'>Mobile No.</th>
    <th align='center'>Alternate No.</th>
    <th align='center'>Course Enrolled</th>
    <th align='center'>Roll No.</th>
    <th align='center'>Enrollment No.</th>
    <th align='center'>Account no.</th>
    <th align='center'>IFSC Code</th>
    <th align='center'>Passbook</th>
    <th align='center'>Receipt No.</th>
    <th align='center'>Date of Receipt</th>
    <th align='center'>Amount</th>
    <th align='center'>Fees Receipt or Affidavit</th>
    <th align='center'>Fees NoDues</th>
    <th align='center'>Amount Due</th>
    <th align='center'>Library NoDues</th>
    <th align='center'>Process</th>
    <th align='center'>Date of Submission</th>
    <th align='center'>Time of Submission</th>
    <th align='center'>Amount Refunded?</th>
    </tr>";
    while($row=$result->fetch_assoc())
    {
        echo"<tr>
        <td align='center'>".$row["Application_ID"]."</td>
        <td align='center'>".$row["Name"]."</td>
        <td align='center'>".$row["Fathers_Name"]."</td>
        <td align='center'>".$row["Mothers_Name"]."</td>
        <td align='center'>".$row["PostalAddress"]."</td>
        <td align='center'>".$row["Email"]."</td>
        <td align='center'>".$row["Pincode"]."</td>
        <td align='center'>".$row["MobileNo"]."</td>
        <td align='center'>".$row["AltNo"]."</td>
        <td align='center'>".$row["CourseEnrolled"]."</td>
        <td align='center'>".$row["ClassRollNo"]."</td>
        <td align='center'>".$row["EnrollmentNo"]."</td>
        <td align='center'>".$row["AccountNo"]."</td>
        <td align='center'>".$row["IFSC"]."</td>
        <td align='center'>".$row["Passbook"]."</td>
        <td align='center'>".$row["ReceiptNo"]."</td>
        <td align='center'>".$row["Date_Receipt"]."</td>
        <td align='center'>".$row["Amount"]."</td>
        <td align='center'>".$row["ReceiptFile"]."</td>
        <td align='center'>".$row["Fees_NoDues"]."</td>
        <td align='center'>".$row["Amount_Due"]."</td>
        <td align='center'>".$row["Library_NoDues"]."</td>
        <td align='center'>".$row["Amount_Refunded"]."</td>
        <td align='center'>".$row["Date_of_sub"]."</td>
        <td align='center'>".$row["Time_of_sub"]."</td>
        <td align='center'>".$row["Amount_Refunded"]."</td>
        </tr>";
    }
    echo"</table>";
}
?>