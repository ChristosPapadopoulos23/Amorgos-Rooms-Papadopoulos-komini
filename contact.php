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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=STIX+Two+Text:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <script src="https://www.google.com/recaptcha/api.js" async defer></script>

    <link rel="stylesheet" href="css_files/style_contact.css">
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
                <form action="./server/contact.php" method="POST">
                    <label class="lbl">Πληροφορίες Επικοινωνίας</label>

                    <input type="email" name="b_email" id="b_email" readonly>
                    <div class="one">
                        <input type="text" id="name" name="name" placeholder="Όνομα" required="">
                        <input type="text" id="sname" name="sname" placeholder="Επίθετο" required="">
                    </div>
                    <div class="one">
                        <input type="email" id="email" name="email" placeholder="Email" required="">
                        <input class="four" id="phone" type="text" name="phone" placeholder="Τηλέφωνο επικοινωνίας" required="">
                    </div>
                    <div class="two">
                        <div class="num">
                            <label>Δωμάτια</label>
                            <input name="room" id="room_number" type="number" min="1" max="100" value="1" step="1" required="">
                        </div>
                        <div class="num">
                            <label>Ενήλικες</label>
                            <input name="adults" id="adults" type="number" min="1" max="100" value="2" step="1" required="">
                        </div>
                        <div class="num">
                            <label>Παιδιά</label>
                            <input name="kids" id="kids" type="number" min="0" max="100" value="0" step="1" required="">
                        </div>
                    </div>
                    <div class="two">
                        <div class="date">
                            <label>Άφιξη</label>
                            <input name="arrival" id="arrival" class="date-input" type="date" required="">
                        </div>
                        <div class="date">
                            <label>Αναχώριση</label>
                            <input name="return" id="return" class="date-input" type="date" required="">
                        </div>
                    </div>
                    <div class="one">
                        <div class="date">
                            <label>Ευέλικτες Ημερομηνίες;</label>
                            <input class="chkbtn" type="checkbox" value="yes" name="flexibility">
                        </div>
                        <div class="date">
                            <label>Κατοικίδιο;</label>
                            <select class="pet" name="pet">
                                <option value="Κανένα">Όχι</option>
                                <option value="Σκύλος">Σκύλος</option>
                                <option value="Γάτα">Γάτα</option>
                                <option value="Άλλο">Άλλο</option>
                            </select>
                        </div>
                    </div>
                    <div class="num">
                        <label>Σχόλια/Ερωτήσεις</label>
                        <textarea class="txtfield" rows="15" name="comments"
                            placeholder="Γράψτε εδώ τα σχόλια σας...."></textarea>
                    </div>
                    <div class="text-xs-center">
                        <div class="g-recaptcha" data-sitekey="6LfbXNIpAAAAABFh4_XvMajKo0wEkQIS1JCyhQfJ"></div>
                    </div>
                    <button>ΥΠΟΒΟΛΗ</button>
                </form>
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
</body>
<script src="./scripts/contact.js"></script>
<script>
    // Function to get query parameter value by name
    function getQueryParam(name) {
        const urlParams = new URLSearchParams(window.location.search);
        return urlParams.get(name);
    }

    // Get the 'value' parameter from the URL
    const emailValue = getQueryParam('value');

    // If 'value' parameter exists, set it to the display and hidden email input fields
    if (emailValue) {
        document.getElementById('b_email').value = emailValue;
    }

    console.log(emailValue);

</script>
</html>