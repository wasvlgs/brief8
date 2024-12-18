
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
</head>
<body class="bg-gray-50 text-gray-800">
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
                        <tr class="border-t">
                            <td class="py-4 px-6">2024-12-20</td>
                            <td class="py-4 px-6">7:00 PM</td>
                            <td class="py-4 px-6">Gourmet French Dinner</td>
                            <td class="py-4 px-6">2</td>
                            <td class="py-4 px-6 text-green-600 font-medium">Confirmed</td>
                            <td class="py-4 px-6 text-center">
                                <button
                                    class="text-sm py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500"
                                >
                                    Cancel
                                </button>
                                <button
                                    class="text-sm py-2 px-4 bg-yellow-500 text-white rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500 ml-2"
                                >
                                    Modify
                                </button>
                            </td>
                        </tr>
                        <!-- Repeat for other reservations -->
                        <tr class="border-t">
                            <td class="py-4 px-6">2024-12-21</td>
                            <td class="py-4 px-6">8:00 PM</td>
                            <td class="py-4 px-6">Italian Feast</td>
                            <td class="py-4 px-6">4</td>
                            <td class="py-4 px-6 text-yellow-600 font-medium">Pending</td>
                            <td class="py-4 px-6 text-center">
                                <button
                                    class="text-sm py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500"
                                >
                                    Cancel
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
</body>
</html>
