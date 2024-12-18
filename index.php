<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chef's Culinary Experience</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body class="bg-gray-50 text-gray-800">
    
    <header class="bg-gray-900 text-white">
        <div class="container mx-auto flex justify-between items-center py-4 px-6">
            <h1 class="text-3xl font-bold">Yummy</h1>
            <nav id="menu" class="space-x-4 max-sm:space-x-0 max-sm:absolute max-sm:top-[67px] max-sm:bg-gray-800 max-sm:h-[calc(100vh-67px)] max-sm:right-0 max-sm:flex max-sm:flex-col max-sm:justify-center max-sm:items-center max-sm:gap-10 max-sm:w-0 max-sm:overflow-hidden max-sm:transition-all max-sm:duration-300">
                <a href="#" class="hover:underline max-sm:text-xl">Home</a>
                <a href="#about" class="hover:underline max-sm:text-xl">About</a>
                <a href="#menu" class="hover:underline max-sm:text-xl">Menu</a>
                <a href="#contact" class="hover:underline max-sm:text-xl">Contact</a>
                <a href="login/login.php" class="bg-yellow-500 text-gray-900 py-2 px-4 rounded hover:bg-yellow-600 max-sm:text-xl">Login</a>
            </nav>
            <i id="openMenu" class="fa-solid fa-bars text-2xl text-white cursor-pointer hidden max-sm:block"></i>
            <i id="closeMenu" class="fa-solid fa-xmark text-3xl text-white cursor-pointer hidden"></i>
        </div>
    </header>

    
    <section class="bg-cover bg-center h-screen" style="background-image: url('img/hero-bg.jpg');">
        <div class="bg-black bg-opacity-50 h-full flex items-center">
            <div class="text-center w-full text-white px-6">
                <h2 class="text-4xl md:text-6xl font-bold mb-4">Discover Culinary Perfection</h2>
                <p class="text-lg md:text-xl mb-6">Exclusive dining experiences curated by a world-renowned chef.</p>
                <a href="#menu" class="bg-yellow-500 text-gray-900 py-3 px-8 rounded hover:bg-yellow-600">Explore the Menu</a>
            </div>
        </div>
    </section>

    
    <section id="about" class="py-12 bg-white">
        <div class="container mx-auto px-6 md:px-12 text-center">
            <h3 class="text-3xl font-semibold mb-4">About the Chef</h3>
            <p class="text-gray-600 max-w-2xl mx-auto">With decades of experience in haute cuisine, our chef brings unparalleled expertise and creativity to every dish. Each experience is designed to leave you with unforgettable memories.</p>
        </div>
    </section>

    
    <section id="menu" class="py-12 bg-gray-100">
        <div class="container mx-auto px-6 md:px-12 text-center">
            <h3 class="text-3xl font-semibold mb-8">Our Menu</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                
                <div class="bg-white rounded-lg shadow-md p-6">
                    <img src="img/hero-bg.jpg" alt="Dish" class="w-full rounded-t-lg">
                    <h4 class="text-xl font-semibold mt-4">Signature Dish 1</h4>
                    <p class="text-gray-600">A description of this amazing dish, highlighting its unique flavors.</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6">
                    <img src="img/hero-bg.jpg" alt="Dish" class="w-full rounded-t-lg">
                    <h4 class="text-xl font-semibold mt-4">Signature Dish 2</h4>
                    <p class="text-gray-600">Crafted with the finest ingredients for a truly luxurious experience.</p>
                </div>
                
                <div class="bg-white rounded-lg shadow-md p-6">
                    <img src="img/hero-bg.jpg" alt="Dish" class="w-full rounded-t-lg">
                    <h4 class="text-xl font-semibold mt-4">Signature Dish 3</h4>
                    <p class="text-gray-600">A perfect combination of taste and art on your plate.</p>
                </div>
            </div>
        </div>
    </section>

    
    <section id="contact" class="py-12 bg-white">
        <div class="container mx-auto px-6 md:px-12 text-center">
            <h3 class="text-3xl font-semibold mb-4">Contact Us</h3>
            <p class="text-gray-600 max-w-xl mx-auto">Reserve your experience or get in touch for inquiries.</p>
            <form class="mt-8 max-w-xl mx-auto">
                <div class="flex flex-col md:flex-row gap-4">
                    <input type="text" placeholder="Your Name" class="w-full py-3 px-4 rounded border-gray-300 shadow-sm">
                    <input type="email" placeholder="Your Email" class="w-full py-3 px-4 rounded border-gray-300 shadow-sm">
                </div>
                <textarea placeholder="Your Message" class="w-full py-3 px-4 mt-4 rounded border-gray-300 shadow-sm"></textarea>
                <button class="mt-4 bg-yellow-500 text-gray-900 py-3 px-8 rounded hover:bg-yellow-600">Send Message</button>
            </form>
        </div>
    </section>

    
    <footer class="bg-gray-900 text-white py-6">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Chef's Experience. All rights reserved.</p>
        </div>
    </footer>
    <script src="js/script.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded",()=>{
            slideHome();
})
    </script>
</body>
</html>
