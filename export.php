<?php

// Include Database connection
include "dbconnect.php";
// Include SimpleXLSXGen library
include("SimpleXLSXGen.php");

$Application = [
  ['Application ID', 'Student Name','Roll No.', 'Enrollment No.','Course Enrolled','Father`s Name','Mother`s Name','Email','Mobile No.',
  'Alternate No.','Postal Address','Pincode',  'Receipt No.','Date of Receipt','Amount','Account No.','IFSC',
  'Passbook','Fees rec/affidavit File','Fees NoDues','Amount Due','Library NoDues','Date of Submission','Time of Submission','Amount Refunded?']
];
$lastid;
$count=0;
$sql = "SELECT * FROM iips where Amount_Refunded= 'No'; ";
$res = mysqli_query($conn, $sql);
if (mysqli_num_rows($res) > 0) {
  foreach ($res as $row) {
    $Application = array_merge($Application, array(array( $row['Application_ID'], $row['Name'], $row['ClassRollNo'], $row['EnrollmentNo'], $row['CourseEnrolled'],
     $row['Fathers_Name'], $row['Mothers_Name'], $row['Email'], $row['MobileNo'], $row['AltNo'], $row['PostalAddress'],  $row['Pincode'],
      $row['ReceiptNo'], $row['Date_Receipt'], $row['Amount'],$row['AccountNo'],$row['IFSC'],$row['Passbook'], $row['ReceiptFile'], $row['Fees_NoDues'],$row['Amount_Due'],$row['Library_NoDues'],$row['Date_of_sub'], 
      $row['Time_of_sub'], $row['Amount_Refunded'])));
      $lastid=$row["Application_ID"];
    $count=1;
  }
}
if($count==0)
{
  echo"<script>window.alert('No update!!!');</script>";
  echo"<script>window.history.back();</script>";
}
else
{
  $filename = "Caution-Money-application" . date('Ymd') . ".xlsx";
  $xlsx = SimpleXLSXGen::fromArray($Application);
  $xlsx->downloadAs($filename); // This will download the file to your local system

  // $xlsx->saveAs('Application.xlsx'); // This will save the file to your server

  $x="UPDATE iips set Amount_Refunded='Yes' 
  where Amount_Refunded='No' and Application_ID <= $lastid; ";
  $conn->query($x);
}
?>