
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
    
    <link rel="stylesheet" href="css_files/style_rooms.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
            <li><a class="menu active" href="find-a-room.php">Rooms</a></li>
            <li><a class="menu" href="more.php">Information</a></li>
            <?php if (isset($_SESSION['user_id'])) { ?>
                <li><a class="menu" href="control-panel.php">Control Panel</a></li>
                <li><a class="menu" href="./server/log-out.php">Log out</a></li>
            <?php } else { ?>
                <li><a class="menu" href="sign-up.php">Sign Up/Log in</a></li>
            <?php } ?>
        </ul>
    </nav>
    <main>
        <section class="center">
            <div class="location">
                <div class="search">
                    <i class='bx bx-search-alt'></i>
                    <input class="txtfield" type="text" id="fname" name="fname" placeholder="Search...">
                </div>
                <div class="custom-select" id="Location">
                    <select class="area" id="area">
                        <option value="all">Διαλέξτε περιοχή</option>
                        <option value="Χώρα Αμοργού">Χώρα Αμοργού</option>
                        <option value="Αιγιάλη">Αιγιάλη</option>
                        <option value="Κατάπολα">Κατάπολα</option>
                        <option value="Άλλο">Άλλο</option>
                    </select>
                </div>
            </div>

            <div id="roomsContainer" class="rooms">


            </div>
            <div class="wave" id="wave1" style="--i: 1;"></div>
            <div class="wave" id="wave2" style="--i: 2;"></div>
            <div class="wave" id="wave3" style="--i: 3;"></div>
            <div class="wave" id="wave4" style="--i: 4;"></div>
        </section>
    </main>

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

    <script src="./scripts/fetch-rooms.js"></script>

</body>
    <script>
        function myFunction(x) {
            x.classList.toggle("change");
        }
    </script>



</html>
