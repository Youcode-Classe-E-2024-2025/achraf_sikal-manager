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
            <a href="../signup/signup_verif.php" class="pl-2 pr-2 p-1 text-xl border border-[#4CAF4F] text-[#4CAF4F] rounded-sm hover:bg-[#4CAF4F] hover:text-white transition-colors duration-200 ease-in-out">Register</a>
        </div>
    </nav>
    <div class="flex">
    <nav class="min-h-60 w-1/5 bg-[#0B0D17] text-white grid-rows-4 grid items-center justify-center pt-3">
        <div class="grid gap-4">
            <button onclick="dash()" class="text-xl font-bold hover:text-[#4CAF4F]" href="">Dashbord</button>
            <button onclick="user()" class="text-xl font-bold hover:text-[#4CAF4F]" href="">Users</button>
            <button onclick="admin()" class="text-xl font-bold hover:text-[#4CAF4F]" href="">Admins</button>
        </div>
    </nav>
    <main id="dash" class="w-3/5">
        <div class="p-2 m-2 font-bold bg-white rounded-lg drop-shadow-lg grid grid-cols-3 justify-between items-center">
            <p>total accounts</p>
            <p class="col-start-2">banned accounts</p>
            <p class="col-start-3">activated accounts</p>
            <?php
            require_once "../../../lib/php/classes/Connect.php";
            $conn = new connect();
            $stmt = $conn->setdb("manager","SELECT * FROM signup");
            $stmt->execute();
            $result = $stmt->get_result();
            echo'<p>'.$result->num_rows.'</p>';
            $stmt = $conn->setdb("manager","SELECT * FROM signup WHERE banned=TRUE");
            $stmt->execute();
            $result = $stmt->get_result();
            echo'<p>'.$result->num_rows.'</p>';
            $stmt = $conn->setdb("manager","SELECT * FROM signup WHERE activated=TRUE");
            $stmt->execute();
            $result = $stmt->get_result();
            echo'<p>'.$result->num_rows.'</p>';
            ?>
        </div>
    </main>
    <main id="user" class="w-3/5 hidden">
        <div class="p-2 m-2 font-bold bg-white rounded-lg drop-shadow-lg grid grid-cols-8 justify-between items-center">
            <p>Email</p>
            <p class="col-start-4">Username</p>
            <p class="col-start-6">Status</p>
            <p class="col-start-8">activation</p>
        </div>
        <?php
        require_once "../../../lib/php/classes/Connect.php";
        $conn = new connect();
        $stmt = $conn->setdb("manager","SELECT * FROM signup");
        $stmt->execute();
        $result = $stmt->get_result();
        // echo $result->num_rows;
        while($row = $result->fetch_assoc()){
                echo '<div class="p-2 m-2 bg-white rounded-lg drop-shadow-lg grid grid-cols-8 justify-between items-center">
                    <p class="">',$row["email"],'</p>
                    <p class="col-start-4">',$row["user"],'</p>';
                    if ($row["banned"]==0) { 
                        echo '<form class="col-start-6" method="post">
                                <input type="hidden" id="ban" name="ban" value=',$row["id"],'>
                                <input type="submit" class="align-middle border border-red-600 text-red-600 hover:bg-red-600 hover:text-white p-1 rounded-md" width="20px" value="ban">
                            </form>';
                    }
                    else{
                        echo '<form class="col-start-6" method="post">
                              <input type="hidden" id="unban" name="unban" value=',$row["id"],'>
                              <input type="submit" class="align-middle border border-[#4CAF4F] text-[#4CAF4F] hover:bg-[#4CAF4F] hover:text-white p-1 rounded-md" width="20px" value="unban">
                          </form>';
                    };
                    if ($row["activated"]==0) { 
                    echo '<form class="col-start-8" method="post">
                            <input type="hidden" id="activate" name="activate" value=',$row["id"],'>
                            <input type="submit" class="align-middle border border-[#4CAF4F] text-[#4CAF4F] hover:bg-[#4CAF4F] hover:text-white p-1 rounded-md" width="20px" value="activate">
                        </form>';
                }
                else{
                    echo '<form class="col-start-8" method="post">
                          <input type="hidden" id="deactivate" name="deactivate" value=',$row["id"],'>
                          <input type="submit" class="align-middle border border-red-600 text-red-600 hover:bg-red-600 hover:text-white p-1 rounded-md" width="20px" value="deactivate">
                      </form>';
                };
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
    <main id="admin" class="w-3/5 hidden">
        <div class="p-2 m-2 font-bold bg-white rounded-lg drop-shadow-lg grid grid-cols-8 justify-between items-center h-10">
                <p>Email</p>
                <p class="col-start-5">Username</p>
                <p class="col-start-8">activation</p>
            </div>
            <?php
            require_once "../../../lib/php/classes/Connect.php";
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