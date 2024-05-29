<?php
session_start();
if (!isset($_SESSION['username'])) {  // TODO will check if the user is an admin now this is not the case
    header("Location: ./sign-up.php");  //Feature is not implemented yet
    exit();
}
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

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

</head>

<body>
    <main>

        <div class="panel">
            <div class="profile">
                <div class="profile__info">
                    <h2>Admin Panel</h2>

                    <div class="filters">
                        <label for="search">Search:</label>
                        <input type="text" name="search" id="search" class="search">
                        <div class="custom-select">
                            <select class="area" id="Location">
                                <option value="all">Διαλέξτε περιοχή</option>
                                <option value="aijialh">Χώρα Αμοργού</option>
                                <option value="thalaria">Αιγιάλη</option>
                                <option value="lagkada">Κατάπολα</option>
                                <option value="Άλλος">Άλλο</option>
                            </select>
                        </div>
                        <div class="custom-select">
                            <select class="area" id="State">
                                <option value="unapproved">Un-Approved</option>
                                <option value="approved">Approved</option>
                                <option value="rejected">Rejected</option>
                                <option value="all">All</option>
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

                <!-- <div class="room">
                    <img src="media/church.jpg" alt="room1">
                    <div class="room-info">
                        <h3>Rooms Julia</h3>
                        <p><b>Location:</b> Xwra Amorgou</p>
                        <p><b>Phone:</b> 2324234234</p>
                        <p><b>Email:</b> info@gmail.com</p>
                        <p id="Description"><b>Description:</b><br>Lorem ipsum dolor, sit amet consectetur adipisicing
                            elit.
                            Quo obcaecati perferendis laborum quas deserunt sed reprehenderit architecto
                            nisi incidunt et facilis numquam mollitia, sint libero nemo hic molestiae, eum ipsam.
                        </p>

                        <div class="btn">
                            <button class="approve">
                                <i class="fa-solid fa-check"></i>
                            </button>
                            <button class="edit">
                                <i class="fa-solid fa-edit"></i>
                            </button>
                            <button class="delete">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </div>
                    </div>
                </div> -->

            </div>

        </div>

    </main>


</body>
<script src="./scripts/admin_fetch.js"></script>

</html>