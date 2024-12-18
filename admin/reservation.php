<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Reservations - Chef's Culinary Experience</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 text-gray-800">

    <div class="min-h-screen flex flex-col">
        <header class="bg-yellow-500 text-white py-4 shadow-md">
            <div class="container mx-auto px-6 flex justify-between items-center max-sm:flex-col max-sm:gap-4">
                <h1 class="text-2xl font-bold">Yemmy</h1>
                <nav>
                    <a href="dashboard.php" class="text-white hover:underline mx-2">Dashboard</a>
                    <a href="addmenu.php" class="text-white hover:underline mx-2">Add menu</a>
                    <a href="reservation.php" class="text-white hover:underline mx-2">reservation</a>
                    <a href="users.php" class="text-white hover:underline mx-2">Users</a>
                    <a href="logout.php" class="text-white hover:underline mx-2">Logout</a>
                </nav>
            </div>
        </header>

        <main class="container mx-auto px-6 py-8">
            <h2 class="text-3xl font-bold text-gray-800 mb-8">Manage Reservations</h2>

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
                            <th class="py-4 px-6 text-left font-medium">Client Name</th>
                            <th class="py-4 px-6 text-left font-medium">Reservation Date</th>
                            <th class="py-4 px-6 text-left font-medium">Status</th>
                            <th class="py-4 px-6 text-center font-medium">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700">
                        <tr class="border-t">
                            <td class="py-4 px-6">John Doe</td>
                            <td class="py-4 px-6">2024-12-20 18:00</td>
                            <td class="py-4 px-6">
                                <span class="bg-yellow-300 text-yellow-800 px-3 py-1 rounded-full">Pending</span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <button class="text-sm py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Approve</button>
                                <button class="text-sm py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 ml-2">Cancel</button>
                            </td>
                        </tr>
                        <tr class="border-t">
                            <td class="py-4 px-6">Jane Smith</td>
                            <td class="py-4 px-6">2024-12-21 19:00</td>
                            <td class="py-4 px-6">
                                <span class="bg-green-300 text-green-800 px-3 py-1 rounded-full">Approved</span>
                            </td>
                            <td class="py-4 px-6 text-center">
                                <button class="text-sm py-2 px-4 bg-blue-500 text-white rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">Approve</button>
                                <button class="text-sm py-2 px-4 bg-red-500 text-white rounded-lg hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-500 ml-2">Cancel</button>
                            </td>
                        </tr>
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
