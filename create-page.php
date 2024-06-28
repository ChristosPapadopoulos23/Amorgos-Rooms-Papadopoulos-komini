<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: ./sign-up.php");
    exit();
}

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

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <link rel="stylesheet" href="css_files/style_create_page.css">
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
            <li><a href="index.php">Home</a></li>
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

        <div class="main">
            <div class="contact">
                <form id="create" class="cont" action="./server/create.php" method="POST" onsubmit="return validateForm();" enctype="multipart/form-data"> 
                    <label class="form"> Δημιουργία σελίδας</label>

                    <input type="text" name="name" id="name" placeholder="Επωνυμία επιχείρησης..." required="">
                    <div class="num">
                        <label id="desc">Περιγραφή επιχείρησης</label>
                        <textarea class="txtfield" rows="15" id="comments" name="comments" placeholder="Περιγραφή επιχείρησης...."></textarea>
                    </div>
                    <div class="one">
                        <input type="email" name="email" id="email" placeholder="Email.." required="">
                        <input class="four" type="text" name="phone" id="phone" placeholder="Τηλέφωνο.." required="">
                    </div>
                    <input class="four" type="text" name="mobile" id="mobile" placeholder="Κινητό τηλέφωνο.." required="">
                        <div class="num">
                            <label for="poster">Φωτογραφία δωματίου:</label>
                            <label class="pic">
                                <input class="pic_input" type="file" id="room_pic" name="pic" accept="image/png, image/*"
                                    multiple />
                                Επιλογή αρχείου
                            </label>
                            <label for="poster">Επιλογή τοποθεσίας:</label>
                            <select class="area" id="area" name='area'>
                                <option value="0">Διαλέξτε περιοχή</option>
                                <option value="Χώρα Αμοργού">Χώρα Αμοργού</option>
                                <option value="Αιγιάλη">Αιγιάλη</option>
                                <option value="Κατάπολα">Κατάπολα</option>
                                <option value="Άλλος">Άλλο</option>
                            </select>
                        </div>
                    
                    <div class="text-xs-center">
                        <div class="g-recaptcha" data-sitekey="6LfbXNIpAAAAABFh4_XvMajKo0wEkQIS1JCyhQfJ"></div>
                    </div>
                    <button>Ready!</button>
                </form>

                <div id="url" class="url">
                    <form action="./server/create_url.php" method="POST" onsubmit="return validateLogin();" enctype="multipart/form-data">
                        <label id="url_lbl" class="form">Υπάρχουσα σελίδα;</label>
                        <input type="text" name="name_l" id="name_l" placeholder="Επωνυμία επιχείρησης..." required="">
                        <div class="one">
                            <input type="email" name="email_l" id="email_l" placeholder="Email.." required="">
                            <input class="four" type="text" name="phone_l" id="phone_l" placeholder="Τηλέφωνο.." required="">
                        </div>
                        <input class="four" type="text" name="mobile_l" id="mobile_l" placeholder="Κινητό τηλέφωνο.." required="">
                        <div class="num">
                            <label class="url_labels" for="poster">Φωτογραφία δωματίου:</label>
                            <label class="pic2">
                                <input class="pic_input" type="file" id="room_pic" name="pic" accept="image/png, image/*"
                                    multiple />
                                Επιλογή αρχείου
                            </label>
                            <label class="url_labels" for="poster">Επιλογή τοποθεσίας:</label>
                            <select class="area2" id="area_l" name='area_l'>
                                <option value="0">Διαλέξτε περιοχή</option>
                                <option value="Χώρα Αμοργού">Χώρα Αμοργού</option>
                                <option value="Αιγιάλη">Αιγιάλη</option>
                                <option value="Κατάπολα">Κατάπολα</option>
                                <option value="Άλλος">Άλλο</option>
                            </select>
                        </div>
                        <input type="url" name="link" id="link"
                            placeholder="Link προς εξωτερικό URL, π.χ., Facebook/Instagram/Επίσημο site, κτλ"
                            required="">
                        <div class="one temp">
                            <label>Επιθυμώ σύνδεση με το παραπάνω URL</label>
                            <input class="chkbtn" value="yes" type="checkbox" id="link_confirmation" name="link_confirmation" name="use_url">
                        </div>
                        <div class="text-xs-center">
                            <div class="g-recaptcha" data-sitekey="6LfbXNIpAAAAABFh4_XvMajKo0wEkQIS1JCyhQfJ"></div>
                        </div>
                        <button>Ready!</button>
                    </form>
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
            <div class="tag">>Παουλιν Κομινι - Χρήστος Παπαδόπουλος-2024</div>
        </div>
    </div>
</body>
    <script  src="./scripts/create_page.js">
        function myFunction(x) {
            x.classList.toggle("change");
        }
    </script>
    <script  src="./scripts/create_page_login.js"></script>

</html>
