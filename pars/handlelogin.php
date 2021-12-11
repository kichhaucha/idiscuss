<?php
$showError="false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include "dbconnected.php";
    $userid=$_POST['loginid'];
    $pass=$_POST['logpassword'];
    $sql="SELECT * FROM `users` WHERE user_email='$userid'";
    $result = mysqli_query($conn, $sql);
    $numRows = mysqli_num_rows($result);
    if($numRows==1){
        $row=mysqli_fetch_assoc($result);
        if (password_verify($pass, $row['user_pass'])){
            session_start();
            $_SESSION['loggedin'] = true;
            $_SESSION['sno'] = $row['sno'];
            $_SESSION['username'] = $userid;
            echo "you are login" .$userid;
        }
        header("Location:/indx.php");
        
        }
        header("Location:/index.php");
    }
?>