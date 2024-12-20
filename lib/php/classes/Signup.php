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
    public function insert(){
        require_once "Connect.php";
        $conn = new connect();
        $statment = $conn->setdb("manager","select * from signup where email=?;");
        $statment->bind_param("s",$this->email);
        $statment->execute();
        $result= $statment->get_result();
        $stmt = $conn->setdb("manager","insert into signup(user,email,pwd) values(?,?,?);");
        $stmt->bind_param("sss",$this->user,$this->email,$this->pwd);
        if ($result->num_rows==0 and isset($this->user) and isset($this->email) and isset($this->pwd)) {
            $stmt->execute();
            echo '<script>location.href="http://localhost/Gestionnaire/index.html"</script>';
        }
        $id=1;
        $statment = $conn->setdb("manager","select * from admin where account=?;");
        $statment->bind_param("i",$id);
        $statment->execute();
        $result= $statment->get_result();
        $stmt = $conn->setdb("manager","insert into admin(account) values(?);");
        $stmt->bind_param("i",$id);
        if ($result->num_rows==0) {
            $stmt->execute();
        }
    }
    public function login($email,$pwd){
        require_once "Connect.php";
        $conn = new connect();
        $pwd = hash('sha256',$pwd);
        $statment = $conn->setdb("manager","select * from signup where email=? and pwd=?;");
        $statment->bind_param("ss",$email,$pwd);
        $statment->execute();
        $result= $statment->get_result();
        if ($result->num_rows==1) {
            $user = $result->fetch_assoc();
            $stmt= $conn->setdb("manager","insert into login(user) values (?);");
            $stmt->bind_param("i",$user["id"]);
            $stmt->execute();
            $statment = $conn->setdb("manager","select * from admin where account=?;");
            $statment->bind_param("i",$user["id"]);
            $statment->execute();
            $res= $statment->get_result();
            if ($res->num_rows==1) {
                echo '<script>location.href="http://localhost/Gestionnaire/assets/pages/admin/dash.php"</script>';
            }
            else {
                
                // if () {
                    // # code...
                // }
                echo '<script>location.href="http://localhost/Gestionnaire/index.html"</script>';
            }
            
        }else {
            echo '<script>alert("email or password is incorect");</script>';
        }
    }
}
require_once "Connect.php";
$connect= new connect();
$existe = "signup";
function create_table($existe,$statment){
    $connect= new connect();
    $query = "SHOW TABLES like '$existe';";
    $stmt = $connect->setdb("manager",$query); //tackes database name and the sql query
    // $stmt->bind_param("s", $existe);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    if (!isset($row)) {
        $statment->execute();
        $statment->close();
    }
}

$stmt = $connect->setdb("manager","CREATE TABLE signup(id int PRIMARY key AUTO_INCREMENT,user varchar(50) not null,email varchar(255) not null,pwd varchar(255) not null,activated bool NOT null,banned bool NOT null);");
create_table('signup',$stmt);
$stmt = $connect->setdb("manager","CREATE TABLE admin(id int PRIMARY KEY AUTO_INCREMENT,account int not null,FOREIGN KEY (account) REFERENCES signup(id));");
create_table('admin',$stmt);
$stmt = $connect->setdb("manager","CREATE TABLE login(id int PRIMARY KEY AUTO_INCREMENT,user int not null,FOREIGN KEY (user) REFERENCES signup(id));");
create_table('login',$stmt);