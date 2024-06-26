<?php
session_start();
require_once 'server/db_connection.php';

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_GET['id']) && isset($_GET['name'])) {
    $id = $_GET['id'];
    $business_name = $_GET['name'];

    // Use prepared statements to prevent SQL injection
    $stmt = $conn->prepare("SELECT * FROM BusinessTable WHERE id = ?");
    if (!$stmt) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }
    $stmt->bind_param("i", $id);
    if (!$stmt->execute()) {
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $phone = $row['business_phone'];
        $mobile = $row['business_mobile'];
        $email = $row['business_email'];
        $location = $row['location'];
        $description = $row['description'];
    } else {
        // Redirect or show an error message if no data found
        header("Location: error.php");
        exit();
    }
    $stmt->close();
} else {
    // Redirect or show an error message if id or name are not set
    header("Location: error.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title> Amorgos-rooms</title>
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link href="https://fonts.googleapis.com/css2?family=STIX+Two+Text:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="css_files/style_room_page.css">
</head>

<body>
    <nav>
        <input type="checkbox" id="check">
        <label for="check" class="checkbtn">
            <div class="container" onclick="myFunction(this)">
                <div class="bar1"></div>
                <div class="bar2"></div>
                <div class="bar3"></div>
            </div>
        </label>
        <label class="logo">Amorgos Rooms</label>
        <ul>
            <li><a class="menu" href="index.php">Home</a></li>
            <li><a class="menu" href="find-a-room.php">Rooms</a></li>
            <li><a class="menu" href="more.php">Information</a></li>

            <?php if (isset($_SESSION['user_id'])) { ?>
                <li><a class="menu" href="control-panel.php">Control Panel</a></li>
                <li><a class="menu" href="./server/log-out.php">Log out</a></li>
            <?php } else { ?>
                <li><a class="menu" href="sign-up.php">Sign Up/Log in</a></li>
            <?php } ?>
        </ul>
    </nav>

    
    <section class="center">
        <label class="room_name"> <?php echo $business_name ?></label>
        <div class="text">
            
            <?php
            $dir = "./uploads/$id/";
            $images = glob($dir . "*.{jpg,jpeg,png,gif}", GLOB_BRACE);
            if (count($images) > 0) {
                echo'<div class="w3-content w3-display-container">';
               
                foreach ($images as $image) {
                    echo"<img class='mySlides' src='$image' width='600' height='600' alt=''>";       
                }
                if (count($images) >1){
                    echo'<button class="w3-button w3-display-left" onclick="plusDivs(-1)">&#10094;</button>';
                    echo'<button class="w3-button w3-display-right" onclick="plusDivs(+1)">&#10095;</button>';
                }
                echo "</div>"; 
            }
            ?>
            <p id="description"><?php if($description!='0'){echo $description;} ?>
            </p>
            <div class="under">
                <hr>
                <div class="two">
                    <div class="one">
                        <i class='bx bxs-map'></i>
                        <div id="email" class="last"><?php echo $location ?></div>
                    </div>
                    <div class="one">
                        <div class="one">
                            <i class='bx bx-mobile'></i>
                            <div id="mobile"><?php echo $mobile ?></div>
                        </div>
                        <div class="one">
                            <i class='bx bx-phone'></i>
                            <div id="phone"><?php echo $phone ?></div>
                        </div>
                    </div>
                    <div class="one">
                        <i class='bx bxs-envelope'></i>
                        <div id="email" class="last"><?php echo $email ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="wave" id="wave1" style="--i: 1;"></div>
        <div class="wave" id="wave2" style="--i: 2;"></div>
        <div class="wave" id="wave3" style="--i: 3;"></div>
        <div class="wave" id="wave4" style="--i: 4;"></div>
    </section>

    <div class="footer">
        <hr>
        <h2 class="infohead">Contact Information</h2>
        <div class="info">
            <i class='bx bx-mobile'></i>
            <div>: 69xxxxxxxx</div>
            <i class='bx bx-phone'></i>
            <div>: 2xxxxxxxxx</div>
            <i class='bx bxs-envelope'></i>
            <div class="last">: amorgos@geemail.com</div>
            <div class="tag">Παουλιν Κομινι - Χρήστος Παπαδόπουλος-2024</div>
        </div>
    </div>
    <script>
        function myFunction(x) {
            x.classList.toggle("change");
        }

        var slideIndex = 1;
        showDivs(slideIndex);

        function plusDivs(n) {
            showDivs(slideIndex += n);
        }

        function showDivs(n) {
            var i;
            var x = document.getElementsByClassName("mySlides");
            if (n > x.length) {slideIndex = 1}
            if (n < 1) {slideIndex = x.length} ;
            for (i = 0; i < x.length; i++) {
                x[i].style.display = "none";
            }
            x[slideIndex-1].style.display = "block";
        }
        var pic_style2 = document.getElementsByClassName('w3-content');
        var pic_style = document.getElementsByClassName('mySlides');
        var text = document.getElementsByClassName('text');
        const FieldDescription = document.getElementById('description');
        window.onload = function() {
            console.log('User is typing: ',"<?php echo $description; ?>");
            if( "<?php echo $description; ?>"==0){
                FieldDescription.innerHTML = '';
                for (var i = 0; i < pic_style.length; i++) {
                 
                    pic_style[i].style.height = '100%';
                }
                text[0].style.width = 'auto';
                pic_style2[0].style.marginRight = '0px';
            }

        };
    </script>
</body>

</html>