<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$loginbtn='<a href="./assets/pages/login/Login.php" class="pl-2 pr-2 p-1 text-xl border border-[#4CAF4F] text-[#4CAF4F] rounded-sm hover:bg-[#4CAF4F] hover:text-white transition-colors duration-200 ease-in-out">Login</a>';
if (isset($_SESSION["email"]) and isset($_SESSION["pwd"])) {
    $loginbtn='<form action="#" method="post"><input class="pl-2 cursor-pointer pr-2 p-1 text-xl border border-red-500 text-red-500 rounded-sm hover:bg-red-500 hover:text-white transition-colors duration-200 ease-in-out" type="submit" name="logout" value="Logout"></form>';
}
if (isset($_POST["logout"])) {
    session_destroy();
    unset($_POST["logout"]);
    header("location:#");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="./assets/css/output.css">
</head>
<body>
    <nav class="flex justify-between p-2 pl-5 pr-5">
        <a href="index.html" class="text-4xl font-black">logo</a>
        <div class="flex gap-5 text-white items-baseline">
            <a href="" class="underline text-black">about us</a>
            <?php
            echo $loginbtn;
            ?>
            <a href="./assets/pages/signup/signup_verif.php" class="pl-2 pr-2 p-1 text-xl border border-[#4CAF4F] bg-[#4CAF4F] rounded-sm hover:bg-white hover:text-[#4CAF4F] transition-colors duration-200 ease-in-out">Register Now</a>
        </div>
    </nav>
    <main class="mb-14">
        <div class="flex p-12 pl-32 pr-32 justify-between bg-slate-100">
            <div class="leading-10">
                <div class="mb-20">
                    <h2 class="text-4xl text-gray-700 font-semibold">Manage all types of coding projects</h2>
                    <h2 class="text-4xl text-[#4CAF4F] font-semibold">easly and interactively</h2>
                    <p class="text-gray-500">Where to grow your business as a photographer: site or social media?</p>
                </div>
                <a href="./assets/pages/signup/signup_verif.php" class="pl-2 pr-2 p-1 text-2xl border border-[#4CAF4F] bg-[#4CAF4F] rounded-sm text-white hover:bg-white hover:text-[#4CAF4F] transition-colors duration-200 ease-in-out">Register</a>
            </div>
            <img src="./assets/images/Illustration.svg" alt="">
        </div>
        <div class="overflow-clip">
            <div class="flex justify-between w-full">
                <button>
                    <img src="./assets/images/Logo-1.svg" width="100" alt="">
                </button>
                <button>
                    <img src="./assets/images/Logo-2.svg" width="100" alt="">
                </button>
                <button>
                    <img src="./assets/images/Logo-3.svg" width="100" alt="">
                </button>
                <button>
                    <img src="./assets/images/Logo-4.svg" width="100" alt="">
                </button>
                <button>
                    <img src="./assets/images/Logo-5.svg" width="100" alt="">
                </button>
                <button>
                    <img src="./assets/images/Logo-6.svg" width="100" alt="">
                </button>
                <button>
                    <img src="./assets/images/Logo-7.svg" width="100" alt="">
                </button>
            </div>
        </div>
    </main>
    <footer class="flex justify-between h-60 p-10 bg-[#0B0D17]">
        <div class="">
            <a href="index.html" class="text-4xl text-white font-black">logo</a>
            <p class="text-gray-300">Copyright© 2024 program management Kit <br> All rights reserved.</p>
        </div>
        <div class="">
            <h2 class="text-white text-xl">Company</h2>
            <p class="text-sm text-gray-300">About us</p>
            <p class="text-sm text-gray-300">Blog</p>
            <p class="text-sm text-gray-300">Contact us</p>
            <p class="text-sm text-gray-300">Pricing</p>
            <p class="text-sm text-gray-300">Testimonials</p>
        </div>
        <div>
            <h2 class="text-white text-xl">Support</h2>
            <p class="text-sm text-gray-300">Help center</p>
            <p class="text-sm text-gray-300">Terms of service</p>
            <p class="text-sm text-gray-300">Legal</p>
            <p class="text-sm text-gray-300">Privacy policy</p>
            <p class="text-sm text-gray-300">Status</p>
        </div>
        <div class="">
            <h2 class="text-white text-xl">Stay up to date</h2>
            <input type="search" class="text-lg p-1 rounded-md text-gray-300 outline-none bg-gray-600 w-60 " placeholder="your email address">
        </div>
    </footer>
</body>
</html>