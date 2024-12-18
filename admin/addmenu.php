
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
    <title>Manage Menus - Chef's Culinary Experience</title>
    <script src="https://cdn.tailwindcss.com"></script>
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
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Manage Menus</h2>

            <!-- Add Menu Form -->
            <section class="mb-12">
                <h3 class="text-2xl font-semibold text-gray-700 mb-4">Add a New Menu</h3>
                <form id="formMenu" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 shadow-md rounded-lg">
                    <!-- Menu Title -->
                    <div>
                        <label for="menu-title" class="block text-sm font-medium text-gray-700">Menu Title</label>
                        <input type="text" id="menu-title" name="menutitle" placeholder="e.g., Italian Feast" class="mt-1 w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500"
                        />
                    </div>

                    

                    <!-- Menu prix -->
                    <div>
                        <label for="menu-prix" class="block text-sm font-medium text-gray-700">Menu Prix</label>
                        <input type="number" id="menu-prix" name="menuprix" placeholder="($)" class="mt-1 w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500"
                        />
                    </div>

                    <!-- Upload Menu Image -->
                    <div>
                        <label for="menu-image" class="block text-sm font-medium text-gray-700">Upload Menu Image</label>
                        <input type="file" id="menu-image" name="menuimage" accept="image/*" class="mt-1 w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500"
                        />
                    </div>

                    <!-- Submit Button -->
                    <button type="submit" class="w-full py-3 px-4 bg-yellow-500 text-white font-medium rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                    >
                        Add Menu
                    </button>
                </form>
            </section>

            <!-- Add Dish to Existing Menu Form -->
            <section>
                <h3 class="text-2xl font-semibold text-gray-700 mb-4">Add a Dish to an Existing Menu</h3>
                <form id="formPlat" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 shadow-md rounded-lg">
                    <!-- Select Menu -->
                    <div>
                        <label for="menu-select" class="block text-sm font-medium text-gray-700">Select Menu</label>
                        <select id="menu-select" name="menuselect" class="mt-1 w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500"
                        >
                            <option value="">-- Choose a menu --</option>
                            <option value="italian">Italian Feast</option>
                            <option value="french">Gourmet French Dinner</option>
                            <option value="mexican">Mexican Fiesta</option>
                        </select>
                    </div>

                    <!-- Dish Name -->
                    <div>
                        <label for="dish-name" class="block text-sm font-medium text-gray-700">Dish (Plat) Name</label>
                        <input type="text" id="dish-name" name="dishname" placeholder="e.g., Tiramisu" class="mt-1 w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500"
                        />
                    </div>

                    <!-- Menu Description -->
                    <div>
                        <label for="menu-description" class="block text-sm font-medium text-gray-700">Menu Description</label>
                        <textarea id="menu-description" name="menudescription" placeholder="Provide a description for the plat" class="mt-1 w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500"
                        ></textarea>
                    </div>

                    <!-- Upload Dish Image -->
                    <div>
                        <label for="dish-image" class="block text-sm font-medium text-gray-700">Upload Dish Image</label>
                        <input type="file" id="dish-image" name="dishimage" accept="image/*" class="mt-1 w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500"
                        />
                    </div>

                    <!-- Submit Button -->
                    <button
                        type="submit"
                        class="w-full py-3 px-4 bg-yellow-500 text-white font-medium rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                    >
                        Add Dish to Menu
                    </button>
                </form>
            </section>
        </main>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-6 mt-auto">
            <div class="container mx-auto text-center">
                <p>&copy; 2024 Chef's Culinary Experience. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <script src="../js/script.js"></script>
    <script>
            checkMenu();
            checkPlat();
    </script>
</body>
</html>
