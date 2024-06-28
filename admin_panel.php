<?php
session_start();
if (!isset($_SESSION['role'] ) || ($_SESSION['role'] != 'admin')) { 
    header("Location: ./sign-up.php");  //Feature is not implemented yet
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Amorgos rooms</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <link rel="stylesheet" href="./css_files/panels.css">

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
    <main>
        <div class="panel">
            <div class="profile">
                <div class="profile__info">
                    <h2>Admin Panel</h2>

                    <div class="filters">
                        <label for="search">Search:</label>
                        <input type="text" name="search" id="search" class="search">
                        <div class="custom-select">
                            <select class="area" id="area">
                                <option value="all">Διαλέξτε περιοχή</option>
                                <option value="Χώρα Αμοργού">Χώρα Αμοργού</option>
                                <option value="Αιγιάλη">Αιγιάλη</option>
                                <option value="Κατάπολα">Κατάπολα</option>
                                <option value="Άλλο">Άλλο</option>
                            </select>
                        </div>
                        <div class="custom-select">
                            <select class="area" id="state">
                                <option value="unapproved">Mη εγκεκριμένος</option>
                                <option value="approved">Εγκρίθηκε</option>
                                <option value="all">Ολοι</option>
                            </select>
                        </div>

                        <div class="custom-select">
                            <select class="area" id="order">
                                <option value="DESC">Φθίνουσα σειρά</option>
                                <option value="ASC">Αύξουσα σειρά</option>
                            </select>
                        </div>

                    </div>
                </div>
            </div>
            <div class="room-list">

                <!-- <div class="create-room">
                    <a href="./create_page.html"><button><i class="fa-solid fa-plus"></i></button></a>
                </div> -->

                <div id="roomsContainer" class="rooms"></div>

            </div>

        </div>

    </main>
</section>

</body>
<script src="./scripts/admin_fetch.js"></script>
<script>
    function myFunction(x) {
        x.classList.toggle("change");
    }
</script>

</html>
