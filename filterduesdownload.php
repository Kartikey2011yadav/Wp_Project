<?php
include "dbconnect.php";

$libdues=filter_input(INPUT_POST,"libdues");
$accdues=filter_input(INPUT_POST,"accdues");

$libdues_set="No Filter applied";
$accdues_set="No Filter applied";

$s;
if($libdues=="Don`t Filter" && $accdues=="Don`t Filter")
{
    $s="SELECT * from iips;";
}
if($libdues=="Don`t Filter" && $accdues!="Don`t Filter")
{
    $accdues_set = $accdues;
    $s="SELECT * from iips where Fees_NoDues = '$accdues'";
}
if($libdues!="Don`t Filter" && $accdues=="Don`t Filter")
{
    $libdues_set = $libdues;
    $s="SELECT * from iips where Library_NoDues = '$libdues'";
}
if($libdues!="Don`t Filter" && $accdues!="Don`t Filter")
{
    $accdues_set = $accdues;
    $libdues_set = $libdues;
    $s="SELECT * from iips where Library_NoDues = '$libdues' and Fees_NoDues = '$accdues';";
}
    $result_d = $conn->query($s);

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
    
    $filter_set = ["Filter via Library dues: ",$libdues_set,"Filter via Fees dues: ",$accdues_set];
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