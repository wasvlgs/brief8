


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
                    <a href="reservation.php" class="text-white hover:underline mx-2">reservation</a>
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
                        <!-- Example User -->
                        <tr class="border-t">
                            <td class="py-4 px-6">John</td>
                            <td class="py-4 px-6">Doe</td>
                            <td class="py-4 px-6">john.doe@example.com</td>
                            <td class="py-4 px-6">User</td>
                            <td class="py-4 px-6 text-center">
                                <button onclick="showEditForm('John', 'Doe', 'john.doe@example.com')"
                                    class="text-sm py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                    Edit
                                </button>
                                <button class="text-sm py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 ml-2">
                                    Remove
                                </button>
                            </td>
                        </tr>
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

    <!-- Pop-up Edit Form -->
    <div id="edit-popup" class="popup-form flex">
        <div class="popup-content">
            <h3 class="text-xl font-bold mb-4">Edit User Details</h3>
            <form>
                <div class="mb-4">
                    <label for="first-name" class="block text-sm font-medium">First Name</label>
                    <input id="first-name" type="text" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="last-name" class="block text-sm font-medium">Last Name</label>
                    <input id="last-name" type="text" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium">Email</label>
                    <input id="email" type="email" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium">Password</label>
                    <input id="password" type="password" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="address" class="block text-sm font-medium">Address</label>
                    <input id="address" type="text" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="mb-4">
                    <label for="phone" class="block text-sm font-medium">Phone Number</label>
                    <input id="phone" type="text" class="w-full p-2 border border-gray-300 rounded">
                </div>
                <div class="flex justify-end">
                    <button type="button" onclick="closeEditForm()" class="bg-gray-500 text-white px-4 py-2 rounded-lg">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg ml-2">Save</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Show the edit form with pre-filled values
        function showEditForm(firstName, lastName, email) {
            document.getElementById('first-name').value = firstName;
            document.getElementById('last-name').value = lastName;
            document.getElementById('email').value = email;
            document.getElementById('edit-popup').style.display = 'flex';
        }

        // Close the edit form
        function closeEditForm() {
            document.getElementById('edit-popup').style.display = 'none';
        }
    </script>
</body>

</html>
