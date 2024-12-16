<?php
class connect
{
    private $host;
    private $user;
    private $password;
    private $dbname;
    private $stmt;
    function setdb($dbname,$query,$host="localhost",$user="root",$pwd=""){
        $this->stmt=new mysqli($host,$user,$pwd,$dbname);
        return $this->stmt->prepare($query);
        if ((new mysqli($host,$user,$pwd,$dbname))->connect_error) {
            die("Connection failed: " . (new mysqli($host,$user,$pwd,$dbname))->connect_error);
        }
    }
    // function __construct()
    // {
    // }
}
// function connect($dbname,$query,$host="localhost",$user="root",$pwd=""){
//     $stmt=new mysqli($host,$user,$pwd,$dbname);
//     return $stmt->prepare($query);
//     if ((new mysqli($host,$user,$pwd,$dbname))->connect_error) {
//         die("Connection failed: " . (new mysqli($host,$user,$pwd,$dbname))->connect_error);
//     }
// }