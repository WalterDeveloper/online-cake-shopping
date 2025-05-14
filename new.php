<?php

$statusMsg='';
if(isset($_FILES["file"]["name"])){
   $email = $_POST['email'];
    $name = $_POST['first_name'];
    $surname = $_POST['surname'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $city = $_POST['city'];
    $state = $_POST['state'];
    $age = $_POST['age'];
    $birth = $_POST['birth'];
   

	
//$subject= $subject;

 // Sender
 //$from = $name;
 $fromemail = $email;
// $fromName = 'Kings Price Model';
 
  // Sender
                $from = 'events@intoguide.co.za';
                $fromName = 'DesignR Inc. Events & Decor';
                // Header for sender info
                $headers = "From: $fromName"." <".$from.">";
 
 // Subject
 $emailSubject = 'Contact Request Submitted by '.$name;
 
 
 // Header for sender info
//$headers = "From: $fromemail"." <".$from.">";
$email_message = '<h2>Contact Request Submitted</h2>
                    <p><b>Name:</b> '.$name.'</p>
                    <p><b>Email:</b> '.$email.'</p>
                    <p><b>Surname:</b> '.$surname.'</p>
                    <p><b>Phone:</b> '.$phone.'</p>
                    <p><b>address:</b> '.$address.'</p>
                    <p><b>city:</b> '.$city.'</p>
                    <p><b>state:</b> '.$state.'</p>
                    <p><b>age:</b> '.$age.'</p>
                    <p><b>birth:</b> '.$birth.'</p>';
   

$semi_rand = md5(time());
//$headers = "From: ".$fromemail;
$mime_boundary = "==Multipart_Boundary_x{$semi_rand}x";



    $headers .= "\nMIME-Version: 1.0\n" .
    "Content-Type: multipart/mixed;\n" .
    " boundary=\"{$mime_boundary}\"";

if($_FILES["file"]["name"]!= ""){  
	$strFilesName = $_FILES["file"]["name"];  
	$strContent = chunk_split(base64_encode(file_get_contents($_FILES["file"]["tmp_name"])));  
	
	
    $email_message .= "This is a multi-part message in MIME format.\n\n" .
    "--{$mime_boundary}\n" .
    "Content-Type:text/html; charset=\"iso-8859-1\"\n" .
    "Content-Transfer-Encoding: 7bit\n\n" .
    $email_message .= "\n\n";


    $email_message .= "--{$mime_boundary}\n" .
    "Content-Type: application/octet-stream;\n" .
    " name=\"{$strFilesName}\"\n" .
    //"Content-Disposition: attachment;\n" .
    //" filename=\"{$fileatt_name}\"\n" .
    "Content-Transfer-Encoding: base64\n\n" .
    $strContent  .= "\n\n" .
    "--{$mime_boundary}--\n";
}
$toemail="events@intoguide.co.za ";	

if(mail($toemail,$emailSubject, $email_message, $headers)){
   $statusMsg= "Email send successfully with attachment";
}else{
   $statusMsg= "Not sent";
}
}
   ?>
