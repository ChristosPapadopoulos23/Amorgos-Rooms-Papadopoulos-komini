<?php
require_once 'logs.php';

require_once 'db_connection.php';

if(isset($_GET['value']))
    $email = $_GET['value'];
        
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $amorg_email="christoszita@gmail.com";
    $name=$conn->real_escape_string($_POST['name']);
    $sname=$conn->real_escape_string($_POST['sname']);
    $adults=$conn->real_escape_string($_POST['adults']);
    $kids=$conn->real_escape_string($_POST['kids']);
    $user_email=$conn->real_escape_string($_POST['email']);
    $phone=$conn->real_escape_string($_POST['phone']);
    $arrival=$conn->real_escape_string($_POST['arrival']);
    $return=$conn->real_escape_string($_POST['return']);
    $room_number=$conn->real_escape_string($_POST['room']);
    $flexibility=$_POST['flexibility'];
    $pet=$conn->real_escape_string($_POST['pet']);
    $comments=$conn->real_escape_string($_POST['comments']);
    $today = date("Y-m-d");

    if($flexibility!='yes'){
        $flexibility='Όχι';
    }
    else{
        $flexibility='Ναί';
    }
    echo"$flexibility";

    if(strlen($name)<2 || strlen($sname)<2)
        exit(0);

    if(strlen($phone)<10 || strlen($phone)>15)
        exit(0);

    if($arrival!=$today || $return<$arrival)
        exit(0);

    if($kids<0 || $adults<1 || $room_number<1)
        exit(0);
    

    $booking_message="Έχετε νέα κράτηση από έναν πελάτη. Παρακάτω βρίσκεται η λεπτομερής πληροφορία της κράτησης:

    Όνομα: $name
    Επώνυμο: $sname
    Τηλέφωνο: $phone
    Αριθμός ενηλίκων: $adults
    Αριθμός παιδιών: $kids
    Αριθμός δωματίων: $room_number
    Ώρα άφιξης: $arrival
    Ώρα αναχώρησης: $return
    Κατοικίδια: $pet
    Ευελιξία: $flexibility
    Σχόλια: $comments

Παρακαλούμε εξετάστε την κράτηση αυτή και επικοινωνήστε με τον πελάτη σύντομα για επιπλέον πληροφορίες ή για την επιβεβαίωση της κράτησης.

Ευχαριστούμε,
Η ομάδα σας";

    $user_message = "Αγαπητέ/ή $sname $name,

Σας ευχαριστούμε πολύ που επικοινωνήσατε μαζί μας. Εκτιμούμε το ενδιαφέρον σας για τις υπηρεσίες μας.

Ένας από τους υπεύθυνους της Amorgos Rooms θα εξετάσει το μήνυμά σας και θα επικοινωνήσει μαζί σας σύντομα για να σας παρέχει περισσότερες πληροφορίες ή για να οργανώσει την επόμενη ενέργεια.

Εάν έχετε οποιεσδήποτε ερωτήσεις ή ανάγκες μέχρι τότε, μη διστάσετε να επικοινωνήσετε μαζί μας ξανά. Παρακαλώ μην απαντάτε σε αυτό το email

Με εκτίμηση,
Η ομάδα της Amorgos Rooms";

    if (mail($user_email, "Νέα κράτηση από πελάτη", $booking_message)) {
        echo "Email sent successfully!";
    } else {
        echo "Email sending failed.";
    }

    if (mail($amorg_email, "Ευχαριστούμε για την επικοινωνία σας με την Amorgos Rooms", $user_message)) {
        echo "Email sent successfully!";
    } else {
        echo "Email sending failed.";
    }

}
