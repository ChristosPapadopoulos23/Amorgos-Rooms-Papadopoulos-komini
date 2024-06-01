<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title> Amorgos-rooms</title>
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
        <label class="room_name">Julia Rooms</label>
        <div class="text">

           <!-- <div class="image-container">
                <button onclick="previousImage()"><i class='bx bxs-left-arrow left'></i></button>
                <button onclick="nextImage()"><i class='bx bxs-right-arrow right'></i></button>
                <img src="./media/room1.jpg" class="visible room1">
                <img class="room1 invisible" src="./media/room2.jpg">
                <img class="room1 invisible" src="./media/room2.jpg">
            </div>-->
            <div class="image-slideshow">
                <div>
                    <img src="./media/room1.jpg" width="600" height="300" alt="">
                </div>
                <div>
                    <img src="./media/room2.jpg" width="600" height="300" alt="">
                </div>
                <div>
                    <img src="./media/room3.jpg" width="600" height="300" alt="">
                </div>
            </div>
            <p>
                Τα Julia Rooms είναι μια εταιρία δωματίων που προσφέρει μια μοναδική εμπειρία φιλοξενίας στην όμορφη
                τοποθεσία των Καταπολων, στο νησί της Αμοργού. Βρίσκονται σε μια από τις πιο γραφικές περιοχές του
                νησιού, περιβάλλοντας τους επισκέπτες με τη φυσική ομορφιά και την ειρηνική ατμόσφαιρα που χαρακτηρίζει
                την Αμοργό.

                Τα δωμάτια μας διαθέτουν όλες τις σύγχρονες ανέσεις που χρειάζεστε για ένα άνετο και ευχάριστο διαμονή.
                Κάθε δωμάτιο είναι λειτουργικά σχεδιασμένο και διακοσμημένο με γούστο, προσφέροντας έναν ζεστό και
                φιλόξενο χώρο για να αναπαυθείτε μετά από μια μέρα γεμάτη περιπέτειες στο νησί.

                Επιπλέον, οι επισκέπτες μας μπορούν να απολαύσουν τις υπηρεσίες μας όπως η πρωινή καφές στον κήπο μας,
                προσωπική εξυπηρέτηση από το φιλόξενο προσωπικό μας, και προσφορές για εκδρομές και δραστηριότητες στο
                νησί.

                Τα Julia Rooms δεσμεύονται να προσφέρουν στους επισκέπτες τους μια αξέχαστη εμπειρία διακοπών στην
                Αμοργό, γεμάτη φιλοξενία, άνεση και ευεξία. Είτε επισκέπτεστε το νησί για ξεκούραστες διακοπές στην
                παραλία, είτε για να εξερευνήσετε την υπέροχη φύση και τον πολιτισμό του, τα Julia Rooms είναι ο
                ιδανικός προορισμός για τη διαμονή σας.
            </p>
            <div class="under">
                <hr>
                <div class="two">
                    <div class="one">
                        <i class='bx bx-mobile'></i>
                        <div> 69xxxxxxxx</div>
                    </div>
                    <div class="one">
                        <i class='bx bx-phone'></i>
                        <div> 22580-ΧΧΧΧΧ</div>
                    </div>
                    <div class="one">
                        <i class='bx bxs-envelope'></i>
                        <div class="last">julia@villa-julia.gr</div>
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
            <div class="tag">Χρήστος Παπαδόπουλος-2024</div>
        </div>
    </div>
    <script src="scripts/picture_change.js"></script>
    <script>
        function myFunction(x) {
            x.classList.toggle("change");
        }
    </script>
</body>

</html>