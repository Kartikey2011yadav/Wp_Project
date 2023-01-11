<?php
include "dbconnect.php";


$course;
$fdate;
$tdate;
$process;
$sql="SELECT * from iips;";

$course_set="No Filter applied";
$fdate_set="No Filter applied";
$tdate_set="No Filter applied";
$process_set="No Filter applied";

if($_POST["que_d"]=="Yes" && !empty($_POST["FromDate"]) && !empty($_POST["ToDate"]) && !empty($_POST["Process"]))
{
    $course=filter_input(INPUT_POST,"enrolled");
    $fdate=$_POST["FromDate"];
    $tdate=$_POST["ToDate"];
    $process=$_POST["Process"];
    $course_set=$course;
    $fdate_set=$fdate;
    $tdate_set=$tdate;
    $process_set=$process;
    $sql=CourseFromToProcess($course,$fdate,$tdate,$process);
}

if($_POST["que_d"]=="Yes" && empty($_POST["FromDate"]) && !empty($_POST["ToDate"]) && !empty($_POST["Process"]))
{
    $course=filter_input(INPUT_POST,"enrolled");
    $tdate=$_POST["ToDate"];
    $process=$_POST["Process"];
    $course_set=$course;
    $fdate_set="~";
    $tdate_set=$tdate;
    $process_set=$process;
    $sql=CourseNotFromToProcess($course,$tdate,$process);
}

if($_POST["que_d"]=="Yes" && !empty($_POST["FromDate"]) && empty($_POST["ToDate"]) && !empty($_POST["Process"]))
{
    $course=filter_input(INPUT_POST,"enrolled");
    $fdate=$_POST["FromDate"];
    $process=$_POST["Process"];
    $course_set=$course;
    $fdate_set=$fdate;
    $tdate_set="~";
    $process_set=$process;
    $sql=CourseFromNotToProcess($course,$fdate,$process);
}

if($_POST["que_d"]=="Yes" && !empty($_POST["FromDate"]) && !empty($_POST["ToDate"]) && empty($_POST["Process"]))
{
    $course=filter_input(INPUT_POST,"enrolled");
    $fdate=$_POST["FromDate"];
    $tdate=$_POST["ToDate"];
    $course_set=$course;
    $fdate_set=$fdate;
    $tdate_set=$tdate;
    $sql=CourseFromToNotProcess($course,$fdate,$tdate);
}

if($_POST["que_d"]=="No" && !empty($_POST["FromDate"]) && !empty($_POST["ToDate"]) && !empty($_POST["Process"]))
{
    $fdate=$_POST["FromDate"];
    $tdate=$_POST["ToDate"];
    $process=$_POST["Process"];
    $fdate_set=$fdate;
    $tdate_set=$tdate;
    $process_set=$process;
    $sql=NotCourseFromToProcess($fdate,$tdate,$process);
}

if($_POST["que_d"]=="No" && empty($_POST["FromDate"]) && !empty($_POST["ToDate"]) && !empty($_POST["Process"]))
{
    $tdate=$_POST["ToDate"];
    $process=$_POST["Process"];
    $fdate_set="~";
    $tdate_set=$tdate;
    $process_set=$process;
    $sql=NotCourseNotFromToProcess($tdate,$process);
}

if($_POST["que_d"]=="No" && !empty($_POST["FromDate"]) && empty($_POST["ToDate"]) && !empty($_POST["Process"]))
{
    $fdate=$_POST["FromDate"];
    $process=$_POST["Process"];
    $fdate_set=$fdate;
    $tdate_set="~";
    $process_set=$process;
    $sql=NotCourseFromNotToProcess($fdate,$process);
}

if($_POST["que_d"]=="No" && !empty($_POST["FromDate"]) && !empty($_POST["ToDate"]) && empty($_POST["Process"]))
{
    $fdate=$_POST["FromDate"];
    $tdate=$_POST["ToDate"];
    $fdate_set=$fdate;
    $tdate_set=$tdate;
    $sql=NotCourseFromToNotProcess($fdate,$tdate);
}

if($_POST["que_d"]=="Yes" && empty($_POST["FromDate"]) && empty($_POST["ToDate"]) && !empty($_POST["Process"]))
{
    $course=filter_input(INPUT_POST,"enrolled");
    $process=$_POST["Process"];
    $course_set=$course;
    $process_set=$process;
    $sql=CourseNotFromNotToProcess($course,$process);
}

if($_POST["que_d"]=="Yes" && empty($_POST["FromDate"]) && !empty($_POST["ToDate"]) && empty($_POST["Process"]))
{
    $course=filter_input(INPUT_POST,"enrolled");
    $tdate=$_POST["ToDate"];
    $course_set=$course;
    $fdate_set="~";
    $tdate_set=$tdate;
    $sql=CourseNotFromToNotProcess($course,$tdate);
}

if($_POST["que_d"]=="Yes" && !empty($_POST["FromDate"]) && empty($_POST["ToDate"]) && empty($_POST["Process"]))
{
    $course=filter_input(INPUT_POST,"enrolled");
    $fdate=$_POST["FromDate"];
    $course_set=$course;
    $fdate_set=$fdate;
    $tdate_set = "~";
    $sql=CourseFromNotToNotProcess($course,$fdate);
}

if($_POST["que_d"]=="No" && empty($_POST["FromDate"]) && empty($_POST["ToDate"]) && !empty($_POST["Process"]))
{
    $process=$_POST["Process"];
    $process_set=$process;
    $sql=NotCourseNotFromNotToProcess($process);
}

if($_POST["que_d"]=="No" && empty($_POST["FromDate"]) && !empty($_POST["ToDate"]) && empty($_POST["Process"]))
{
    $tdate=$_POST["ToDate"];
    $fdate_set="~";
    $tdate_set=$tdate;
    $sql=NotCourseNotFromToNotProcess($tdate);
}

if($_POST["que_d"]=="No" && !empty($_POST["FromDate"]) && empty($_POST["ToDate"]) && empty($_POST["Process"]))
{
    $fdate=$_POST["FromDate"];
    
    $fdate_set=$fdate;
    $tdate_set="~";
    $sql=NotCourseFromNotToNotProcess($fdate);
}

if($_POST["que_d"]=="Yes" && empty($_POST["FromDate"]) && empty($_POST["ToDate"]) && empty($_POST["Process"]))
{
    $course=filter_input(INPUT_POST,"enrolled");
    $course_set=$course;
   
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


$result_d = $conn->query($sql);

//Retrieve the data from our table.
$rows = $result_d->fetch_all(PDO::FETCH_ASSOC);

//The name of the Excel file that we want to force the
//browser to download.
$filename = "Caution_Filter_Download" . date('Ymd') . ".xls";

//Send the correct headers to the browser so that it knows
//it is downloading an Excel file.
header("Content-Type: application/xls");    
header("Content-Disposition: attachment; filename=$filename");  
header("Pragma: no-cache"); 
header("Expires: 0");

$filter_set = ["Courses: ".$course_set, "Date-> ","From: ".$fdate_set, "To: ".$tdate_set,"Processed: ".$process_set];

//Define the separator line
$separator = "\t";

echo implode($separator, array_values($filter_set)) . "\n";

//If our query returned rows
if(!empty($rows)){
    
    //Dynamically print out the column names as the first row in the document.
    //This means that each Excel column will have a header.
    

$Application = [
    ['Application ID', 'Student Name','Roll No.', 'Enrollment No.','Course Enrolled','Father`s Name','Mother`s Name','Email','Mobile No.',
    'Alternate No.','Postal Address','Pincode',  'Receipt No.','Date of Receipt','Amount','Account No.','IFSC',
    'Passbook','Fees rec/affidavit File','Fees NoDues','Amount Due','Library NoDues','Date of Submission','Time of Submission','Amount Refunded?']
    ];
  
    echo implode($separator, array_values($Application[0])) . "\n";
    
    //Loop through the rows
    foreach($rows as $row){
        
        //Clean the data and remove any special characters that might conflict
        foreach($row as $k => $v){
            $row[$k] = str_replace($separator . "$", "", $row[$k]);
            $row[$k] = preg_replace("/\r\n|\n\r|\n|\r/", " ", $row[$k]);
            $row[$k] = trim($row[$k]);
        }
        
        //Implode and print the columns out using the 
        //$separator as the glue parameter
        echo implode($separator, $row) . "\n";
    }
}


?>