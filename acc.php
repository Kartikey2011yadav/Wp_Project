<html>
<head>
    <script src="https://code.jquery.com/jquery-3.6.2.js"></script>
    <link rel='stylesheet' href='bootstrap.css'>
</head>
<?php
include "dbconnect.php";
session_start();
$count=0;
$count_n=0;
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
    $sql="SELECT * from account;";
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
    }
    if($count_n==1)
    {
        $disp="SELECT * from iips where Fees_NoDues = 'NA';";
        $display=$conn->query($disp);
        echo"
        <body style='background-image:url(fees.png);background-attachment: fixed;background-position: center;background-repeat: no-repeat;'>
        <center>
        <div id='prev' style='font-family: Lucida Console; font-size:small; '>
        <h3 style='font-size:xx-large;'>Students` Details</h3>
        <table class='table table-striped table-dark table-bordered table-responsive'>
        <tr>
        <th align='center'>Student`s Name</th>
        <th align='center'>Mobile No.</th>
        <th align='center'>Alternate No.</th>
        <th align='center'>Course Enrolled</th>
        <th align='center'>Roll No.</th>
        <th align='center'>Enrollment No.</th>
        <th align='center'>Dues</th>
        <th align='center'>Due Amount</th>
        <th align='center'>Change Dues</th>
        </tr>";
        $c=0;
        $appid=array();
        while($row=$display->fetch_assoc())
        {
            echo"<tr>
            <td align='center'>".$row["Name"]."</td>
            <td align='center'>".$row["MobileNo"]."</td>
            <td align='center'>".$row["AltNo"]."</td>
            <td align='center'>".$row["CourseEnrolled"]."</td>
            <td align='center'>".$row["ClassRollNo"]."</td>
            <td align='center'>".$row["EnrollmentNo"]."</td>
            <td align='center'>".$row["Fees_NoDues"]."</td>
            <td align='center'>".$row["Amount_Due"]."</td>
            <td align='center'>";
            $appid[$c]=$row["Application_ID"];
            echo"<div>
                <form method='post' action='' id='acc$c' name='formacc$c'>
                    <input type='radio' name='app' value='$appid[$c]' checked style='display:none;'>
                    <select id='resp$c' style='font-weight:bold;' class='form-control' name='resp'><option value='No'>No</option><option value='Yes'>Yes</option></select><br>
                    <div id='damt$c' style='display:none;'>Amount: <input id='amtdue$c' class='form-control' type='number' name='amtdue'></div>
                    <input type='submit' value='Save' class='btn btn-primary'>
                </form>
                <script>
                    $(document).ready(function()
                    {
                        $('#resp$c').change(function()
                        {
                            var opt=$(this).val();
                            if(opt=='Yes')
                            {
                                $('#damt$c').css('display','block');
                                $('#amtdue$c').attr('required',true);
                            }
                            else
                            {
                                $('#damt$c').css('display','none');
                                $('#amtdue$c').removeAttr('required');
                            }
                        });
                        $('#acc$c').submit(function(e)
                        {
                            e.preventDefault();
                            $.ajax(
                            {
                                method:'post',
                                url:'accquery.php',
                                data: $(this).serialize(),
                                datatype: 'text',
                                success: function(Response)
                                {
                                    $('body').html(Response);
                                }
                            });
                        });
                    });
                </script>
            </div>
            </td>
            </center>
            </body>
            ";
            $c++;
        }
    }
    else
    {
        echo"<script>window.alert('Enter correct credentials');</script>";
        echo"<script>window.history.back();</script>";
    }
?>
</html>