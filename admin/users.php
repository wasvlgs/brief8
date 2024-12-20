


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
    <title>Manage Users - Chef's Culinary Experience</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Pop-up Form Styling */
        .popup-form {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .popup-content {
            background: white;
            padding: 20px;
            border-radius: 8px;
            max-width: 500px;
            width: 100%;
        }
    </style>
</head>


<div id="success" class="w-full z-10 h-[65px] fixed top-0 left-0 hidden rounded-[5px] border-2 border-[green] text-[#49de49] font-semibold items-center pl-10 bg-[#052c05]" role="alert">
  Removed succesfuly!
</div>
<div id="error" class="w-full z-10 h-[65px] fixed top-0 left-0 hidden rounded-[5px] border-2 border-[green] text-[#49de49] font-semibold items-center pl-10 bg-[#052c05]" role="alert">
    Rejected succesfuly!
</div>
<body class="bg-gray-50 text-gray-800">
    <!-- Admin Dashboard Container -->
    <div class="min-h-screen flex flex-col">
        <!-- Navbar -->
        <header class="bg-yellow-500 text-white py-4 shadow-md">
            <div class="container mx-auto px-6 flex justify-between items-center max-sm:flex-col max-sm:gap-4">
                <h1 class="text-2xl font-bold">Yemmy</h1>
                <form method="post">
                    <a href="dashboard.php" class="text-white hover:underline mx-2">Dashboard</a>
                    <a href="addmenu.php" class="text-white hover:underline mx-2">Add menu</a>
                    <a href="reservation.php" class="text-white hover:underline mx-2">Menus</a>
                    <a href="users.php" class="text-white hover:underline mx-2">Users</a>
                    <button type="submit" name="logout" class="text-white hover:underline mx-2">Logout</button>
                </form>
            </div>
        </header>

        <!-- Main Content -->
        <main class="container mx-auto px-6 py-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Manage Users</h2>

            <!-- User Management Table -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <table class="min-w-full border-collapse border border-gray-200 overflow-auto">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="py-4 px-6 text-left font-medium">First Name</th>
                            <th class="py-4 px-6 text-left font-medium">Last Name</th>
                            <th class="py-4 px-6 text-left font-medium">Email</th>
                            <th class="py-4 px-6 text-left font-medium">Role</th>
                            <th class="py-4 px-6 text-center font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">

                    <?php

                        if($cnx){
                            $getUsers = $cnx->prepare("SELECT * FROM users INNER JOIN role ON users.type = role.ID_role WHERE type = 2");
                            if($getUsers->execute()){
                                $resultUsers = $getUsers->get_result();
                                foreach($resultUsers as $items){
                                    echo '<tr class="border-t">
                                        <td class="py-4 px-6">'.$items['prenom'].'</td>
                                        <td class="py-4 px-6">'.$items['nom'].'</td>
                                        <td class="py-4 px-6">'.$items['email'].'</td>
                                        <td class="py-4 px-6">'.$items['titre'].'</td>
                                        <td class="py-4 px-6 text-center">
                                            
                                            <form method="post"><button value="'.$items['ID_user'].'" name="remove" class="text-sm py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 ml-2">
                                                Remove
                                            </button></form>
                                        </td>
                                    </tr>';
                                }

                            }
                        }

                        if(isset($_POST['remove'])){
                            $getID = strip_tags($_POST['remove']);
                            if($cnx){
                                $removeUser = $cnx->prepare("DELETE FROM users WHERE ID_user = ?");
                                $removeUser->bind_param("i",$getID);
                                if($removeUser->execute()){
                                    echo '<script>document.getElementById("success").style.display = "flex";
                                    setTimeout(()=>{
                                        document.getElementById("success").style.display = "none";
                                    },1000)
                                    </script>';
                                }else{
                                    echo '<script>document.getElementById("success").style.display = "flex";
                                    setTimeout(()=>{
                                        document.getElementById("success").style.display = "none";
                                    },1000)
                                    </script>';
                                }
                            }
                        }
                    
                    
                    
                    ?>
                        <!-- Example User -->
                        <!-- <tr class="border-t">
                            <td class="py-4 px-6">John</td>
                            <td class="py-4 px-6">Doe</td>
                            <td class="py-4 px-6">john.doe@example.com</td>
                            <td class="py-4 px-6">User</td>
                            <td class="py-4 px-6 text-center">
                                
                                <button class="text-sm py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 ml-2">
                                    Remove
                                </button>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-6 mt-auto">
            <div class="container mx-auto text-center">
                <p>&copy; 2024 Chef's Culinary Experience. All rights reserved.</p>
            </div>
        </footer>
    </div>

    

    <script>
        
    </script>
</body>

</html>
