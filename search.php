<?php
include "dbconnect.php";
$col=filter_input(INPUT_POST,"c");
$data=$_POST["d"];
if($col=="Application ID") $column="Application_ID";
if($col=="Student`s Name") $column="Name";
if($col=="Father`s Name") $column="Fathers_Name";
if($col=="Mother`s Name") $column="Mothers_Name";
if($col=="Postal Address") $column="PostalAddress";
if($col=="Email") $column="Email";
if($col=="Pincode") $column="Pincode";
if($col=="Mobile No.") $column="MobileNo";
if($col=="Alternate No.") $column="AltNo";
if($col=="Course Enrolled") $column="CourseEnrolled";
if($col=="Roll No.") $column="ClassRollNo";
if($col=="Enrollment No.") $column="EnrollmentNo";
if($col=="Receipt No.") $column="ReceiptNo";
if($col=="Date of Receipt") $column="Date_Receipt";
if($col=="Amount") $column="Amount";
if($col=="Process") $column="Amount_Refunded";
if($col=="Date of Submission") $column="Date_of_sub";
if($col=="Time of Submission") $column="Time_of_sub";
$sql="SELECT * from iips where $column='$data'";
$result=$conn->query($sql);
if($result)
{
    echo "<h3 style='font-size:xx-large;'>Students` Information</h3>
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
else
{
    echo"<script>window.alert('Enter correct column and data!!!')</script>";
    echo"<script>window.location.reload();</script>";
}
?>