<?php
    include "dbconnect.php";
    session_start();
    $count=0;

     //Captcha code
     if(!isset($_REQUEST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response']) )
     {
         
         $error = "Please fill the captcha.";
         //you can use this error var later to show error message on your page
         echo"<script>window.alert('$error');</script>";
         $count = 1;
         echo"<script>window.history.back();</script>";
     }
     
     else if(urlencode($_REQUEST['g-recaptcha-response'])!=$_SESSION['custom_captcha'])
     {
     // $cresponse = ;
      $error = "INVALID CAPTCHA";
      //you can use this var to show error invalid captcha
      echo"<script>window.alert('$error');</script>";
      $count = 1;
      echo"<script>window.history.back();</script>";
     
     }
    //captcha code end

 
    $u=$_POST["Username"];
    $p=$_POST["Password"];
    $sql="SELECT * from admin;";
    $result=$conn->query($sql);
    if($result && $count == 0)
    {
        
        while($row=$result->fetch_assoc())
        {
            if($row["Username"]==$u && $row["Password"]==$p)
            {
                $count_n=1;
                break;
            }
        }
        
        include "ajax.html";
        
        if($count_n==1)
        {
            $disp="SELECT * from iips;";
            $display=$conn->query($disp);
            echo"
            <center>
            <div id='prev' style='font-family: Lucida Console; font-size:small; '>
            <h3 style='font-size:xx-large;'>Students` Details</h3>
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
            while($row=$display->fetch_assoc())
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
            echo"</table>
                </div>
                </center>";
        }
        else
        {
            echo"<script>window.alert('Enter correct credentials');</script>";
            echo"<script>window.history.back();</script>";
        }
    }
?>