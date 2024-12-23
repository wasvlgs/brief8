<?php



    require '../database.php';



?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up - Chef's Culinary Experience</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../css/style.css">
</head>


<div id="success" class="w-full z-10 h-[65px] fixed top-0 left-0 hidden rounded-[5px] border-2 border-[green] text-[#49de49] font-semibold items-center pl-10 bg-[#052c05]" role="alert">
  Sign up succesfuly!
</div>
<div id="error" class="w-full z-10 h-[65px] hidden fixed top-0 left-0 rounded-[5px] border-2 border-[red] text-[#972a2a] font-semibold items-center pl-10 bg-[#2c0505]" role="alert">
  Error try again!
</div>

<body class="bg-gray-50 text-gray-800">
    <!-- Sign Up Page Container -->
    <div class="flex items-center justify-center min-h-screen bg-gray-100 py-10">
        <div class="w-full max-w-md bg-white rounded-lg shadow-md p-8">
            <!-- Logo or Title -->
            <div class="text-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900">Chef's Culinary Experience</h1>
                <p class="text-gray-500">Create your account</p>
            </div>

            <form id="formSignUp" method="POST" class="space-y-6">
                <div>
                    <label for="first-name" class="block text-sm font-medium text-gray-700">First Name</label>
                    <input type="text" id="first-name" name="firstname" placeholder="Enter your first name"  class="mt-1 w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                </div>
                <div>
                    <label for="last-name" class="block text-sm font-medium text-gray-700">Last Name</label>
                    <input type="text" id="last-name" name="lastname" placeholder="Enter your last name"  class="mt-1 w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                </div>
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" id="address" name="address" placeholder="Enter your address"  class="mt-1 w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                </div>
                <div>
                    <label for="phone" class="block text-sm font-medium text-gray-700">Phone Number</label>
                    <input type="tel" id="phone" name="phone" placeholder="Enter your phone number"  class="mt-1 w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input type="email" id="email" name="email" placeholder="Enter your email"  class="mt-1 w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" placeholder="Create a password"  class="mt-1 w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                </div>
                <div>
                    <label for="confirm-password" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input type="password" id="confirm-password" name="confirmpassword" placeholder="Confirm your password"  class="mt-1 w-full py-3 px-4 border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-yellow-500" />
                </div>
                <button name="submit" class="w-full py-3 px-4 bg-yellow-500 text-white font-medium rounded-lg hover:bg-yellow-600 focus:outline-none focus:ring-2 focus:ring-yellow-500">Sign Up</button>

                <div class="text-center text-gray-500 text-sm mt-6">or</div>

                <div class="text-center mt-4">
                    <p class="text-sm text-gray-600">
                        Already have an account?
                        <a href="login.php" class="text-yellow-500 hover:underline">Log In</a>
                    </p>
                </div>
            </form>
        </div>
    </div>

            <?php


                if(isset($_POST['submit'])){
                    $FName = htmlspecialchars($_POST['firstname']);
                    $LName = htmlspecialchars($_POST['lastname']);
                    $adresse = htmlspecialchars($_POST['address']);
                    $phone = htmlspecialchars($_POST['phone']);
                    $email = htmlspecialchars($_POST['email']);
                    $password = htmlspecialchars($_POST['password']);
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    // $cPassword = $_POST['confirmpassword'];
                    if($cnx){
                        $checkEmail = $cnx->prepare("SELECT * FROM users");
                        $answer = true;
                        if($checkEmail->execute()){
                            $result = $checkEmail->get_result();
                            foreach($result as $user){
                                if($user['email'] == $email){
                                    $answer = false;
                                }
                            }
                            if($answer === true){
                                $sql = $cnx->prepare("INSERT INTO users(nom,prenom,email,password,Adresse,num,type) VALUES(?, ?, ?, ?, ?, ?, 2)");
                                $sql->bind_param("sssssi", $FName, $LName, $email, $hashedPassword, $adresse, $phone);

                                if($sql->execute()){

                                    $getUser = $cnx->prepare("SELECT * FROM users WHERE email = ?");
                                    $getUser->bind_param("s",$email);
                                    if($getUser->execute()){
                                        session_start();
                                        $result = $getUser->get_result();
                                        $user = $result->fetch_assoc();
                                        $_SESSION['id'] = $user['ID_user'];
                                        echo '<script>document.getElementById("success").style.display = "flex";
                                        setTimeout(()=>{
                                        document.getElementById("success").style.display = "none";
                                        location.replace("../pages/menu.php");
                                            },1000)
                                        </script>';
                                    }else{
                                        session_destroy();
                                    }
                                    
                                }else{
                                    echo '<script>document.getElementById("error").style.display = "flex";
                                    setTimeout(()=>{
                                        document.getElementById("error").style.display = "none";
                                    },1000)
                                    </script>';
                                    session_destroy();
                                }
                            }else{
                                echo '<script>
                                    document.getElementById("email").style.border = "2px solid red";
                                </script>';
                            }
                        }
                        

                        
                        
                    }
                }



            ?>

    <script src="../js/script.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded",()=>{
        checkSignUp();
        
    })
    </script>
</body>

</html>