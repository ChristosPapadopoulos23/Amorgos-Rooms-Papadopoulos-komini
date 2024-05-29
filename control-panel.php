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

    <link rel="stylesheet" href="./styles/nav-bar.css">
    <link rel="stylesheet" href="./styles/find-rooms.css">
    <link rel="stylesheet" href="./css_files/panels.css">

</head>

<body>
    <main>

        <div class="panel">
            <div class="profile">
                <div class="profile__info">
                <p>Name: <?php echo $_SESSION['first_name'] . ' ' . $_SESSION['last_name']; ?></p>
                <p>Email: <?php echo $_SESSION['email']; ?></p>
                <p>Created At: <?php echo $_SESSION['created_at']; ?></p>

                    <?php if ($_SESSION['username'] == 'HASH') { ?>
                        <li><a href="admin_panel.php">Admin Panel</a></li>
                    <?php } ?>

                    <div class="btn">
                        <button class="edit">
                            <i class="fa-solid fa-edit"></i>
                        </button>
                        <button class="delete">
                            <i class="fa-solid fa-trash"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div class="room-list">

                <div class="create-room">
                    <a href="./create-page.php"><button><i class="fa-solid fa-plus"></i></button></a>
                </div>

                <div class="room">
                    <img src="media/church.jpg" alt="room1">
                    <div class="room-info">
                        <h3>Rooms Julia</h3>
                        <p>Location: Xwra Amorgou</p>
                        <p>Phone: 2324234234</p>
                        <p>Email: info@gmail.com</p>
                        <p id="Description"> Description:<br>Lorem ipsum dolor, sit amet consectetur adipisicing elit. 
                            Quo obcaecati perferendis laborum quas deserunt sed reprehenderit architecto 
                            nisi incidunt et facilis numquam mollitia, sint libero nemo hic molestiae, eum ipsam.
                        </p>

                        <div class="btn">
                            <button class="edit">
                                <i class="fa-solid fa-edit"></i>
                            </button>
                            <button class="delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </main>


</body>
<script src="./scripts/mobile-nav.js"></script>
<script src="./scripts/fetch-control-panel.js"></script>


</html>
