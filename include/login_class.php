<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include "dbconnect.php";

class Mylogin extends Database{

    private $email;
    private $password;
    private $sql;

public $login = false;


public function  Mysignin(){


if($_SERVER['REQUEST_METHOD'] == 'POST'){



    $this->email = $_POST['email'];
    $this->password = $_POST['password'];

    $this->sql = "Select * from  `upgradelogin` where email = '$this->email' AND password = '$this->password'  ";

    $result = $this->getConnection()->query($this->sql);


    if($result->num_rows == 1){
        $this->login = true;
        session_start();
        $_SESSION['loggedin'] = true;
        $_SESSION['email'] = $this->email;
        header("location: ../index.php");
    }
    else{
        header("location: myindex.php");
        $this->login = "invalid credentials";
    }

}


}


}

$Mylogin = new Mylogin();
$Myresult = $Mylogin->Mysignin();

include "login.php";
?>
