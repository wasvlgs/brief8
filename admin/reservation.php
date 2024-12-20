
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
    <title>Manage Reservations - Chef's Culinary Experience</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<div id="success" class="w-full z-10 h-[65px] fixed top-0 left-0 hidden rounded-[5px] border-2 border-[green] text-[#49de49] font-semibold items-center pl-10 bg-[#052c05]" role="alert">
  Approved succesfuly!
</div>
<div id="error" class="w-full z-10 h-[65px] fixed top-0 left-0 hidden rounded-[5px] border-2 border-[green] text-[#49de49] font-semibold items-center pl-10 bg-[#052c05]" role="alert">
    Rejected succesfuly!
</div>
<body class="bg-gray-50 text-gray-800">

    <div class="min-h-screen flex flex-col">
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

        <main class="container mx-auto px-6 py-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Manage Menus</h2>

            <div class="flex items-center justify-between mb-6">
                <div class="flex items-center space-x-4">
                    <input type="text" placeholder="Search Reservations..." class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500 w-1/3" />
                    <select class="px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-yellow-500">
                        <option value="all">All Status</option>
                        <option value="pending">Pending</option>
                        <option value="approved">Approved</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <button class="px-4 py-2 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500">
                    Filter
                </button>
            </div>

            <div class="bg-white shadow-md rounded-lg p-6">
                <table class="min-w-full border-collapse border border-gray-200 overflow-auto">
                    <thead class="bg-gray-200 text-gray-700">
                        <tr>
                            <th class="py-4 px-6 text-left font-medium">Titre</th>
                            <th class="py-4 px-6 text-left font-medium">Prix</th>
                            <th class="py-4 px-6 text-left font-medium">Number plats</th>
                            <th class="py-4 px-6 text-center font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">

                        <?php 

                            if($cnx){
                                $getMenus = $cnx->prepare("SELECT * FROM menus");
                                if($getMenus->execute()){
                                    $getResult = $getMenus->get_result();
                                    foreach($getResult as $item){
                                    $getMenuId = $item['ID_menu'];
                                    $getPlats = $cnx->prepare("SELECT Count(*) as totale FROM plats WHERE ID_menu = ?");
                                    $getPlats->bind_param("i",$getMenuId);
                                    $getCount;
                                    if($getPlats->execute()){
                                        $resultPlats = $getPlats->get_result();
                                        $getLine = $resultPlats->fetch_assoc();
                                        $getCount = $getLine['totale'];
                                    }else{
                                        $getCount = 0;
                                    }

                                        echo '<tr class="border-t">
                            <td class="py-4 px-6">'.$item['titre'].'</td>
                            <td class="py-4 px-6">$'.$item['prix'].'</td>
                            <td class="py-4 px-6">'.$getCount.'</td>
                            
                            <td class="py-4 px-6 text-center">
                                <form method="post"><button value="'.$item['ID_menu'].'" name="remove" class="text-sm py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 ml-2">Delete</button></form>
                            </td>
                        </tr>';
                                    }
                                }
                            }
                            


                            if(isset($_POST['remove'])){
                                $getID = strip_tags($_POST['remove']);
                                if($cnx){
                                    $removeMenu = $cnx->prepare("DELETE FROM menus WHERE ID_menu = ?");
                                    $removeMenu->bind_param("i",$getID);
                                    if($removeMenu->execute()){
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
                        <!-- <tr class="border-t">
                            <td class="py-4 px-6">John Doe</td>
                            <td class="py-4 px-6">2024-12-20 18:00</td>
                            <td class="py-4 px-6">
                                <span class="bg-yellow-300 text-yellow-800 px-3 py-1 rounded-full">Pending</span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <button class="text-sm py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Edit</button>
                                <button class="text-sm py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 ml-2">Delete</button>
                            </td>
                        </tr> -->
                        
                    </tbody>
                </table>
            </div>
        </main>


        <footer class="bg-gray-800 text-white py-6 mt-auto">
            <div class="container mx-auto text-center">
                <p>&copy; 2024 Chef's Culinary Experience. All rights reserved.</p>
            </div>
        </footer>
    </div>

</body>

</html>
