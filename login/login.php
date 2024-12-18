<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Chef's Culinary Experience</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-50 text-gray-800">
    <!-- Login Page Container -->
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
            <!-- Logo or Title -->
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Chef's Culinary Experience</h1>
                <p class="text-gray-500">Log in to your account</p>
            </div>

            <!-- Login Form -->
            <form id="formSignIn" action="#" method="POST" class="space-y-6">
                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        placeholder="Enter your email"
                        class="mt-1 w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500"
                    />
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input
                        type="password"
                        id="password"
                        name="password"
                        placeholder="Enter your password"
                        class="mt-1 w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500"
                    />
                </div>

                <!-- Remember Me and Forgot Password -->
                <div class="flex items-center justify-between">
                    <div class="flex items-center">
                        <input
                            type="checkbox"
                            id="remember"
                            name="remember"
                            class="h-4 w-4 text-yellow-500 focus:ring-yellow-500 border-gray-300 rounded"
                        />
                        <label for="remember" class="ml-2 text-sm text-gray-600">Remember Me</label>
                    </div>
                    <a href="#" class="text-sm text-yellow-500 hover:underline">Forgot Password?</a>
                </div>

                <!-- Submit Button -->
                <button
                    type="submit"
                    class="w-full py-3 px-4 bg-yellow-500 text-white font-medium rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                >
                    Log In
                </button>

                <!-- Divider -->
                <div class="text-center text-gray-500 text-sm mt-6">or</div>

                <!-- Signup Link -->
                <div class="text-center mt-4">
                    <p class="text-sm text-gray-600">
                        Don't have an account?
                        <a href="signup.php" class="text-yellow-500 hover:underline">Sign Up</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

    <script src="../js/script.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded",()=>{
    checkSignIn();
})
    </script>
</body>
</html>
