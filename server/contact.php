<?php
require_once 'logs.php';

require_once 'db_connection.php';

if(isset($_GET['value']))
        $email = $_GET['value'];
        
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $amorg_email="kominipaul@gmail.com";
    $name=$conn->real_escape_string($_POST['name']);
    $sname=$conn->real_escape_string($_POST['sname']);
    $adults=$conn->real_escape_string($_POST['adults']);
    $kids=$conn->real_escape_string($_POST['kids']);
    $user_email=$conn->real_escape_string($_POST['email']);
    $phone=$conn->real_escape_string($_POST['phone']);
    $arrival=$conn->real_escape_string($_POST['arrival']);
    $return=$conn->real_escape_string($_POST['return']);
    $room_number=$conn->real_escape_string($_POST['room']);
    //$flexibility=$_POST['flexibility'];
    $pet=$conn->real_escape_string($_POST['pet']);
    $comments=$conn->real_escape_string($_POST['comments']);
    $today = date("Y-m-d");
    $message = "
    <html>
        <body>
            <h1>Email Content</h1>
            <p>This is a sample email content.</p>
            <p>Email:  $user_email</p>
            <ul>
                <li>List item 1</li>
                <li>List item 2</li>
                <li>List item 3</li>
            </ul>
        </body>
    </html>";
    $headers= "testing";
    if(strlen($name)<2 || strlen($sname)<2)
        exit(0);

    if(strlen($phone)<10 || strlen($phone)>15)
        exit(0);

    if($arrival!=$today || $return<$arrival)
        exit(0);

    if($kids<0 || $adults<1 || $room_number<1)
        exit(0);
    
    if (mail($amorg_email, "Αίτηση για κράτηση δωματίου", $message)) {
        echo "Email sent successfully!";
    } else {
        echo "Email sending failed.";
    }

    

}
