
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



<div id="success" class="w-full z-10 h-[65px] fixed top-0 left-0 hidden rounded-[5px] border-2 border-[green] text-[#49de49] font-semibold items-center pl-10 bg-[#052c05]" role="alert">
  Menu added succesfuly!
</div>
<div id="success2" class="w-full z-10 h-[65px] fixed top-0 left-0 hidden rounded-[5px] border-2 border-[green] text-[#49de49] font-semibold items-center pl-10 bg-[#052c05]" role="alert">
  Plat added succesfuly!
</div>
<div id="error" class="w-full z-10 h-[65px] hidden fixed top-0 left-0 rounded-[5px] border-2 border-[red] text-[#972a2a] font-semibold items-center pl-10 bg-[#2c0505]" role="alert">
  Error try again!
</div>


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
                    <button name="addMenu" type="submit" class="w-full py-3 px-4 bg-yellow-500 text-white font-medium rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                    >
                        Add Menu
                    </button>
                </form>
            </section>











            <?php

                if(isset($_POST['addMenu'])){
                    $getTitre = htmlspecialchars($_POST['menutitle']);
                    $getPrix = strip_tags($_POST['menuprix']);


                $target_dir = "../img/menus/";
                    $target_file = $target_dir . basename($_FILES["menuimage"]["name"]);
                    $uploadOk = 1;
                    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                    $check = getimagesize($_FILES["menuimage"]["tmp_name"]);
                    if ($check !== false) {
                        
                        $uploadOk = 1;
                    } else {
                        
                        $uploadOk = 0;
                    }

                    if ($_FILES["menuimage"]["size"] > 5000000) {
                       
                        $uploadOk = 0;
                    }

                    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                        
                        $uploadOk = 0;
                    }


                    if ($uploadOk == 0) {
                        echo '<script>document.getElementById("error").style.display = "flex";
                                    setTimeout(()=>{
                                        document.getElementById("error").style.display = "none";
                                    },1000)
                                    </script>';
                    } else {

                    if (move_uploaded_file($_FILES["menuimage"]["tmp_name"], $target_file)) {
                        $addMenu = $cnx->prepare("INSERT INTO menus(titre,prix,imgSrc) VALUES(?,?,?)");
                        $addMenu->bind_param("sis",$getTitre,$getPrix,$target_file);
                        if($addMenu->execute()){
                            echo '<script>document.getElementById("success").style.display = "flex";
                        setTimeout(()=>{
                            document.getElementById("success").style.display = "none";
                        },1000)
                        </script>';
                        }else{
                            echo '<script>document.getElementById("error").style.display = "flex";
                                    setTimeout(()=>{
                                        document.getElementById("error").style.display = "none";
                                    },1000)
                                    </script>';
                        }
                    } else {
                        echo '<script>document.getElementById("error").style.display = "flex";
                                    setTimeout(()=>{
                                        document.getElementById("error").style.display = "none";
                                    },1000)
                                    </script>';
                    }
                }
                }

            ?>










            <!-- Add Dish to Existing Menu Form -->
            <section>
                <h3 class="text-2xl font-semibold text-gray-700 mb-4">Add a Dish to an Existing Menu</h3>
                <form id="formPlat" method="POST" enctype="multipart/form-data" class="space-y-6 bg-white p-6 shadow-md rounded-lg">
                    <!-- Select Menu -->
                    <div>
                        <label for="menu-select" class="block text-sm font-medium text-gray-700">Select Menu</label>
                        <select id="menu-select" name="menuselect" class="mt-1 w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500"
                        >
                            <option value="" disabled selected>-- Choose a menu --</option>
                            <?php

                                if($cnx){
                                    $getMenus = $cnx->prepare("SELECT * FROM menus");
                                    if($getMenus->execute()){
                                        $getResult = $getMenus->get_result();
                                        foreach($getResult as $item){
                                            echo '<option value="'.$item['ID_menu'].'">'.$item['titre'].'</option>';
                                        }
                                    }
                                }


                            ?>
                            <!-- <option value="italian">Italian Feast</option>
                            <option value="french">Gourmet French Dinner</option>
                            <option value="mexican">Mexican Fiesta</option> -->
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
                    name="addplat"
                        type="submit"
                        class="w-full py-3 px-4 bg-yellow-500 text-white font-medium rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500"
                    >
                        Add Dish to Menu
                    </button>
                </form>
            </section>
        </main>



        <?php

            if(isset($_POST['addplat'])){
                $getMenuselect = $_POST['menuselect'];
                $getDishname = $_POST['dishname'];
                $getDesc = $_POST['menudescription'];
                


                $target_dir = "../img/menus/";
                $target_file = $target_dir . basename($_FILES["dishimage"]["name"]);
                $uploadOk = 1;
                $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

                $check = getimagesize($_FILES["dishimage"]["tmp_name"]);
                if ($check !== false) {
                    echo "File is an image - " . $check["mime"] . ".";
                    $uploadOk = 1;
                } else {
                    echo "File is not an image.";
                    $uploadOk = 0;
                }

                // Check if file already exists
                if (file_exists($target_file)) {
                    echo "Sorry, file already exists.";
                    $uploadOk = 0;
                }

                // Check file size (e.g., limit to 5MB)
                if ($_FILES["dishimage"]["size"] > 5000000) {
                    echo "Sorry, your file is too large.";
                    $uploadOk = 0;
                }

                // Allow certain file formats
                if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
                    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
                    $uploadOk = 0;
                }

                // Check if $uploadOk is set to 0 by an error
                if ($uploadOk == 0) {
                    echo "Sorry, your file was not uploaded.";
                } else {

                // If everything is ok, try to upload file
                if (move_uploaded_file($_FILES["dishimage"]["tmp_name"], $target_file)) {
                    $addPlat = $cnx->prepare("INSERT INTO plats(ID_menu,Titre,Description,imgSrc) VALUES(?,?,?,?)");
                    $addPlat->bind_param("isss",$getMenuselect,$getDishname,$getDesc,$target_file);
                    if($addPlat->execute()){
                        echo '<script>document.getElementById("success2").style.display = "flex";
                        setTimeout(()=>{
                            document.getElementById("success2").style.display = "none";
                        },1000)
                        </script>';
                    }else{
                        echo '<script>document.getElementById("error").style.display = "flex";
                                    setTimeout(()=>{
                                        document.getElementById("error").style.display = "none";
                                    },1000)
                                    </script>';
                    }
                } else {
                    echo '<script>document.getElementById("error").style.display = "flex";
                                    setTimeout(()=>{
                                        document.getElementById("error").style.display = "none";
                                    },1000)
                                    </script>';
                }
            }
            }

        ?>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-6 mt-auto">
            <div class="container mx-auto text-center">
                <p>&copy; 2024 Chef's Culinary Experience. All rights reserved.</p>
            </div>
        </footer>
    </div>

    <script src="../js/scripts.js"></script>
    <script>
            checkMenu();
            checkPlat();
    </script>
</body>
</html>
