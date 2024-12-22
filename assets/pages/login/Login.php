<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once "../../../lib/php/classes/Connect.php";

if (isset($_SESSION["email"]) and isset($_SESSION["pwd"])) {
    $conn = new connect();
    $stmt = $conn->setdb("manager","SELECT * FROM admin INNER JOIN signup where signup.id=admin.account and signup.email=?");
    $stmt->bind_param("s",$_SESSION["email"]);
    $stmt->execute();
    $result = $stmt->get_result();
    $stat = $conn->setdb("manager","SELECT * FROM signup where email=?");
    $stat->bind_param("s",$_SESSION["email"]);
    $stat->execute();
    $resultregulare = $stat->get_result();
    if ($result->num_rows==1) {
        require "../admin/dash.php";
    }elseif($resultregulare->num_rows>=1) {
        require '../profile/profile.php';
    }

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>login</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <nav class="flex justify-between p-2 pl-5 pr-5">
        <a href="../../../index.html" class="text-4xl font-black">logo</a>
        <div class="flex gap-5 text-white items-baseline">
            <a href="" class="underline text-black">about us</a>
            <a href="../signup/signup_verif.php" class="pl-2 pr-2 p-1 text-xl border border-[#4CAF4F] text-[#4CAF4F] rounded-sm hover:bg-[#4CAF4F] hover:text-white transition-colors duration-200 ease-in-out">Register</a>
        </div>
    </nav>
    <section class="flex w-full items-center justify-center">
        <img src="../../images/Frame 35.svg" width="40%" alt="">
        <form action="" method="post" id="singup" class="grid w-80 p-1 text-slate-700 h-60">
            <label for="email">email: </label>
            <input type="email" name="email" id="email" class="outline-none border border-[#4CAF4F] pl-2" required>
            <label for="pwd">password: </label>
            <input type="password" name="pwd" id="pwd" class="outline-none border border-[#4CAF4F] pl-2" required>
            <input type="submit" class="cursor-pointer pl-2 pr-2 p-1 text-xl border border-[#4CAF4F] bg-[#4CAF4F] rounded-sm hover:bg-white hover:text-[#4CAF4F] transition-colors duration-200 ease-in-out mt-4 text-white" value="login">
        </form>
    </section>
    <footer class="flex justify-between h-60 p-10 bg-[#0B0D17]">
        <div class="">
            <a href="../../../index.html" class="text-4xl text-white font-black">logo</a>
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
    <?php
    if (isset($_POST["email"]) and isset($_POST["pwd"])) {
        $mail= $_POST["email"];
        $pass= $_POST["pwd"];
        require_once "../../../lib/php/classes/signup.php";
        $login = new signup();
        $login->login($mail,$pass);

    }
    ?>
</body>
<script src="../../js/script.js"></script>
</html>