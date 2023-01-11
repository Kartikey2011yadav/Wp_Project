<?php
$now=date("d/m/Y");
$mid_if = "";
$head="
    <html>
    <head>
    <style type='text/css' media='print'>
        @page { size: landscape; }
    </style>
    </head>    
    <body>
    <!------------------------------LOGO-------------------------------------------------------->
    <img src='davv_logo.png' alt='davv logo' style='position:absolute; top: 20px; left: 30px;' width='140px' height='140px;'>
    <div style='position:relative; left: 500px; bottom: 5px;font-size: 20px;'>
        <h1 style='font-family: monospace;'>International Institute</h1>
        <h2 style='font-family: monospace; position: relative; left: 60px; bottom: 25px;'>of Professional Studies</h2>
        <h2 style='font-family: monospace; position: relative; left:25px; bottom: 30px;'>Devi Ahilya Vishwavidyalaya</h2>
        <h3 style='font-family: monospace; position: relative; left:100px; bottom: 35px;'>Indore, Madhya Pradesh</h3>
    </div>
    <img src='iips_logo.png' alt='iips logo' style='position: relative; left: 1310px; bottom:230px;' width='140px' height='140px;'>

    <hr style='position: relative; bottom: 170px;' width='1450px'>
    <!----------------------------------------TABLE---------------------------------------------->
    <center>
        <div style='font-family: monospace; font-size: 100px; position: relative; bottom: 150px;'>
            <table border='2' style='width: 95%;'>
                <tr>
                    <th><p style='float: left'>Application ID:</p></th>
                    <td><p style='float: left'>$id</p></td>
                    <th><p style='float: left'>Date of Submission:</p></th>
                    <td><p style='float: left'>$now</p></td>
                </tr>
                <tr>
                    <th><p style='float: left'>Student Name:</p></th>
                    <td><p style='float: left'>$name</p></td>
                    <th><p style='float: left'>Email:</p></th>
                    <td><p style='float: left'>$emailad</p></td>
                </tr>
                <tr>
                    <th><p style='float: left'>Roll Number:</p></th>
                    <td><p style='float: left'>$rn</p></td>
                    <th><p style='float: left'>Enrollment Number:</p></th>
                    <td><p style='float: left'>$en</p></td>
                </tr>
                <tr>
                    <th><p style='float: left'>Father's Name:</p></th>
                    <td><p style='float: left'>$fname</p></td>
                    <th><p style='float: left'>Mother's Name:</p></th>
                    <td><p style='float: left'>$mname</p></td>
                </tr>
                <tr>
                    <th><p style='float: left'>Postal Address:</p></th>
                    <td colspan='3'><p style='float: left'>$pa</p></td>
                </tr>
                <tr>
                    <th><p style='float: left'>PIN Code:</p></th>
                    <td><p style='float: left'>$pin</p></td>
                    <th><p style='float: left'>Course Name:</p></th>
                    <td><p style='float: left'>$pr</p></td>
                </tr>
                <tr>
                    <th><p style='float: left'>Do you have SBI account?:</p></th>
                    <td><p style='float: left'>".$_POST["sbi"]."</p></td>
                    <th><p style='float: left'>Receipt Number:</p></th>
                    <td><p style='float: left'>$ren</p></td>
                </tr>
            ";
           
            if($_POST["sbi"]=="Yes"){
                $mid_if="
                <tr>
                    <th><p style='float: left'>Account Number:</p></th>
                    <td><p style='float: left'>$accNo</p></td>
                    <th><p style='float: left'>IFSC Code:</p></th>
                    <td><p style='float: left'>$ifsc</p></td>
                </tr>
                ";
            }
     $ending="    
            <tr>
                <th><p style='float: left'>Date of Receipt:</p></th>
                <td><p style='float: left'>$d</p></td>
                <th><p style='float: left'>Amount:</p></th>
                <td><p style='float: left'>$a</p></td>
            </tr>
        </table>
    </div>
    </body>
    </html>
    ";
$conf = $head . $mid_if . $ending;
echo $conf;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <?php
    // calling php code to send confermation of regestration via Email
    // include "Confirmation_email.php";
    ?>
    <center>
        <h3 style="font-family: monospace; font-size: 30px;">A confirmation mail of this receipt has been sent to you</h3>
        <h3 style="font-family: monospace; font-size: 30px;">You can now check status of your running application on the <a href="form_status.html">Status Checker For Refund Money</a></h3>
    <div><button style="margin-bottom:1%; border-radius: 10px; background-color: #0d6efd; color: white; height: 55px; width: 90px; font-size: 20px;" onclick="window.print();">Print</button></div>
    </center>
</body>
</html>