<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
session_start();
include "dbconnect.php";

class Edit extends Database
{
    public function __construct(){
        $this->dbconn = $this->getConnection();
    }

private $fname ;
private $lname;
private $email;
private $sno;
public $sql;

public function editUser(){

if ($_SERVER['REQUEST_METHOD'] == 'POST')
{
$this->fname = $_POST['fname'];
$this->lname = $_POST['lname'];
$this->email = $_POST['email'];
$this->sno = $_POST['sno'];
$this->sql = ("UPDATE `upgradelogin` SET `fname` = '$this->fname', `lname` = '$this->lname', `email` = '$this->email' WHERE `sno` = '$this->sno'");
$Myresult = $this->dbconn->query($this->sql);

if($Myresult){
$_SESSION['update'] = "record updated successfully";
header("location: ../index.php");
}
}
}
}
$edit = new Edit();
$edit = $edit->editUser();
include "../index.php";
?>