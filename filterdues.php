<?php
    include "dbconnect.php";

    $libdues=filter_input(INPUT_POST,"libdues");
    $accdues=filter_input(INPUT_POST,"accdues");

    $s;
    if($libdues=="Don`t Filter" && $accdues=="Don`t Filter")
    {
        $s="SELECT * from iips;";
    }
    if($libdues=="Don`t Filter" && $accdues!="Don`t Filter")
    {
        $s="SELECT * from iips where Fees_NoDues = '$accdues'";
    }
    if($libdues!="Don`t Filter" && $accdues=="Don`t Filter")
    {
        $s="SELECT * from iips where Library_NoDues = '$libdues'";
    }
    if($libdues!="Don`t Filter" && $accdues!="Don`t Filter")
    {
        $s="SELECT * from iips where Library_NoDues = '$libdues' and Fees_NoDues = '$accdues';";
    }

    $res=$conn->query($s);
    if($res)
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
        while($row=$res->fetch_assoc())
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