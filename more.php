<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html;" charset="UTF-8">
    <title> Amorgos-rooms</title>
    <link href="https://fonts.googleapis.com/css2?family=STIX+Two+Text:ital,wght@0,400..700;1,400..700&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="stylesheet" href="css_files/style_more.css">
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
            <li><a class="menu active" href="more.php">Information</a></li>

            <?php if (isset($_SESSION['user_id'])) { ?>
                <li><a class="menu" href="control-panel.php">Control Panel</a></li>
                <li><a class="menu" href="./server/log-out.php">Log out</a></li>
            <?php } else { ?>
                <li><a class="menu" href="sign-up.php">Sign Up/Log in</a></li>
            <?php } ?>

        </ul>
    </nav>

    <section class="center">
        <label class="title">Information</label>
        <div class="text">
            <img class="pic1" src="./media/church.jpg">
            <P class="chapter">Amorgos Rooms</P>
            </p>
            Καλώς ήρθατε στο Amorgos Rooms, τον ιστότοπο που σας επιτρέπει να ανακαλύψετε την ομορφιά και τη φιλοξενία
            του νησιού της Αμοργού. Αναζητήστε τα ιδανικά δωμάτια για τη διαμονή σας στην Αμοργό και επικοινωνήστε μαζί
            μας για να κάνετε την κράτησή σας άμεσα και εύκολα.
            </p><br>
            <p>
                Με την ευρεία ποικιλία δωματίων που προσφέρουμε, από παραδοσιακά στούντιο μέχρι πολυτελείς σουίτες με
                θέα στη θάλασσα, βρίσκουμε το ιδανικό κατάλυμα για κάθε τύπο επισκέπτη. Με μια απλή αναζήτηση, μπορείτε
                να βρείτε το δωμάτιο που σας ταιριάζει και να επικοινωνήσετε μαζί μας για να ολοκληρώσετε την κράτησή
                σας.
            </p>
            <P class="chapter">Αξιοθέατα</P>
            <P>
                Η Αμοργός είναι γνωστή για τη μοναδική της φυσική ομορφιά και τα εντυπωσιακά αξιοθέατά της. Ανάμεσα στα
                δημοφιλή αξιοθέατα περιλαμβάνονται οι καταπληκτικές παραλίες όπως η Καταπόλα, η Αγία Άννα και η Αιγιάλη,
                με τα κρυστάλλινα νερά τους και τις εντυπωσιακές ακτογραμμές. Οι επισκέπτες μπορούν επίσης να
                επισκεφτούν το Μοναστήρι της Παναγίας Χοζοβιώτισσας, ένα από τα σημαντικότερα θρησκευτικά και
                πολιτιστικά μνημεία του νησιού, καθώς και το Κάστρο της Χώρας, ένα μεσαιωνικό φρούριο που προσφέρει
                εκπληκτική θέα στο Αιγαίο Πέλαγος. Επίσης, οι επισκέπτες μπορούν να ανακαλύψουν τα μονοπάτια της
                Αμοργού, που οδηγούν σε απομονωμένες παραλίες και θέατρα απόλυτης ειρήνης και ομορφιάς. </p>
            <img class="pic2" src="./media/beach.jpg">
            <P class="chapter">Πανηγύρια και Γιορτές</P>
            <p>Η Αμοργός είναι γνωστή για τα πολλά πανηγύρια και τις γιορτές της, οι οποίες αποτελούν μέρος της τοπικής
                παράδοσης και πολιτισμού. Ανακαλύψτε τον πλούτο των τοπικών εορτών και γιορτών και ενσωματώστε τις στις
                διακοπές σας στην Αμοργό για μια αξέχαστη εμπειρία.
            </p><br>
            <p>
                Ανάμεσα στις δημοφιλείς γιορτές περιλαμβάνονται οι εορτές των Αγίων Πάντων, του Αγίου Νικολάου και της
                Παναγίας, καθώς και τα πανηγύρια των χωριών του νησιού.Κατά τη διάρκεια των πανηγυριών και των γιορτών,
                οι ντόπιοι και οι επισκέπτες συγκεντρώνονται στις πλατείες και τις εκκλησίες των χωριών, όπου
                διοργανώνονται ποικίλες εκδηλώσεις και εορταστικά προγράμματα. Οι παραδοσιακοί χοροί και η μουσική
                αποτελούν αναπόσπαστο μέρος των εκδηλώσεων, ενώ το τοπικό φαγητό και τα ποτά κυλούν ελεύθερα,
                δημιουργώντας μια ατμόσφαιρα γεμάτη ενθουσιασμό και χαρά
            </p><br>
            <p>
                Οι επισκέπτες που έρχονται στην Αμοργό κατά τη διάρκεια των πανηγυριών και των γιορτών έχουν την
                ευκαιρία να αισθανθούν τον παλμό της τοπικής ζωής, να γνωρίσουν τους ντόπιους και να απολαύσουν την
                αυθεντική φιλοξενία και τη ζεστασιά που προσφέρει η κοινότητα του νησιού. </p>
            <img class="pic3" src="./media/easter.jpg">
            <br><br>
            <P class="chapter">Πασχα στην Αμοργό</P>
            <p>Το Πάσχα στην Αμοργό είναι μια ξεχωριστή εμπειρία για τους επισκέπτες και τους ντόπιους. Κατά τη διάρκεια
                αυτής της περιόδου, ο νησίτης πληθυσμός και οι επισκέπτες συμμετέχουν σε διάφορες θρησκευτικές,
                παραδοσιακές και κοινωνικές εκδηλώσεις.</p>
            <br>
            <p>Το Πάσχα είναι ένας σημαντικός χριστιανικός εορτασμός, και η Αμοργός τον εορτάζει με ιδιαίτερο τρόπο. Οι
                τελετές της Ανάστασης λαμβάνουν χώρα σε κάθε γωνιά του νησιού, με τους κατοίκους και τους επισκέπτες να
                συγκεντρώνονται στις εκκλησίες και στις πλατείες για να παρακολουθήσουν τις τελετές και να ανταλλάξουν
                ευχές.</p>
            <p>Μετά την τελετή της Ανάστασης, οι Αμοργιανοί συγκεντρώνονται στα σπίτια τους για να απολαύσουν ένα
                παραδοσιακό γεύμα με πλούσια τοπικά εδέσματα και κρασί.</p>
            <br>
            <p>Εκτός από τις θρησκευτικές τελετές, το Πάσχα στην Αμοργό συνοδεύεται από παραδοσιακές εκδηλώσεις και
                εορταστικές δραστηριότητες, όπως λαϊκά γλέντια, πανηγύρια, και παραδοσιακοί χοροί. Οι επισκέπτες έχουν
                την ευκαιρία να γνωρίσουν τον πολιτισμό και τις παραδόσεις του νησιού και να απολαύσουν μια μοναδική
                εμπειρία Πάσχα στην Αμοργό.</p>
        </div>
        <div class="text">
            <P class="chapter">Πασχα στην Αμοργό βίντεο</P>
            <video width="640" height="360" controls>
                <source src="./media/easter.mp4" type="video/mp4">
                Your browser does not support the video tag.
            </video>
            <br>
            <div class="link"><a href="https://www.youtube.com/watch?v=SgiTvtAxNhk">Μπορείτε να βρείτε το βίντεο εδώ</a>
            </div>
        </div>
        <div class="text">
            <img class="pic1" src="./media/fishing.jpg">
            <P class="chapter">Τοπικά εδέσματα</P>
            <p>Πέρα από τα αξιοθέατα και τις γιορτές, η Αμοργός είναι επίσης γνωστή για τα νόστιμα τοπικά εδέσματά της.
                Ανακαλύψτε τη γαστρονομική ποικιλία του νησιού και απολαύστε παραδοσιακές γεύσεις που αντικατοπτρίζουν
                την πλούσια παράδοση και την περιοχική κουζίνα της Αμοργού.</p><br>
            <p>Ανάμεσα στα δημοφιλή τοπικά εδέσματα περιλαμβάνονται η κοτόσουπα με τα τοπικά λαχανικά και τα αρωματικά
                μυρωδικά, τα χειροποίητα τυριά και τα αλλαντικά, καθώς και τα φρέσκα θαλασσινά πιάτα που προσφέρονται
                στις τοπικές ταβέρνες και τα εστιατόρια.</p><br>
            <p>Επιπλέον, δοκιμάστε τις τοπικές σπεσιαλιτέ, όπως η μυζήθρα, το καλαμαράκι με τα μακαρόνια (χταπόδι
                μακαρονάδα), τα κουλουράκια (κουλουράκια με μυζήθρα) και τα παραδοσιακά γλυκά, όπως η καρυδόπιτα και οι
                μελομακάρονα.</p><br>
            <p>Αφεθείτε στις γεύσεις της τοπικής κουζίνας και ανακαλύψτε την αυθεντική γεύση της Αμοργού, καθώς
                εξερευνάτε το νησί και απολαμβάνετε την φιλοξενία των ντόπιων.</p>
            <br><br>
            <P class="chapter">Παραδoσιακή γαστρονομία</P>
            <img class="pic2" src="./media/food.jpg">
            <p>Το πατατάτο είναι ένα παραδοσιακό φαγητό της Αμοργού που αποτελεί ένα από τα αγαπημένα εδέσματα κατά τις
                γιορτές και τα πανηγύρια του νησιού. Αυτό το πιάτο έχει βαθιές ρίζες στην τοπική κουζίνα και αποτελεί
                ένα σημαντικό μέρος της γαστρονομικής κληρονομιάς της Αμοργού.</p><br>
            <p>Το πατατάτο συνήθως περιλαμβάνει την τοπική πατάτα της Αμοργού, η οποία έχει ξεχωριστή γεύση και υφή. Οι
                πατάτες κόβονται σε λεπτές φέτες και τηγανίζονται μέχρι να γίνουν χρυσόκοκκες και τραγανές. Συνήθως
                σερβίρεται ζεστό, συχνά με συνοδευτικά όπως τοπικό τυρί, αγνή ελιά και ντομάτα.</p><br>
            <p>Η παραδοσιακή συνταγή του πατατάτου μπορεί να ποικίλλει ανάλογα με τις προτιμήσεις και τα τοπικά υλικά
                που είναι διαθέσιμα. Ωστόσο, η βασική ιδέα πίσω από αυτό το πιάτο παραμένει η ίδια: να προσφέρει μια
                γευστική εμπειρία που αντικατοπτρίζει την πλούσια γαστρονομική κληρονομιά της Αμοργού.</p>
            <P class="chapter">Ταξιδιωτικός οδηγός</P>
            <div class="link2"> <a href="https://goaskalocal.com/blog/travel-guide-to-amorgos-greece">
                    A Local's Guide to Visiting Amorgos, Greece</a></div>

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