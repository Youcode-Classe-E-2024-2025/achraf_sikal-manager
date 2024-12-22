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
    if ($result->num_rows==0) {
        echo'<script>location.href="../../pages/login/Login.php"</script>';
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
            <!-- <button onclick="dash()" class="text-xl font-bold hover:text-[#4CAF4F]">Partners</button> -->
        </div>
    </nav>
    <main id="user" class="w-11/12">
        <div class="grid justify-end">
            <button onclick="addproject(this.nextElementSibling.id)" class="m-2 align-middle border border-[#4CAF4F] text-[#4CAF4F] hover:bg-[#4CAF4F] hover:text-white p-1 rounded-md">Add project</button>
            <form id="addproject" method="post" action="" class="hidden gap-1 border border-[#4CAF4F] rounded-md p-2">
                <input type="text" name="projname" class="outline-none rounded-md text-xl" placeholder="project name">
                <input type="text" name="projdesc" class="outline-none rounded-md text-xl" placeholder="description">
                <input type="text" name="projtech" class="outline-none rounded-md text-xl" placeholder="technologies">
                <input type="url" name="projgit" class="outline-none rounded-md text-xl" placeholder="github link">
                <input type="submit" value="ADD" class="align-middle border border-[#4CAF4F] text-[#4CAF4F] hover:bg-[#4CAF4F] hover:text-white p-1 rounded-md cursor-pointer">
            </form>
        </div>
        <div class="p-2 m-2 font-bold bg-white rounded-lg drop-shadow-lg grid grid-cols-10 justify-between items-center">
            <p>name</p>
            <p class="col-start-3">description</p>
            <p class="col-start-6">technologies</p>
            <p class="col-start-8">github</p>
            <p class="col-start-10">delete</p>
        </div>
        <?php
        require_once "../../../lib/php/classes/Connect.php";
        $conn = new connect();
        $stmt = $conn->setdb("manager","SELECT * FROM signup INNER JOIN projects where signup.id = projects.account_id and email=?;");
        $stmt->bind_param("s",$_SESSION["email"]);
        $stmt->execute();
        $result = $stmt->get_result();
        while($row = $result->fetch_assoc()){
                echo '<div class="p-2 m-2 bg-white rounded-lg drop-shadow-lg grid grid-cols-10 justify-between items-center">
                    <p class="">',$row["name"],'</p>
                    <p class="col-start-3 col-end-6">',$row["description"],'</p>
                    <p class="col-start-6 col-end-8">',$row["technologies"],'</p>
                    <p class="col-start-8 col-end-10 overflow-hidden">',$row["github"],'</p>
                    <form class="col-start-10" method="post">
                            <input type="hidden" id="delete" name="delete" value=',$row["id"],'>
                            <input type="submit" class="align-middle border border-red-600 text-red-600 hover:bg-red-600 hover:text-white p-1 rounded-md" width="20px" value="Delete">
                    </form>'
                    ;
                    
                echo '</div>';
        };
        // $packageDelete;
        function ispost($posted){
            if (isset($_POST[$posted])) {
                $user = $_POST[$posted];
                return $user;
            }else {
                return false;
            };
        };
        if ($deleteid = ispost("delete")) {
            $delete= $conn->setdb("manager","DELETE FROM projects WHERE id = ?;");
            $delete->bind_param("i",$deleteid);
            $delete->execute();
            unset($_POST["delete"]);
            header("location:#");
        };
        if (($name= ispost("projname")) and ($desc= ispost("projdesc")) and ($tech= ispost("projtech")) and ($git= ispost("projgit"))) {
            $stmt = $conn->setdb("manager","SELECT * FROM signup where email=?;");
            $stmt->bind_param("s",$_SESSION["email"]);
            $stmt->execute();
            $result = $stmt->get_result();
            $id = ($result->fetch_assoc())["id"];
            $add= $conn->setdb("manager","INSERT INTO projects (name, description, technologies, github, account_id) VALUES (?, ?, ?, ?, ?);");
            $add->bind_param("ssssi",$name,$desc,$tech,$git,$id);
            $add->execute();
            unset($_POST["projname"]);
            unset($_POST["projdesc"]);
            unset($_POST["projtech"]);
            unset($_POST["projgit"]);
            header("location:#");
        };
        ?>
    </main>
    <!--  -->
    <main id="admin" class="w-11/12 hidden">
        <div class="grid justify-end">
            <button onclick="addproject(this.nextElementSibling.id)" class="m-2 align-middle border border-[#4CAF4F] text-[#4CAF4F] hover:bg-[#4CAF4F] hover:text-white p-1 rounded-md">Add companie</button>
            <form id="addcompanie" method="post" action="" class="hidden gap-1 border border-[#4CAF4F] rounded-md p-2">
                <input type="name" name="compname" class="outline-none rounded-md text-xl" placeholder="companie's name">
                <input type="date" name="compdesc" class="outline-none rounded-md text-xl" placeholder="start working">
                <input type="date" name="comptech" class="outline-none rounded-md text-xl" placeholder="end working">
                <input type="name" name="compgit" class="outline-none rounded-md text-xl" placeholder="location">
                <input type="submit" value="ADD" class="align-middle border border-[#4CAF4F] text-[#4CAF4F] hover:bg-[#4CAF4F] hover:text-white p-1 rounded-md cursor-pointer">
            </form>
        </div>
        <div class="p-2 m-2 font-bold bg-white rounded-lg drop-shadow-lg grid grid-cols-10 justify-between items-center">
            <p>name</p>
            <p class="col-start-3">start working</p>
            <p class="col-start-6">end working</p>
            <p class="col-start-8">location</p>
            <p class="col-start-10">delete</p>
        </div>
            <?php
            $stmt = $conn->setdb("manager","SELECT * FROM signup INNER JOIN companies where signup.id = companies.account_id and email=?;");
            $stmt->bind_param("s",$_SESSION["email"]);
            $stmt->execute();
            $result = $stmt->get_result();
            while($row = $result->fetch_assoc()){
                    echo '<div class="p-2 m-2 bg-white rounded-lg drop-shadow-lg grid grid-cols-10 justify-between items-center">
                        <p class="">',$row["name"],'</p>
                        <p class="col-start-3 col-end-6">',$row["work_start"],'</p>
                        <p class="col-start-6 col-end-8">',$row["work_end"],'</p>
                        <p class="col-start-8 col-end-10 overflow-hidden">',$row["location"],'</p>
                        <form class="col-start-10" method="post">
                                <input type="hidden" id="delete" name="deletecomp" value=',$row["id"],'>
                                <input type="submit" class="align-middle border border-red-600 text-red-600 hover:bg-red-600 hover:text-white p-1 rounded-md" width="20px" value="Delete">
                        </form>'
                        ;
                        
                    echo '</div>';
            };
            if ($deleteid = ispost("deletecomp")) {
                $delete= $conn->setdb("manager","DELETE FROM companies WHERE id = ?;");
                $delete->bind_param("i",$deleteid);
                $delete->execute();
                unset($_POST["deletecomp"]);
                // header("location:#");
            };
            if (($coname= ispost("compname")) and ($codesc= ispost("compdesc")) and ($cotech= ispost("comptech")) and ($cogit= ispost("compgit"))) {
                $stmt = $conn->setdb("manager","SELECT * FROM signup where email=?;");
                $stmt->bind_param("s",$_SESSION["email"]);
                $stmt->execute();
                $result = $stmt->get_result();
                $id = ($result->fetch_assoc())["id"];
                $add= $conn->setdb("manager","INSERT INTO companies (name, work_start, work_end, location, account_id) VALUES (?, ?, ?, ?, ?);");
                $add->bind_param("ssssi",$coname,$codesc,$cotech,$cogit,$id);
                $add->execute();
                unset($_POST["compname"]);
                unset($_POST["compdesc"]);
                unset($_POST["comptech"]);
                unset($_POST["compgit"]);
                // header("location:#");
            };
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
    <script>
        function addproject(id) {
            document.getElementById(id).classList.toggle("hidden");
            document.getElementById(id).classList.toggle("grid");
        }
    </script>
</body>
</html>