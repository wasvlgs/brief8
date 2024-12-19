
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
    <title>My Reservations - Chef's Culinary Experience</title>
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


<div id="success" class="w-full z-10 h-[65px] fixed top-0 left-0 hidden rounded-[5px] border-2 border-[green] text-[#49de49] font-semibold items-center pl-10 bg-[#052c05]" role="alert">
  Edited succesfuly!
</div>
<div id="removed" class="w-full z-10 h-[65px] fixed top-0 left-0 hidden rounded-[5px] border-2 border-[green] text-[#49de49] font-semibold items-center pl-10 bg-[#052c05]" role="alert">
  Removed succesfuly!
</div>
<div id="error" class="w-full z-10 h-[65px] hidden fixed top-0 left-0 rounded-[5px] border-2 border-[red] text-[#972a2a] font-semibold items-center pl-10 bg-[#2c0505]" role="alert">
  Error try again!
</div>


    <!-- Container -->
    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
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

                    <!-- Place Field -->
                    <div>
                        <label for="adresse" class="block text-sm font-medium text-gray-700">Select Adresse</label>
                        <input type="text" id="adresse" name="adresse" class="mt-1 w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500"
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









        <!-- Main Content -->
        <main class="container mx-auto px-6 py-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-6">My Reservations</h2>
            <!-- Reservation List -->
            <div class="bg-white shadow-md rounded-lg overflow-auto">
                <!-- Table -->
                <table class="min-w-full table-auto border-collapse">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="py-4 px-6 text-left font-medium">Date</th>
                            <th class="py-4 px-6 text-left font-medium">Time</th>
                            <th class="py-4 px-6 text-left font-medium">Menu</th>
                            <th class="py-4 px-6 text-left font-medium">Guests</th>
                            <th class="py-4 px-6 text-left font-medium">Status</th>
                            <th class="py-4 px-6 text-center font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <!-- Example Reservation -->

                        <?php

                            if($cnx){
                                $getUserId = $_SESSION['id'];
                                $getReservation = $cnx->prepare("SELECT * FROM reservation INNER JOIN menus ON reservation.ID_menu = menus.ID_menu WHERE ID_user = ?");
                                $getReservation->bind_param("i",$getUserId);
                                if($getReservation->execute()){
                                    $result = $getReservation->get_result();
                                    foreach($result as $reserve){
                                        $getColor;
                                        $getButtons;
                                        if($reserve['statut'] == "Pending"){
                                            $getColor = "amber-400";
                                            $getButtons = '<button name="remove" value="'.$reserve['ID_reservation'].'" class="text-sm py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">Cancel</button>
                                <button type="button" onclick="openModal('.$reserve['ID_reservation'].',`'.$reserve['Date_reservation'].'`,`'.$reserve['Time_reservation'].'`,`'.$reserve['Adresse'].'`,'.$reserve['places_disponibles'].')" class="text-sm py-2 px-4 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 ml-2">Modify</button>';
                                        }else if($reserve['statut'] == "Confirmed"){
                                            $getColor = "green-600";
                                            $getButtons = '<button name="remove" value="'.$reserve['ID_reservation'].'" class="text-sm py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">Cancel</button>';
                                        }
                                        echo '<tr class="border-t">
                            <td class="py-4 px-6">'.$reserve['Date_reservation'].'</td>
                            <td class="py-4 px-6">'.$reserve['Time_reservation'].'</td>
                            <td class="py-4 px-6">'.$reserve['titre'].'</td>
                            <td class="py-4 px-6">'.$reserve['places_disponibles'].'</td>
                            <td class="py-4 px-6 text-'.$getColor.' font-medium">'.$reserve['statut'].'</td>
                            <td class="py-4 px-6 text-center"><form method="post">
                                '.$getButtons.'</form>
                            </td>
                        </tr>';
                                    }
                                }
                            }
                        ?>
                        <!-- <tr class="border-t">
                            <td class="py-4 px-6">2024-12-20</td>
                            <td class="py-4 px-6">7:00 PM</td>
                            <td class="py-4 px-6">Gourmet French Dinner</td>
                            <td class="py-4 px-6">2</td>
                            <td class="py-4 px-6 text-green-600 font-medium">Confirmed</td>
                            <td class="py-4 px-6 text-center">
                                <button class="text-sm py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500">Cancel</button>
                                <button class="text-sm py-2 px-4 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 ml-2">Modify</button>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </main>

        


        <?php


            if(isset($_POST['confirm'])){
                $getMenuId = strip_tags($_POST['confirm']);
                $getDate = strip_tags($_POST['date']);
                $getTime = strip_tags($_POST['time']);
                $getAdresse = htmlspecialchars($_POST['adresse']);
                $nomberPeople = strip_tags($_POST['people']);

                if($cnx){
                    $getReserveId = strip_tags($_POST['confirm']);
                    $addReservation = $cnx->prepare("UPDATE reservation SET Date_reservation = ?, Time_reservation = ?, Adresse = ?, places_disponibles = ? WHERE ID_reservation = ?");
                    $addReservation->bind_param("sssii",$getDate,$getTime,$getAdresse,$nomberPeople,$getReserveId);
                    if($addReservation->execute())
                        echo '<script>document.getElementById("success").style.display = "flex";
                        setTimeout(()=>{
                            document.getElementById("success").style.display = "none";
                            
                        },1000)
                        </script>';
                    }else{
                        echo '<script>document.getElementById("error").style.display = "flex";
                                    setTimeout(()=>{
                                        document.getElementById("error").style.display = "none";
                                    },1000)
                                    </script>';
                    }
                }

                if(isset($_POST['remove'])){
                    if($cnx){
                        $getIdReservation = strip_tags($_POST['remove']);
                        $removeReservation = $cnx->prepare("DELETE FROM reservation WHERE ID_reservation = ?");
                        $removeReservation->bind_param("i",$getIdReservation);
                        if($removeReservation->execute()){
                            echo '<script>document.getElementById("removed").style.display = "flex";
                                    setTimeout(()=>{
                                        document.getElementById("removed").style.display = "none";
                                    },1000)
                                    </script>';
                        }
                    }
                }


            



        ?>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-6 mt-auto">
            <div class="container mx-auto text-center">
                <p>&copy; 2024 Chef's Culinary Experience. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <script src="../js/script.js"></script>
    <script>
        
            function openModal(id,date,time,adresse,people) {
                document.getElementById("confirm").value = id;
                document.getElementById("reservationModal").style.display = "flex";
                document.getElementById("date").value = date;
                document.getElementById("time").value = time;
                document.getElementById("adresse").value = adresse;
                document.getElementById("people").value = people;
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
