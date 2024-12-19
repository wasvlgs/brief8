
<?php


    require '../database.php';
    session_start();
    if(!isset($_SESSION['id'])){
        session_destroy();
        echo '<script>location.replace("../login/login.php")</script>';
    }

    if(isset($_POST['logout'])){
        session_destroy();
        echo '<script>location.replace("../index.php")</script>';
    }



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard - Chef's Culinary Experience</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Modal styles */
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 500px;
            width: 100%;
        }
    </style>
</head>
<body class="bg-gray-50 text-gray-800">

    <div class="min-h-screen flex flex-col">

        <header class="bg-yellow-500 text-white py-4 shadow-md">
            <div class="container mx-auto px-6 flex justify-between items-center max-sm:flex-col max-sm:gap-4">
                <h1 class="text-2xl font-bold">Yemmy</h1>
                <form method="post">
                    <a href="menu.php" class="text-white hover:underline mx-2">Home</a>
                    <a href="reservation.php" class="text-white hover:underline mx-2">My Reservations</a>
                    <button type="submit" name="logout" class="text-white hover:underline mx-2">Logout</button>
                </form>
            </div>
        </header>

        <!-- Main Content -->
        <main class="container mx-auto px-6 py-8">
            <!-- Menus Section -->
            <section class="mb-12">
                <h2 class="text-3xl font-bold text-gray-800 mb-6">Available Menus</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <!-- Menu Card 1 -->

                <?php

                    if($cnx){
                        $getData = $cnx->prepare("SELECT * FROM menus");
                        if($getData->execute()){
                            $result = $getData->get_result();
                            foreach($result as $menu){
                        echo '<div class="bg-white shadow-md rounded-lg overflow-hidden">
                        <img src="../img/menus/'.$menu['imgSrc'].'" alt="'.$menu['titre'].'" class="w-full h-48 object-cover">
                        <div class="p-4">
                            <h3 class="text-xl font-semibold text-gray-800">'.$menu['titre'].'</h3>
                            <p class="text-gray-600 mt-2">$'.$menu['prix'].'</p>

                            <div class="mt-4 overflow-y-auto max-h-[300px]">
                                <h4 class="font-semibold text-gray-800">Dishes:</h4>
                                <div class="mt-2">';

                                $getID = $menu['ID_menu'];
                                $getPlats = $cnx->prepare("SELECT * FROM plats WHERE ID_menu = ?");
                                $getPlats->bind_param("i",$getID);
                                if($getPlats->execute()){
                                    $resultPlats = $getPlats->get_result();
                                    foreach($resultPlats as $plat){
                                        echo '<div class="mt-4">
                                        <h5 class="text-lg font-semibold text-gray-800">Plat 1: '.$plat['Titre'].'</h5>
                                        <img src="../img/menus/'.$plat['imgSrc'].'" alt="Plat Image" class="w-32 h-32 object-cover">
                                        <p class="text-gray-600 mt-2">'.$plat['Description'].'</p>
                                    </div>
                                    </div>
                                        ';
                                    }
                                }
                        
                            echo ' <button onclick="openModal('.$menu['ID_menu'].')" class="mt-4 w-full py-2 px-4 bg-yellow-500 text-white font-medium rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500">Reserve Now</button>
                        </div>
                    </div>';
                            }
                        }
                    }



                ?>

            </section>
        </main>

        <!-- Reservation Modal -->
        <div id="reservationModal" class="modal hidden">
            <div class="modal-content">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Make a Reservation</h2>
                <form method="POST" class="space-y-6" id="formReserve">

                    <!-- Date Field -->
                    <div>
                        <label for="date" class="block text-sm font-medium text-gray-700">Select Date</label>
                        <input type="date" id="date" name="date" class="mt-1 w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500"
                        />
                    </div>

                    <!-- Time Field -->
                    <div>
                        <label for="time" class="block text-sm font-medium text-gray-700">Select Time</label>
                        <input type="time" id="time" name="time" class="mt-1 w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500"
                        />
                    </div>

                    <!-- Number of People Field -->
                    <div>
                        <label for="people" class="block text-sm font-medium text-gray-700">Number of People</label>
                        <input type="number" id="people" name="people" min="1" class="mt-1 w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500"
                        />
                    </div>

                    <!-- Submit Button -->
                    <button id="confirm" name="confirm" type="submit" class="w-full py-3 px-4 bg-yellow-500 text-white font-medium rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                    >
                        Confirm Reservation
                    </button>
                </form>
                <button onclick="closeModal()" class="mt-4 w-full py-2 px-4 bg-red-500 text-white font-medium rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">Close</button>
            </div>
        </div>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-6 mt-auto">
            <div class="container mx-auto text-center">
                <p>&copy; 2024 Chef's Culinary Experience. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <script src="../js/script.js"></script>
    <script>
        
            function openModal(id) {
                document.getElementById("confirm").value = id;
                document.getElementById('reservationModal').style.display = 'flex';
            }

            function closeModal() {
                document.getElementById('reservationModal').style.display = 'none';
            }

        document.addEventListener("DOMContentLoaded",()=>{

            checkReserveUser();
        })
    </script>
</body>
</html>
