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
                <li><a class="menu" href="control-panel.html">Control Panel</a></li>
                <li><a class="menu" href="./server/log-out.php">Log out</a></li>
            <?php } else { ?>
                <li><a class="menu" href="sign-up.php">Sign Up/Log in</a></li>
            <?php } ?>
        </ul>
    </nav>

    <section class="center">
        <label class="room_name">Holiday Amorgos</label>
        <div class="text">

            <p>Το Holiday Amorgos είναι μια εταιρία δωματίων προς ενοικίαση που προσφέρει μια μοναδική εμπειρία
                φιλοξενίας στον όμορφο προορισμό της Αμοργού. Βρισκόμαστε στην καρδιά της Χώρας της Αμοργού, μια από τις
                πιο γραφικές και παραδοσιακές περιοχές του νησιού.

                Το Holiday Amorgos προσφέρει μια ευρεία γκάμα δωματίων και σουιτών, σχεδιασμένα για να καλύψουν κάθε
                ανάγκη και προτίμηση των επισκεπτών μας. Από παραδοσιακά δωμάτια με θέα στη θάλασσα έως πολυτελείς
                σουίτες με ιδιωτική πισίνα, το Holiday Amorgos προσφέρει μια αξέχαστη διαμονή για κάθε τύπο επισκέπτη.

                Στο Holiday Amorgos, η φιλοξενία είναι η προτεραιότητά μας. Οι επισκέπτες μας έχουν τη δυνατότητα να
                απολαύσουν όχι μόνο τις άνετες και πολυτελείς εγκαταστάσεις μας, αλλά και τη φιλική εξυπηρέτηση από το
                έμπειρο προσωπικό μας. Με ειδικά πακέτα και προσφορές για εκδρομές και δραστηριότητες στην Αμοργό, το
                Holiday Amorgos είναι ο ιδανικός προορισμός για αξέχαστες διακοπές στο νησί.

                Ελάτε να ζήσετε τη μαγεία της Αμοργού με το Holiday Amorgos και δημιουργήστε αξέχαστες αναμνήσεις που θα
                διαρκέσουν μια ζωή.
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
                        <div class="last">rooms_amo@somewhere.gr</div>
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
</body>
<script>
    function myFunction(x) {
        x.classList.toggle("change");
    }

</script>

</html>