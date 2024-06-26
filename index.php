<?php
session_start();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Amorgos-rooms</title>
    <link href="https://fonts.googleapis.com/css2?family=STIX+Two+Text:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="css_files/style.css">
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
            <li><a class="active" href="index.php">Home</a></li>
            <li><a href="find-a-room.php">Rooms</a></li>
            <li><a href="more.php">Information</a></li>

            <?php if (isset($_SESSION['user_id'])) { ?>
                <li><a class="menu" href="control-panel.php">Control Panel</a></li>
                <li><a class="menu" href="./server/log-out.php">Log out</a></li>
            <?php } else { ?>
                <li><a class="menu" href="sign-up.php">Sign Up/Log in</a></li>
            <?php } ?>


        </ul>
    </nav>
    <section class="center">
        <a class="log" href="find-a-room.php">
            <div class="big_logo">FIND ROOMS</div>
        </a>
        <div class="wave" id="wave1" style="--i: 1;"></div>
        <div class="wave" id="wave2" style="--i: 2;"></div>
        <div class="wave" id="wave3" style="--i: 3;"></div>
        <div class="wave" id="wave4" style="--i: 4;"></div>
    </section>
    <br>
    <h1 class="head">Καλώς ήρθατε στα δωμάτια Αμοργού</h1><br><br><br><br>
    <div class="information">
        <div class="img1"></div>
        <div class="text"> Καλώς ήρθατε στα Amorgos Rooms, την ιδανική επιλογή για τη διαμονή σας στο μαγευτικό νησί της
            Αμοργού. Απολαύστε μια μοναδική εμπειρία φιλοξενίας σε έναν παραδοσιακό και φιλόξενο προορισμό.
        </div>
        <div class="img2"></div>
        <div class="text2">Με εξαιρετική τοποθεσία και εκπληκτική θέα στο Αιγαίο Πέλαγος, τα Amorgos Rooms σας
            υπόσχονται άνετη διαμονή και αξέχαστες διακοπές. Ανακαλύψτε την ομορφιά του νησιού, απολαύστε την τοπική
            γαστρονομία και ζήστε μοναδικές στιγμές χαλάρωσης και ανανέωσης στα Amorgos Rooms.
        </div>
    </div>
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
</body>
    <script>
        function myFunction(x) {
            x.classList.toggle("change");
        }
    </script>

</html>
