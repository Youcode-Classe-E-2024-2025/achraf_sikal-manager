<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
require_once "../../../lib/php/classes/Connect.php";
$loginbtn='<form action="#" method="post"><input class="pl-2 cursor-pointer pr-2 p-1 text-xl border border-red-500 text-red-500 rounded-sm hover:bg-red-500 hover:text-white transition-colors duration-200 ease-in-out" type="submit" name="logout" value="Logout"></form>';
if (isset($_POST["logout"])) {
    session_destroy();
    unset($_POST["logout"]);
    header("location:#");
}
if (isset($_SESSION["email"]) and isset($_SESSION["pwd"])) {
    $conn = new connect();
    $stmt = $conn->setdb("manager","SELECT * FROM signup where email=?");
    $stmt->bind_param("s",$_SESSION["email"]);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows==1) {
    }else {
        echo'<script>location.href="../../pages/login/Login.php"</script>'; // 
    }
}
else {
    echo'<script>location.href="../../pages/login/Login.php"</script>';
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>dash</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="../../css/output.css">
</head>
<body class="bg-slate-50">
    <nav class="flex bg-white justify-between p-2 pl-5 pr-5">
        <a href="../../../index.html" class="text-4xl font-black">logo</a>
        <div class="flex gap-5 text-white items-baseline">
            <a href="" class="underline text-black">about us</a>
            <?php echo $loginbtn; ?>
        </div>
    </nav>
    <div class="flex">
    <nav class="min-h-60 w-1/5 bg-[#0B0D17] text-white grid-rows-4 grid items-center justify-center pt-3">
        <div class="grid gap-4">
            <!-- <button onclick="dash()" class="text-xl font-bold hover:text-[#4CAF4F]" href="">Dashbord</button> -->
            <button onclick="user()" class="text-xl font-bold hover:text-[#4CAF4F]" href="">Projects</button>
            <button onclick="admin()" class="text-xl font-bold hover:text-[#4CAF4F]" href="">Companies</button>
            <button onclick="dash()" class="text-xl font-bold hover:text-[#4CAF4F]">Partners</button>
        </div>
    </nav>
    <main id="user" class="w-3/5">
        <div class="p-2 m-2 font-bold bg-white rounded-lg drop-shadow-lg grid grid-cols-8 justify-between items-center">
            <p>name</p>
            <p class="col-start-3">description</p>
            <p class="col-start-6">technologies</p>
            <p class="col-start-8">github</p>
        </div>
        <?php
        require_once "../../../lib/php/classes/Connect.php";
        $conn = new connect();
        $stmt = $conn->setdb("manager","SELECT * FROM signup INNER JOIN projects where signup.id = projects.account_id and email=?;");
        $stmt->bind_param("s",$_SESSION["email"]);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
                echo '<div class="p-2 m-2 bg-white rounded-lg drop-shadow-lg grid grid-cols-8 justify-between items-center">
                    <p class="">',$row["name"],'</p>
                    <p class="col-start-3">',$row["description"],'</p>
                    <p class="col-start-6">',$row["technologies"],'</p>
                    <p class="col-start-8">',$row["github"],'</p>'
                    ;
                    
                echo '</div>';
        };
        function ispost($posted){
            if (isset($_POST[$posted])) {
                $user = (int) $_POST[$posted];
                return $user;
            };
        };
        $useractiv=ispost("activate");
        $userdeactiv=ispost("deactivate");
        $userban=ispost("ban");
        $userunban=ispost("unban");
        $activ= $conn->setdb("manager","UPDATE signup SET activated=TRUE WHERE id = ?;");
        $activ->bind_param("i",$useractiv);
        $activ->execute();
        $deactiv= $conn->setdb("manager","UPDATE signup SET activated=FALSE WHERE id = ?;");
        $deactiv->bind_param("i",$userdeactiv);
        $deactiv->execute();
        $ban= $conn->setdb("manager","UPDATE signup SET banned=true WHERE id = ?;");
        $ban->bind_param("i",$userban);
        $ban->execute();
        $unban= $conn->setdb("manager","UPDATE signup SET banned=FALSE WHERE id = ?;");
        $unban->bind_param("i",$userunban);
        $unban->execute();
        ?>
    </main>
    <main id="dash" class="w-3/5 hidden">
        <div class="p-2 m-2 font-bold bg-white rounded-lg drop-shadow-lg grid grid-cols-8 justify-between items-center">
            <p>name</p>
            <p class="col-start-3">description</p>
            <p class="col-start-6">technologies</p>
            <p class="col-start-8">github</p>
        </div>
        <?php
        require_once "../../../lib/php/classes/Connect.php";
        $conn = new connect();
        $stmt = $conn->setdb("manager","SELECT * FROM signup INNER JOIN projects where signup.id = projects.account_id and email=?;");
        $stmt->bind_param("s",$_SESSION["email"]);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
                echo '<div class="p-2 m-2 bg-white rounded-lg drop-shadow-lg grid grid-cols-8 justify-between items-center">
                    <p class="">',$row["name"],'</p>
                    <p class="col-start-3">',$row["description"],'</p>
                    <p class="col-start-6">',$row["technologies"],'</p>
                    <p class="col-start-8">',$row["github"],'</p>'
                    ;
                    
                echo '</div>';
        };
        $useractiv=ispost("activate");
        $userdeactiv=ispost("deactivate");
        $userban=ispost("ban");
        $userunban=ispost("unban");
        $activ= $conn->setdb("manager","UPDATE signup SET activated=TRUE WHERE id = ?;");
        $activ->bind_param("i",$useractiv);
        $activ->execute();
        $deactiv= $conn->setdb("manager","UPDATE signup SET activated=FALSE WHERE id = ?;");
        $deactiv->bind_param("i",$userdeactiv);
        $deactiv->execute();
        $ban= $conn->setdb("manager","UPDATE signup SET banned=true WHERE id = ?;");
        $ban->bind_param("i",$userban);
        $ban->execute();
        $unban= $conn->setdb("manager","UPDATE signup SET banned=FALSE WHERE id = ?;");
        $unban->bind_param("i",$userunban);
        $unban->execute();
        ?>
    </main>
    <main id="admin" class="w-3/5 hidden">
        <div class="p-2 m-2 font-bold bg-white rounded-lg drop-shadow-lg grid grid-cols-8 justify-between items-center h-10">
                <p>Email</p>
                <p class="col-start-5">Username</p>
                <p class="col-start-8">activation</p>
            </div>
            <?php
            $conn = new connect();
            $stmt = $conn->setdb("manager","SELECT * FROM admin INNER JOIN signup where signup.id=admin.account");
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                    echo '<div class="p-2 m-2 bg-white rounded-lg drop-shadow-lg grid grid-cols-8 justify-between items-center h-20">
                        <p class="">',$row["email"],'</p>
                        <p class="col-start-5">',$row["user"],'</p>';
                        if ($row["activated"]==0) { 
                        echo '<form class="col-start-8" method="post">
                                <input type="hidden" id="activate" name="adminactivate" value=',$row["id"],'>
                                <input type="submit" class="align-middle border border-[#4CAF4F] text-[#4CAF4F] hover:bg-[#4CAF4F] hover:text-white p-1 rounded-md" width="20px" value="activate">
                            </form>';
                        }
                        else{
                            echo '<form class="col-start-8" method="post">
                                <input type="hidden" id="deactivate" name="admindeactivate" value=',$row["id"],'>
                                <input type="submit" class="align-middle border border-red-600 text-red-600 hover:bg-red-600 hover:text-white p-1 rounded-md" width="20px" value="deactivate">
                            </form>';
                        };
                    echo '</div>';
            };
            $useractiv=ispost("adminactivate");
            $userdeactiv=ispost("admindeactivate");
            $activ= $conn->setdb("manager","UPDATE signup SET activated=TRUE WHERE id = ?;");
            $activ->bind_param("i",$useractiv);
            $activ->execute();
            $deactiv= $conn->setdb("manager","UPDATE signup SET activated=FALSE WHERE id = ?;");
            $deactiv->bind_param("i",$userdeactiv);
            $deactiv->execute();
            ?>
    </main>
    </div>
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
    <script src="./../../js/dashbord.js"></script>
</body>
</html>