<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Find Rooms</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="./css_files/panels.css">

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
    <main>
    <section class="center">       
        <div class="panel">
            <div class="profile">
                <div class="profile__info">
                <p>Name: <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?></p>
                <p>Email: <?php echo $_SESSION['email']; ?></p>
                <p>Created At: <?php echo $_SESSION['created_at']; ?></p>
                <p>User ID: <?php echo $_SESSION['user_id']; ?> </p>

                    <?php if ($_SESSION['username'] == 'HASH') { ?>
                        <li><a href="admin_panel.php">Admin Panel</a></li>
                    <?php } ?>

                    <div class="btn_container">
                        <div class="btn">
                            <button class="edit">
                                <i class="fa-solid fa-edit"></i>
                            </button>
                        </div>
                        <div class="btn">
                            <button class="delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="room-list">

                <div class="create-room">
                    <a href="./create-page.php"><button><i class="fa-solid fa-plus"></i></button></a>
                </div>

                <div id="roomsContainer" class="rooms"></div>

            </div>

        </div>

    </main>
    </section>

</body>
<script src="./scripts/fetch-control-panel.js"></script>
<script>
        function myFunction(x) {
            x.classList.toggle("change");
        }
    </script>

</html>
