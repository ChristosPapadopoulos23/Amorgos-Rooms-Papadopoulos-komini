<?php
session_start();
$action = isset($_GET['action']) ? (int)$_GET['action'] : null;
if( isset($_GET['id']) &&  isset($_GET['action'])){
    $uid = isset($_GET['id']) ? (int)$_GET['id'] : null;
    if (!isset($_SESSION['role']) || (($_SESSION['role'] != 'admin') && ($_SESSION['id'] != $uid))) { 
        header("Location: ./sign-up.php");
        exit(0);
    }   
    require_once './server/logs.php';
    require_once './server/db_connection.php';

    $sql = "SELECT * FROM UsersTable WHERE id=$uid";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $phone=$row['phone'];
    $email=$row['email'];
    $user=$row['username'];
    $name=$row['first_name'];
    $surname=$row['last_name'];
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title> Amorgos-rooms</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com/" crossorigin>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link href="https://fonts.googleapis.com/css2?family=STIX+Two+Text:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="css_files/style_sign_in.css">
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
        <script>
            function myFunction(x) {
                x.classList.toggle("change");
            }

        </script>
        <label class="logo">Amorgos Rooms</label>
        <ul>
            <li><a href="index.php">Home</a></li>
            <li><a href="find-a-room.php">Find Rooms</a></li>
            <li><a href="more.php">Information</a></li>

            <?php if (isset($_SESSION['user_id'])) { ?>
                <li><a class="menu" href="control-panel.php">Control Panel</a></li>
                <li><a class="menu" href="./server/log-out.php">Log out</a></li>
            <?php } else { ?>
                <li><a class="menu" href="sign-up.php">Sign Up/Log in</a></li>
            <?php } ?>

        </ul>
    </nav>
    <section id=center class="center">
        <div id="succes-sign-up" class="overlay">
            <div class="popup">
                <h2>Επιτυχία!</h2>
                <a class="close" href="#">&times;</a>
                <div class="content">
                    Σας ευχαριστούμε για την εγγραφή σας! Θα σας σταλεί email οταν ένας απο τους διαχειρηστές μας σας εκγρίνει!
                </div>
            </div>
        </div>
        <div id="user-exists" class="overlay">
            <div class="popup">
                <h2>Όνομα χρήστη υπάρχει!</h2>
                <a class="close" href="#">&times;</a>
                <div class="content">
                    Παρακαλώ δώστε ξανά τις πληροφορίες. 
                    Το όνομα χρήστη που δώσατε χρησημοποιείται απο άλλο λογαριασμό
                </div>
            </div>
        </div>
        <div id="wrong-data" class="overlay">
            <div class="popup">
                <h2>Λανθασμένα στοιχεία χρήστη!</h2>
                <a class="close" href="#">&times;</a>
                <div class="content">
                    Λάθoς όνομα πρόσβασης η λάθος κωδικός χρήστη!
                </div>
            </div>
        </div>
        <div id="Not-accepted" class="overlay">
            <div class="popup">
                <h2>Μη εγκεκριμένος λογαριασμός!</h2>
                <a class="close" href="#">&times;</a>
                <div class="content">
                    Αυτός ο χρήστης δεν έχει αποδεχτεί απο τον διαχειριστή!
                    Παρακαλώ περιμένετε να εγκριθεί ο λογαριασμός σας!
                </div>
            </div>
        </div>

        <div id="main" class="main">
            <input type="checkbox" id="chk" aria-hidden="true">

            <div class="signup">
                <form id="edit" action="./server/sign-up.php" method="POST" onsubmit="return validateSignUp();" id="signup-form">
                    <label id="sign_in_lbl" class="form" for="chk" aria-hidden="true">Sign up</label>
                    <div class="one">
                        <input type="text" id="name" name="name" placeholder="Όνομα" required="">
                        <input type="text" id="lastname" name="lastname" placeholder="Επώνυμο" required="">
                    </div>
                   <!-- <div class="one">-->
                      <!--  <input class="three" type="text" id="business_name" name="business_name"
                            placeholder="Όνομα επιχείρησης" required="" -->
                        <input class="four" type="email" id="email" name="email" placeholder="Email" required="">
                   <!-- </div>-->
                    <div class="one">
                        <input type="text" id="username" name="username" placeholder="User name" required="">
                        <input type="text" id="phone" name="phone" maxlength="15" minlength="10" placeholder="Τηλέφωνο"
                            required="">
                    </div>
                    <div class="one">
                        <input type="password" id="password" name="password" placeholder="Password" required="">
                        <input type="password" id="cpassword" name="cpassword" placeholder="Confirm password" required="">
                    </div>
                    <div id="loginMessage"></div>
                    <button id="sign_in_btn" type="submit">Sign up</button>  

                </form>
            </div>

            <div id="lgn_frm" class="login">
                <form action="./server/log-in.php" method="POST" id="login-form">
                    <label class="form" for="chk" aria-hidden="true">Login</label>
                    <input type="text" id="username" name="username" placeholder="Username" required="">
                    <input type="password" id="password" name="password" placeholder="Password" required="">
                    <button>Login</button>
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
            <div class="tag">>Παουλιν Κομινι - Χρήστος Παπαδόπουλος-2024</div>
        </div>
    </div>
</body>
<script>
     action = "<?php echo $action;?>";
    function change_values() {
        id="<?php echo $uid;?>"
        document.getElementById('name').value="<?php echo $name;?>";
        document.getElementById('lastname').value="<?php echo $surname;?>";
        document.getElementById('phone').value="<?php echo $phone;?>";
        document.getElementById('username').value="<?php echo $user;?>";
        document.getElementById('email').value="<?php echo $email;?>";
        document.getElementById('username').disabled=true;
        document.getElementById('password').style.display="none";
        document.getElementById('password').removeAttribute('required');
        document.getElementById('cpassword').style.display="none";
        document.getElementById('cpassword').removeAttribute('required');
        document.getElementById('lgn_frm').style.display="none";
        document.getElementById('main').style.height="fit-content";
        document.getElementById('sign_in_lbl').innerHTML="Edit Info";
        document.getElementById('sign_in_btn').innerHTML="Confirm changes";
        document.getElementById('sign_in_btn').style.marginBottom="20px";
        document.getElementById('edit').action="./server/edit_user.php?id="+id;
    };
     System.out.println(action);
    if(action!=null)
    window.addEventListener('load', change_values);
</script>
<script src="./scripts/sing_up.js"></script>
</html>
