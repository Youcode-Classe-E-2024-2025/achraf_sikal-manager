<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
    <form action="signup.php" method="post" id="singup" class="grid w-60 bg-green-300 p-1 w">
        <label for="user">username: </label>
        <input type="name" name="user" id="user" class="outline-none" required>
        <label for="email">email: </label>
        <input type="email" name="email" id="email" class="outline-none" required>
        <label for="pwd">password: </label>
        <input type="password" name="pwd" id="pwd" class="outline-none" required>
        <input type="submit" value="Singup" id="signbtn">
    </form>
</body>
<script src="script.js"></script>
</html>