
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

        <main class="container mx-auto px-6 py-8">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-700">Pending Reservations</h2>
                    <p class="text-3xl font-bold text-yellow-500 mt-4">8</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-700">Today's Approved</h2>
                    <p class="text-3xl font-bold text-green-500 mt-4">12</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-700">Clients Registered</h2>
                    <p class="text-3xl font-bold text-blue-500 mt-4">152</p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-lg font-medium text-gray-700">Next Reservation</h2>
                    <p class="text-xl text-gray-600 mt-4">7:00 PM, Italian Feast</p>
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
                        <tr class="border-t">
                            <td class="py-4 px-6">2024-12-20</td>
                            <td class="py-4 px-6">7:00 PM</td>
                            <td class="py-4 px-6">John Doe</td>
                            <td class="py-4 px-6">Gourmet French Dinner</td>
                            <td class="py-4 px-6 text-center">2</td>
                            <td class="py-4 px-6 text-center">
                                <button
                                    class="text-sm py-2 px-4 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500"
                                >
                                    Approve
                                </button>
                                <button
                                    class="text-sm py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 ml-2"
                                >
                                    Reject
                                </button>
                            </td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-4 px-6">2024-12-21</td>
                            <td class="py-4 px-6">8:00 PM</td>
                            <td class="py-4 px-6">Jane Smith</td>
                            <td class="py-4 px-6">Italian Feast</td>
                            <td class="py-4 px-6 text-center">4</td>
                            <td class="py-4 px-6 text-center">
                                <button
                                    class="text-sm py-2 px-4 bg-green-500 text-white rounded-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500"
                                >
                                    Approve
                                </button>
                                <button
                                    class="text-sm py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 ml-2"
                                >
                                    Reject
                                </button>
                            </td>
                        </tr>
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
