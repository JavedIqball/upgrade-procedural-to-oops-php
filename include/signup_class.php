<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


include "dbconnect.php";

class Mysignup extends Database {



    private $fname;
    private $email;
    private $password;
    private $sql;


    public function insert()
    {

        session_start();
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {


            $this->fname = $_POST['fname'];
            $this->lname = $_POST['lname'];
            $this->email = $_POST['email'];
            $this->password = $_POST['password'];

            if (empty($this->fname) || empty($this->lname) || empty($this->email) || empty($this->password)) {
                return 'data is empty';
            }

            else
            {
                $this->sql = "INSERT INTO `upgradelogin` (`fname`, `lname`, `email`, `password`) VALUES ('$this->fname', '$this->lname', '$this->email', '$this->password')";

                if($this->getConnection()->query($this->sql)) {
                    $_SESSION['status'] = "Data submitted successfully";
                    header("location: ../index.php");
                }else{
                    echo "sorry data not submitted";
                }

            }
        }

    }

}
$obj = new Mysignup();
$insert = $obj->insert();
include "signup.php";
?>