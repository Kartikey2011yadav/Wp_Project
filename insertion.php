<?php
  include "dbconnect.php";

    function datacheck()
    {
        if(strlen($_POST["name"])>30 || strlen($_POST["father"])>30 || strlen($_POST["mother"])>30)
        {
            echo"<script>window.alert('Name should not be more than 30 characters');</script>";
            return false;
        }
        if(strlen($_POST["email"])>40)
        {
            echo"<script>window.alert('E Mail Address shouldn't exceed 40 characters');</script>";
            return false;
        }
        if(strlen($_POST["permanent"])>100 )
        {
            echo"<script>window.alert('Address should not exceed 100 characters');</script>";
            return false;
        }
        if(strlen(strval($_POST["pin"]))>6)
        {
            echo"<script>window.alert('Pincode should not exceed 6 characters');</script>";
            return false;
        }
        if(strlen(strval($_POST["alt"]))>11)
        {
            echo"<script>window.alert('Alternate No. should not exceed 11 characters');</script>";
            return false;
        }
        if(strlen(strval($_POST["amount"]))>11)
        {
            echo"<script>window.alert('Amount value limit reached!!!!');</script>";
            return false;
        }
        if(strlen(strval($_POST["mobile"]))>11 || strlen($_POST["enroll"])>10)
        {
            echo"<script>window.alert('Mobile No. should not exceed 11 character and Enrollment No. should not exceed 10 characters');</script>";
            return false;
        }
        if(strlen($_POST["roll"])>12)
        {
            echo"<script>window.alert('Roll No. should not exceed 12 characters');</script>";
            return false;
        }
        if(strlen($_POST["receipt"])>20)
        {
            echo"<script>window.alert('Receipt No. should not exceed 20 characters');</script>";
            return false;
        }
        if(!FileUplod_check()){
            echo"<script>window.alert('Coudn't upload file');</script>";
            return false;
        }
        if($_POST["sbi"] == "Yes"){
            if (!PassBook_check()) {
                echo "<script>window.alert('Coudn't upload Pass Book');</script>";
                return false;
            }
        }
        include "enrollrollcheck.php";
            if($countcheck >0){
                echo"<script>window.alert('You alredy have a running application for caution money in progress 
                or you have received your caution money ');</script>";
                return false;
            }

        return true;
    }

    function PassBook_check(){
        if ($_FILES["passBook"]["error"] !== UPLOAD_ERR_OK ) {

            switch ($_FILES["passBook"]["error"]) {
                case UPLOAD_ERR_PARTIAL:
                    echo"<script>window.alert('File only partially uploaded');</script>";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    echo"<script>window.alert('No file was uploaded');</script>";
                    break;
                case UPLOAD_ERR_EXTENSION:
                    echo"<script>window.alert('File upload stopped by a PHP extension');</script>";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    echo"<script>window.alert('File exceeds MAX_FILE_SIZE in the HTML form');</script>";
                    break;
                case UPLOAD_ERR_INI_SIZE:
                    echo"<script>window.alert('File exceeds upload_max_filesize in php.ini');</script>";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    echo"<script>window.alert('Temporary folder not found');</script>";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    echo"<script>window.alert('Failed to write file');</script>";
                    break;
                default:
                echo"<script>window.alert('Unknown upload error');</script>";
                    break;
            }
        return false;
        }

        // Reject uploaded file larger than _X_MB
        if ($_FILES["passBook"]["size"] > (1048576*5)) {
            echo"<script>window.alert('max 5Mb');</script>";
            return false;
        }

        // Use fileinfo to get the required file type
       
        $passbook_allow = array('png', 'jpg','jpeg','pdf');
        $passbook_name = $_FILES['passBook']['name'];
        $ext_passBook = pathinfo($passbook_name, PATHINFO_EXTENSION);
        
        if ( ! in_array($ext_passBook, $passbook_allow)) {
            echo"<script>window.alert('Invalid file type');</script>";
        return false;
        }

       
        return true;
    }

    //File Rename and uplode
    function PassBookuplode($AppNo){
        // Replace any characters not \w- in the original filename
        $pathinfo_pass = pathinfo($_FILES["passBook"]["name"]);

        // $base = $pathinfo_pass["passbook_name"];

        // $base = preg_replace("/[^\w-]/", "_", $base);

        $passbook_name = $AppNo . "." . $pathinfo_pass["extension"];

        $pass_dest = __DIR__ . "/PassBook_Doc/" . $passbook_name;

        
        if ( ! move_uploaded_file($_FILES["passBook"]["tmp_name"], $pass_dest)) {

           echo"<script>window.alert('Can't move uploaded Pass Book');</script>";
        
        }
   return $pass_dest;
       
   }

    //input file check
    function FileUplod_check(){
        if ($_FILES["fileToUpload"]["error"] !== UPLOAD_ERR_OK ) {

            switch ($_FILES["fileToUpload"]["error"]) {
                case UPLOAD_ERR_PARTIAL:
                    echo"<script>window.alert('File only partially uploaded');</script>";
                    break;
                case UPLOAD_ERR_NO_FILE:
                    echo"<script>window.alert('No file was uploaded');</script>";
                    break;
                case UPLOAD_ERR_EXTENSION:
                    echo"<script>window.alert('File upload stopped by a PHP extension');</script>";
                    break;
                case UPLOAD_ERR_FORM_SIZE:
                    echo"<script>window.alert('File exceeds MAX_FILE_SIZE in the HTML form');</script>";
                    break;
                case UPLOAD_ERR_INI_SIZE:
                    echo"<script>window.alert('File exceeds upload_max_filesize in php.ini');</script>";
                    break;
                case UPLOAD_ERR_NO_TMP_DIR:
                    echo"<script>window.alert('Temporary folder not found');</script>";
                    break;
                case UPLOAD_ERR_CANT_WRITE:
                    echo"<script>window.alert('Failed to write file');</script>";
                    break;
                default:
                echo"<script>window.alert('Unknown upload error');</script>";
                    break;
            }
        return false;
        }

        // Reject uploaded file larger than _X_MB
        if ($_FILES["fileToUpload"]["size"] > (1048576*5)) {
            echo"<script>window.alert('max 5Mb');</script>";
            return false;
        }

        // Use fileinfo to get the required file type
       
        $allowed = array('png', 'jpg','jpeg','pdf');
        $filename = $_FILES['fileToUpload']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        
        if ( ! in_array($ext, $allowed)) {
            echo"<script>window.alert('Invalid file type');</script>";
        return false;
        }

       
    return true;
    }

    //File Rename and uplode
    function uplodeFile($AppNo){
         // Replace any characters not \w- in the original filename
         $pathinfo = pathinfo($_FILES["fileToUpload"]["name"]);

         $base = $pathinfo["filename"];
 
         $base = preg_replace("/[^\w-]/", "_", $base);
 
         $filename = $AppNo . "." . $pathinfo["extension"];
 
         $destination = __DIR__ . "/Doc/" . $filename;
 
         
         if ( ! move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $destination)) {
 
            echo"<script>window.alert('Can't move uploaded file');</script>";
         
        }
        return $destination;
        
    }
    
    session_start();
    //Captcha code
    if(!isset($_REQUEST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response']) )
    {
        
        $error = "Please fill the captcha.";
        //you can use this error var later to show error message on your page
        echo"<script>window.alert('$error');</script>";
        echo"<script>window.history.back();</script>";
    }
    
    else if(urlencode($_REQUEST['g-recaptcha-response'])!=$_SESSION['custom_captcha'])
    {
    // $cresponse = ;
	 $error = "INVALID CAPTCHA";
	 //you can use this var to show error invalid captcha
     echo"<script>window.alert('$error');</script>";
    
     echo"<script>window.history.back();</script>";
	
    }
    //captcha code end

    else if(!datacheck())
    {
        echo"<script>window.history.back();</script>";
    }
    //data uplode surver
    else
    {
        $name=$_POST["name"];
        $fname=$_POST["father"];
        $mname=$_POST["mother"];
        $pa=$_POST["permanent"];
        $emailad=$_POST["email"];
        $pin=$_POST["pin"];
        $an=$_POST["alt"];
        $mn=$_POST["mobile"];
        $pr=filter_input(INPUT_POST,'program');
        $rn=$_POST["roll"];
        $en=$_POST["enroll"];
        $ren=$_POST["receipt"];
        $d=$_POST["date"];
        $a=$_POST["amount"];
        $dos=date("Y/m/d");
        date_default_timezone_set("Asia/Kolkata");
        $time=date("h:i:s a");
        $id;
        $accNo;
        $ifsc;

        //insertion query
        $sql="INSERT INTO IIPS (Name,Fathers_Name,Mothers_Name,PostalAddress,Email,
        Pincode,AltNo,MobileNo,CourseEnrolled,ClassRollNo,EnrollmentNo,
        ReceiptNo,Date_Receipt,Amount,Date_of_sub,Time_of_sub,Fees_NoDues,Amount_Due,Library_NoDues,Amount_Refunded) 
        values ('$name','$fname','$mname','$pa','$emailad',$pin,$an,$mn,'$pr','$rn','$en',
        '$ren','$d',$a,'$dos','$time','NA','0','NA','No');";
        $result=$conn->query($sql);

        if($result)
        {
            
            echo"<script>window.alert('Data stored successfully');</script>";
            $appquery="SELECT Application_ID from iips where Date_of_sub = '$dos' and Time_of_sub = '$time';";
            $appid=$conn->query($appquery);

            while($row=$appid->fetch_assoc())
            {
                $id=$row["Application_ID"];
                // echo"<script>window.alert('Your Application ID is: $id . Kindly keep it safe for further usage!!!!');</script>";
            }

            //File uplode at Doc folder and address of file insertion in data base
            $FileAdd_=uplodeFile($id);
            $File = "UPDATE iips set ReceiptFile='$FileAdd_' where Application_ID=$id;";
            $insertAdd = $conn->query($File);

            if($_POST["sbi"] == "Yes"){
                $accNo = $_POST["acc_no"];
                $ifsc = $_POST["ifsc"];
    
                 //Pass Book uplode at PassBook_Doc folder and address of file insertion in data base
                 $passbook_add=PassBookuplode($id);
                 
                 $sbi_ac = "UPDATE iips set AccountNo='$accNo' where Application_ID=$id;";
                 $insertsbi_ac = $conn->query($sbi_ac);
                 $sbi_ifsc = "UPDATE iips set IFSC='$ifsc' where Application_ID=$id;";
                 $insertsbi_ifsc = $conn->query($sbi_ifsc);
                 $sbi_pass = "UPDATE iips set Passbook='$passbook_add' where Application_ID=$id;";
                 $insertsbi_pass = $conn->query($sbi_pass);

            }
            if($_POST["sbi"] == "No"){
                $accNo = "NA";
                $ifsc = "NA";
                $passbook_add="NA";
                 
                 $sbi_ac = "UPDATE iips set AccountNo='$accNo' where Application_ID=$id;";
                 $insertsbi_ac = $conn->query($sbi_ac);
                 $sbi_ifsc = "UPDATE iips set IFSC='$ifsc' where Application_ID=$id;";
                 $insertsbi_ifsc = $conn->query($sbi_ifsc);
                 $sbi_pass = "UPDATE iips set Passbook='$passbook_add' where Application_ID=$id;";
                 $insertsbi_pass = $conn->query($sbi_pass);

            }

            include "confirmation.php";
            include "Confirmation_email.php";
            
            // echo"<script>window.history.back();</script>";     
        }
        else
        {

            echo"$conn->error";
        }
    }