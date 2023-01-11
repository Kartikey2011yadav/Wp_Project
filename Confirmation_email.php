<?php
$AppNo = $id;
$Name = $name;
$Email = $emailad;
$subject = "This is a confirmation Mail";

$message = "Registration for caution money was successful and your responce is been recorded.";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once "PHPMailer/PHPMailer.php";
require_once "PHPMailer/SMTP.php";
require_once "PHPMailer/Exception.php";



$mail = new PHPMailer(true);

// $mail->SMTPDebug = SMTP::DEBUG_SERVER;

$mail->isSMTP();
$mail->SMTPAuth = true;
$mail->Host = "smtp.gmail.com";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->Port = 587;

$mail->Username = "kartikey2011yadav@gmail.com"; //------------------- enter official mail here
$mail->Password = "ymtcjcqolhldkqvs"; //----------------------------- enter password here

$mail->addAddress($Email, $Name);


// Include the PDF class
require_once "FPDF-master/fpdf.php";

$now = date("d/m/Y");
$apid = $AppNo;

// Create instance of PDF class
$pdf = new FPDF();
 
// Add 1 page in your PDF
$pdf->AddPage();

// Place image on top left with 100px width
$pdf->Image('davv_logo.png', 10, 10, 30);
$pdf->Image('iips_logo.png', 170, 10, 30);
 
// Set Arial Bold font with size 22px
$pdf->SetFont("Arial", "B", 22);

$pdf->SetXY(65, 25);
// $pdf->SetX(100);
// $pdf->SetY(25);
$pdf->Cell(0, 0, "Receipt of your details");
 
// Give margin from left

 
// Move the cursor to next line
$pdf->Ln();

// Sets the background color to light gray
$pdf->SetFillColor(209, 207, 207);
$pdf->Ln();
 
// Setting the font to Arial normal with size 16px
$pdf->SetFont("Arial", "", 12);
 
$sql = "SELECT * FROM iips where Application_ID = $apid";
$res = mysqli_query($conn, $sql);

// $pdf->SetX(60);
// $pdf->SetY(50);
// Iterate through each record
while ($row = mysqli_fetch_object($res))
{
    // Create cells with 50px width, 10px height and 1px border
    $pdf->SetXY(30, 50);
    $pdf->Cell(75, 10, "Application ID: ", 1, 0, "L", true);
    $pdf->Cell(75, 10, $row->Application_ID, 1, 0, "L");
    $pdf->Ln();
    
    $pdf->SetXY(30, 60);
    $pdf->Cell(75, 10, "Date of Submission: ", 1, 0, "L", true);
    $pdf->Cell(75, 10, $now, 1, 0, "L");
    $pdf->Ln();
    
    $pdf->SetXY(30, 70);
    $pdf->Cell(75, 10, "Student's Name: ", 1, 0, "L", true);
    $pdf->Cell(75, 10, $row->Name, 1, 0, "L");
    $pdf->Ln();
    
    $pdf->SetXY(30, 80);
    $pdf->Cell(75, 10, "Father's Name: ", 1, 0, "L", true);
    $pdf->Cell(75, 10, $row->Fathers_Name, 1, 0, "L");
    $pdf->Ln();
    
    $pdf->SetXY(30, 90);
    $pdf->Cell(75, 10, "Mother's Name: ", 1, 0, "L", true);
    $pdf->Cell(75, 10, $row->Mothers_Name, 1, 0, "L");
    $pdf->Ln();
    
    $pdf->SetXY(30, 100);
    $pdf->Cell(75, 10, "Email Address: ", 1, 0, "L", true);
    $pdf->Cell(75, 10, $row->Email, 1, 0, "L");
    $pdf->Ln();
    
    $pdf->SetXY(30, 110);
    $pdf->Cell(75, 10, "Mobile Number: ", 1, 0, "L", true);
    $pdf->Cell(75, 10, $row->MobileNo, 1, 0, "L");
    $pdf->Ln();
    
    $pdf->SetXY(30, 120);
    $pdf->Cell(75, 10, "Alternate Number: ", 1, 0, "L", true);
    $pdf->Cell(75, 10, $row->AltNo, 1, 0, "L");
    $pdf->Ln();
    
    $pdf->SetXY(30, 130);
    $pdf->Cell(75, 10, "Postal Address: ", 1, 0, "L", true);
    $pdf->Cell(75, 10, $row->PostalAddress, 1, 0, "L");
    $pdf->Ln();
    
    $pdf->SetXY(30, 140);
    $pdf->Cell(75, 10, "PIN Code: ", 1, 0, "L", true);
    $pdf->Cell(75, 10, $row->Pincode, 1, 0, "L");
    $pdf->Ln();
    
    $pdf->SetXY(30, 150);
    $pdf->Cell(75, 10, "Course Enrolled: ", 1, 0, "L", true);
    $pdf->Cell(75, 10, $row->CourseEnrolled, 1, 0, "L");
    $pdf->Ln();
    
    $pdf->SetXY(30, 160);
    $pdf->Cell(75, 10, "Roll Number: ", 1, 0, "L", true);
    $pdf->Cell(75, 10, $row->ClassRollNo, 1, 0, "L");
    $pdf->Ln();
    
    $pdf->SetXY(30, 170);
    $pdf->Cell(75, 10, "Enrollment Number: ", 1, 0, "L", true);
    $pdf->Cell(75, 10, $row->EnrollmentNo, 1, 0, "L");
    $pdf->Ln();
    
    $pdf->SetXY(30, 180);
    $pdf->Cell(75, 10, "Do you have a SBI Account: ", 1, 0, "L", true);
    $pdf->Cell(75, 10, $_POST["sbi"], 1, 0, "L"); // replace here : $_POST["sbi"]
    $pdf->Ln();

    if($_POST["sbi"] =="Yes"){
       
        $pdf->SetXY(30, 190);
        $pdf->Cell(75, 10, "Account Number: ", 1, 0, "L", true);
        $pdf->Cell(75, 10, $row->AccountNo, 1, 0, "L");
        $pdf->Ln();
        
        $pdf->SetXY(30, 200);
        $pdf->Cell(75, 10, "IFSC Code: ", 1, 0, "L", true);
        $pdf->Cell(75, 10, $row->IFSC, 1, 0, "L");
        $pdf->Ln();
    

    $pdf->SetXY(30, 210);
    $pdf->Cell(75, 10, "Receipt Number: ", 1, 0, "L", true);
    $pdf->Cell(75, 10, $row->ReceiptNo, 1, 0, "L");
    $pdf->Ln();
    
    $pdf->SetXY(30, 220);
    $pdf->Cell(75, 10, "Date of Receipt: ", 1, 0, "L", true);
    $pdf->Cell(75, 10, $row->Date_Receipt, 1, 0, "L");
    $pdf->Ln();
    
    $pdf->SetXY(30, 230);
    $pdf->Cell(75, 10, "Amount: ", 1, 0, "L", true);
    $pdf->Cell(75, 10, $row->Amount, 1, 0, "L");
    $pdf->Ln();
    }
    
    else{
    $pdf->SetXY(30, 190);
    $pdf->Cell(75, 10, "Receipt Number: ", 1, 0, "L", true);
    $pdf->Cell(75, 10, $row->ReceiptNo, 1, 0, "L");
    $pdf->Ln();
    
    $pdf->SetXY(30, 200);
    $pdf->Cell(75, 10, "Date of Receipt: ", 1, 0, "L", true);
    $pdf->Cell(75, 10, $row->Date_Receipt, 1, 0, "L");
    $pdf->Ln();
    
    $pdf->SetXY(30, 210);
    $pdf->Cell(75, 10, "Amount: ", 1, 0, "L", true);
    $pdf->Cell(75, 10, $row->Amount, 1, 0, "L");
    $pdf->Ln();
    }    
}
 
// Render the PDF in your browser


 $pdf->Output("Registration-".$apid.".pdf",'F');


$mail->addAttachment("Registration-".$apid.".pdf");

$mail->Subject = $subject;
$mail->Body = $message;

$mail->send();
// Delete the file from server
unlink("Registration-".$apid.".pdf");
?>