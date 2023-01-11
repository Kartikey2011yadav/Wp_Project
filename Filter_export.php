<?php

include "dbconnect.php";

$course;
$fdate;
$tdate;
$process;
$sql="SELECT * from iips;";

if($_POST["que_d"]=="Yes" && !empty($_POST["FromDate"]) && !empty($_POST["ToDate"]) && !empty($_POST["Process"]))
{
    $course=filter_input(INPUT_POST,"enrolled");
    $fdate=$_POST["FromDate"];
    $tdate=$_POST["ToDate"];
    $process=$_POST["Process"];
    $sql=CourseFromToProcess($course,$fdate,$tdate,$process);
}

if($_POST["que_d"]=="Yes" && empty($_POST["FromDate"]) && !empty($_POST["ToDate"]) && !empty($_POST["Process"]))
{
    $course=filter_input(INPUT_POST,"enrolled");
    $tdate=$_POST["ToDate"];
    $process=$_POST["Process"];
    $sql=CourseNotFromToProcess($course,$tdate,$process);
}

if($_POST["que_d"]=="Yes" && !empty($_POST["FromDate"]) && empty($_POST["ToDate"]) && !empty($_POST["Process"]))
{
    $course=filter_input(INPUT_POST,"enrolled");
    $fdate=$_POST["FromDate"];
    $process=$_POST["Process"];
    $sql=CourseFromNotToProcess($course,$fdate,$process);
}

if($_POST["que_d"]=="Yes" && !empty($_POST["FromDate"]) && !empty($_POST["ToDate"]) && empty($_POST["Process"]))
{
    $course=filter_input(INPUT_POST,"enrolled");
    $fdate=$_POST["FromDate"];
    $tdate=$_POST["ToDate"];
    $sql=CourseFromToNotProcess($course,$fdate,$tdate);
}

if($_POST["que_d"]=="No" && !empty($_POST["FromDate"]) && !empty($_POST["ToDate"]) && !empty($_POST["Process"]))
{
    $fdate=$_POST["FromDate"];
    $tdate=$_POST["ToDate"];
    $process=$_POST["Process"];
    $sql=NotCourseFromToProcess($fdate,$tdate,$process);
}

if($_POST["que_d"]=="No" && empty($_POST["FromDate"]) && !empty($_POST["ToDate"]) && !empty($_POST["Process"]))
{
    $tdate=$_POST["ToDate"];
    $process=$_POST["Process"];
    $sql=NotCourseNotFromToProcess($tdate,$process);
}

if($_POST["que_d"]=="No" && !empty($_POST["FromDate"]) && empty($_POST["ToDate"]) && !empty($_POST["Process"]))
{
    $fdate=$_POST["FromDate"];
    $process=$_POST["Process"];
    $sql=NotCourseFromNotToProcess($fdate,$process);
}

if($_POST["que_d"]=="No" && !empty($_POST["FromDate"]) && !empty($_POST["ToDate"]) && empty($_POST["Process"]))
{
    $fdate=$_POST["FromDate"];
    $tdate=$_POST["ToDate"];
    $sql=NotCourseFromToNotProcess($fdate,$tdate);
}

if($_POST["que_d"]=="Yes" && empty($_POST["FromDate"]) && empty($_POST["ToDate"]) && !empty($_POST["Process"]))
{
    $course=filter_input(INPUT_POST,"enrolled");
    $process=$_POST["Process"];
    $sql=CourseNotFromNotToProcess($course,$process);
}

if($_POST["que_d"]=="Yes" && empty($_POST["FromDate"]) && !empty($_POST["ToDate"]) && empty($_POST["Process"]))
{
    $course=filter_input(INPUT_POST,"enrolled");
    $tdate=$_POST["ToDate"];
    $sql=CourseNotFromToNotProcess($course,$tdate);
}

if($_POST["que_d"]=="Yes" && !empty($_POST["FromDate"]) && empty($_POST["ToDate"]) && empty($_POST["Process"]))
{
    $course=filter_input(INPUT_POST,"enrolled");
    $fdate=$_POST["FromDate"];
    $sql=CourseFromNotToNotProcess($course,$fdate);
}

if($_POST["que_d"]=="No" && empty($_POST["FromDate"]) && empty($_POST["ToDate"]) && !empty($_POST["Process"]))
{
    $process=$_POST["Process"];
    $sql=NotCourseNotFromNotToProcess($process);
}

if($_POST["que_d"]=="No" && empty($_POST["FromDate"]) && !empty($_POST["ToDate"]) && empty($_POST["Process"]))
{
    $tdate=$_POST["ToDate"];
    $sql=NotCourseNotFromToNotProcess($tdate);
}

if($_POST["que_d"]=="No" && !empty($_POST["FromDate"]) && empty($_POST["ToDate"]) && empty($_POST["Process"]))
{
    $fdate=$_POST["FromDate"];
    $sql=NotCourseFromNotToNotProcess($fdate);
}

if($_POST["que_d"]=="Yes" && empty($_POST["FromDate"]) && empty($_POST["ToDate"]) && empty($_POST["Process"]))
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


$Application = [
  ['Application ID', 'Student Name','Class Roll No','Enrollment No','Course Enrolled', 'Fathers Name', 'Mothers Name', 'Email','Mobile No',
  'Alternate No','Postal Address','Pincode', 'Receipt No','Date of Receipt','Amount','SBI Account No','IFSC code','PassBook File',
  'Fees rec/affidavit File','Date of sub','Time of sub','Amount Refunded']
];


$result_d = $conn->query($sql);

// $result_d = $sql_query;
// if (mysqli_num_rows($result_d) > 0) {
//   foreach ($result_d as $ele) {
//     $Application = array_merge($Application, array(array( $ele['Application_ID'], $ele['Name'], $ele['ClassRollNo'], $ele['EnrollmentNo'], $ele['CourseEnrolled'],
//      $ele['Fathers_Name'], $ele['Mothers_Name'], $ele['Email'], $ele['MobileNo'], $ele['AltNo'], $ele['PostalAddress'],  $ele['Pincode'],
//       $ele['ReceiptNo'], $ele['Date_Receipt'], $ele['Amount'],$ele['AccountNo'],$ele['IFSC'],$ele['Passbook'], $ele['ReceiptFile'], $ele['Date_of_sub'], $ele['Time_of_sub'], $ele['Amount_Refunded'])));
//       $lastid=$ele["Application_ID"];
//     $count=1;
//   }
// }

if(! $result_d){
  echo"<script>window.alert('No update!!!');</script>";
}

while($ele=$result_d->fetch_assoc()){
  $Application = array_merge($Application, array(array( $ele['Application_ID'], $ele['Name'], $ele['ClassRollNo'], $ele['EnrollmentNo'], 
  $ele['CourseEnrolled'],$ele['Fathers_Name'], $ele['Mothers_Name'], $ele['Email'], $ele['MobileNo'], $ele['AltNo'], $ele['PostalAddress'],
  $ele['Pincode'],$ele['ReceiptNo'], $ele['Date_Receipt'], $ele['Amount'],$ele['AccountNo'],$ele['IFSC'],$ele['Passbook'], $ele['ReceiptFile'],
  $ele['Date_of_sub'], $ele['Time_of_sub'], $ele['Amount_Refunded'])));$lastid=$ele["Application_ID"];
 $count=1;
}

if($count==0)
{
  echo"<script>window.alert('No update!!!');</script>";
  echo"<script>window.history.back();</script>";
}
else
{

// // Include SimpleXLSXGen library
include("SimpleXLSXGen.php");

$filename = "Caution_Filter_Download" . date('Ymd') . ".xlsx";
$xlsx = SimpleXLSXGen::fromArray($Application);
$xlsx->downloadAs($filename); // This will download the file to your local system

// // $xlsx->saveAs('Application.xlsx'); // This will save the file to your server

  
}
?>

