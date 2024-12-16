<?php

class signup
{
    private $user;
    private $email;
    private $pwd;
    private $email_pattern = "/^[a-z]{1,50}+@[a-z]{1,12}+\.[a-z]{1,3}+$/";
    private $pwd_pattern = "/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/";
    private $user_pattern = "/^[A-Za-z][A-Za-z0-9_]{7,29}$/";
    public function setuser($user)
    {
        if (true) { // condition : preg_match($this->user_pattern, $user)
            $this->user = $user;
        }
    }
    public function getuser(){
        return $this->user;
    }
    public function setemail($email){
        if (preg_match($this->email_pattern, $email)) {
            $this->email = $email;
        }
    }
    public function getemail(){
        return $this->email;
    }
    public function setpassword($pwd){
        if (preg_match($this->pwd_pattern, $pwd)) {
            $this->pwd = hash('sha256',$pwd);
        }
    }
    public function getpassword(){
        return $this->pwd;
    }
    // function __construct()
    // {
    //     $this->pwd=hash('sha256',$this->pwd);
    // }
}
require_once "Connect.php";
$connect= new connect();
$stmt = $connect->setdb("manager","create table signup(id int PRIMARY key AUTO_INCREMENT,email varchar(255),pwd varchar(255));");
$stmt->close();
// $stmt->execute();
$iscreat = $connect->setdb("manager","selecte")

$user = new signup();
// echo $_POST['name'];
$user->setuser($_POST['user']);
echo $user->getuser();
echo '<br>';
$user->setemail($_POST['email']);
echo $user->getemail();
echo '<br>';
$user->setpassword($_POST['pwd']);
echo $user->getpassword();
