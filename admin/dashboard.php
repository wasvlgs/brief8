
<?php


    require '../database.php';
    session_start();
    if(!isset($_SESSION['id'])){
        session_destroy();
        echo '<script>location.replace("../login/login.php")</script>';
    }else{
        if($cnx){
            $getId = $_SESSION['id'];
            $getUser = $cnx->prepare("SELECT * FROM users INNER JOIN role ON users.type = role.ID_role WHERE ID_user = ?");
            $getUser->bind_param("i",$getId);
            if($getUser->execute()){
                $result = $getUser->get_result();
                $user = $result->fetch_assoc();
                if($user['titre'] != "admin"){
                    session_destroy();
                    echo '<script>location.replace("../login/login.php")</script>';
                }
            }else{
                session_destroy();
                echo '<script>location.replace("../login/login.php")</script>';
            }
        }
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
    <title>Admin Dashboard - Chef's Culinary Experience</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">



<div id="success" class="w-full z-10 h-[65px] fixed top-0 left-0 hidden rounded-[5px] border-2 border-[green] text-[#49de49] font-semibold items-center pl-10 bg-[#052c05]" role="alert">
  Approved succesfuly!
</div>
<div id="error" class="w-full z-10 h-[65px] fixed top-0 left-0 hidden rounded-[5px] border-2 border-[green] text-[#49de49] font-semibold items-center pl-10 bg-[#052c05]" role="alert">
    Rejected succesfuly!
</div>



    <div class="min-h-screen flex flex-col">
        <header class="bg-yellow-500 text-white py-4 shadow-md">
            <div class="container mx-auto px-6 flex justify-between items-center max-sm:flex-col max-sm:gap-4">
                <h1 class="text-2xl font-bold">Yemmy</h1>
                <form method="post">
                    <a href="dashboard.php" class="text-white hover:underline mx-2">Dashboard</a>
                    <a href="addmenu.php" class="text-white hover:underline mx-2">Add menu</a>
                    <a href="reservation.php" class="text-white hover:underline mx-2">reservation</a>
                    <a href="users.php" class="text-white hover:underline mx-2">Users</a>
                    <button type="submit" name="logout" class="text-white hover:underline mx-2">Logout</button>
                </form>
            </div>
        </header>


        <?php


            if($cnx){
                $getReservation = $cnx->prepare("SELECT * FROM reservation");
                if($getReservation->execute()){
                    $resultCountReservation = $getReservation->get_result();
                    $CountReservation =  $resultCountReservation->num_rows;
                

        ?>

        <main class="container mx-auto px-6 py-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-700">All Reservations</h2>
                    <p class="text-3xl font-bold text-blue-500 mt-4"><?php echo $CountReservation; }
            

            $getPendingReservation = $cnx->prepare("SELECT * FROM reservation WHERE statut = 'Pending'");
            if($getPendingReservation->execute()){
                $resultPendingReservation = $getPendingReservation->get_result();
                $CountPendingReservation =  $resultPendingReservation->num_rows;

            
            
            
            
            ?></p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-700">Pending Reservations</h2>
                    <p class="text-3xl font-bold text-yellow-500 mt-4"><?php echo $CountPendingReservation; }
            

            $getAprovedReservation = $cnx->prepare("SELECT * FROM reservation WHERE statut = 'Confirmed'");
            if($getAprovedReservation->execute()){
                $resultAprovedReservation = $getAprovedReservation->get_result();
                $CountAprovedReservation =  $resultAprovedReservation->num_rows;

            
            
            
            
            ?></p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-700">Aproved Reservations</h2>
                    <p class="text-3xl font-bold text-green-500 mt-4"><?php echo $CountAprovedReservation; }
            

            $getClient = $cnx->prepare("SELECT * FROM users INNER JOIN role ON role.ID_role = users.type WHERE titre = 'client'");
            if($getClient->execute()){
                $resultClient = $getClient->get_result();
                $CountClient =  $resultClient->num_rows;

            ?></p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-700">Clients Registered</h2>
                    <p class="text-3xl font-bold text-blue-500 mt-4"><?php echo $CountClient; }
            

            $getMenusCounter = $cnx->prepare("SELECT * FROM menus");
            if($getMenusCounter->execute()){
                $resultMenusCounter = $getMenusCounter->get_result();
                $CountMenusCounter =  $resultMenusCounter->num_rows;

            ?></p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-700">Menus</h2>
                    <p class="text-3xl font-bold text-red-500 mt-4"><?php echo $CountMenusCounter; }
            } 

            $getNextReserve = $cnx->prepare("SELECT * FROM reservation WHERE statut = 'Confirmed' ORDER BY ID_reservation LIMIT 1");
            if($getNextReserve->execute()){
                $resultNextReserve = $getNextReserve->get_result();
                $theReservation = $resultNextReserve->fetch_assoc();
                $getDate = $theReservation['Date_reservation'];
                $getAdresse = $theReservation['Adresse'];

            ?></p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-700">Next Reservation</h2>
                    <p class="text-xl text-gray-600 mt-4"><?php echo $getDate.' , '.$getAdresse; }?></p>
                </div>
            </div>
            <section class="bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold text-gray-800 mb-4">Manage Reservations</h2>
                <table class="min-w-full border-collapse border border-gray-200 overflow-auto">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="py-4 px-6 text-left font-medium">Date</th>
                            <th class="py-4 px-6 text-left font-medium">Time</th>
                            <th class="py-4 px-6 text-left font-medium">Client</th>
                            <th class="py-4 px-6 text-left font-medium">Menu</th>
                            <th class="py-4 px-6 text-center font-medium">Guests</th>
                            <th class="py-4 px-6 text-center font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <?php


                            if($cnx){
                                $getPenReserve = $cnx->prepare("SELECT * FROM reservation INNER JOIN users ON users.ID_user = reservation.ID_user INNER JOIN menus ON menus.ID_menu = reservation.ID_menu WHERE statut = 'Pending'");
                                if($getPenReserve->execute()){
                                    $resultPenReserve = $getPenReserve->get_result();
                                    $resultPenReserve->fetch_assoc();
                                    foreach($resultPenReserve as $penReserve){
                                        echo '<tr class="border-t">
                            <td class="py-4 px-6">'.$penReserve['Date_reservation'].'</td>
                            <td class="py-4 px-6">'.$penReserve['Time_reservation'].'</td>
                            <td class="py-4 px-6">'.$penReserve['prenom'].' '.$penReserve['nom'].'</td>
                            <td class="py-4 px-6">'.$penReserve['titre'].'</td>
                            <td class="py-4 px-6 text-center">'.$penReserve['places_disponibles'].'</td>
                            <td class="py-4 px-6 text-center"><form method="post">
                                <button value="'.$penReserve['ID_reservation'].'" name="approve" class="text-sm py-2 px-4 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">Approve</button>
                                <button value="'.$penReserve['ID_reservation'].'" name="reject" class="text-sm py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 ml-2">Reject</button>
                            </form></td>
                        </tr>';
                                    }
                                }
                            }


                            if(isset($_POST['approve'])){
                                $getIdReserve = strip_tags($_POST['approve']);
                                if($cnx){
                                    $aproveReserves = $cnx->prepare("UPDATE reservation SET statut = 'Confirmed' WHERE ID_reservation = ?");
                                    $aproveReserves->bind_param("i",$getIdReserve);
                                    if($aproveReserves->execute()){
                                        echo '<script>document.getElementById("success").style.display = "flex";
                                        setTimeout(()=>{
                                            document.getElementById("success").style.display = "none";
                                        },1000)
                                        </script>';
                                    }
                                }
                            }

                            if(isset($_POST['reject'])){
                                $getIdReserve = strip_tags($_POST['reject']);
                                if($cnx){
                                    $rejectReserves = $cnx->prepare("DELETE FROM reservation WHERE ID_reservation = ?");
                                    $rejectReserves->bind_param("i",$getIdReserve);
                                    if($rejectReserves->execute()){
                                        echo '<script>document.getElementById("error").style.display = "flex";
                                    setTimeout(()=>{
                                        document.getElementById("error").style.display = "none";
                                    },1000)
                                    </script>';
                                    }
                                }
                            }


                        ?>
                        <!-- <tr class="border-t">
                            <td class="py-4 px-6">2024-12-21</td>
                            <td class="py-4 px-6">8:00 PM</td>
                            <td class="py-4 px-6">Jane Smith</td>
                            <td class="py-4 px-6">Italian Feast</td>
                            <td class="py-4 px-6 text-center">4</td>
                            <td class="py-4 px-6 text-center">
                                <button class="text-sm py-2 px-4 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">Approve</button>
                                <button class="text-sm py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 ml-2">Reject</button>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </section>
        </main>
        <footer class="bg-gray-800 text-white py-6 mt-auto">
            <div class="container mx-auto text-center">
                <p>&copy; 2024 Chef's Culinary Experience. All rights reserved.</p>
            </div>
        </footer>
    </div>

    
</body>
</html>
