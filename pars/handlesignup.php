<?php
$showError="false";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    include "dbconnected.php";
    $user_email=$_POST['signupemail'];
    $pass=$_POST['signuppassword'];
    $cpass=$_POST['cpassword'];

    // check exixst user
    $existSql="SELECT * FROM `users` WHERE user_email='$user_email'";
    $result = mysqli_query($conn, $existSql);
    $numRows = mysqli_num_rows($result);
    if($numRows>0){
        $showError="email is already exist";
    }
    else{
        if($pass==$cpass){
            $hash = password_hash($pass, PASSWORD_DEFAULT);
            $sql="INSERT INTO `users` (`user_email`, `user_pass`, `dt`) VALUES ('$user_email', '$hash', current_timestamp())";
            $result = mysqli_query($conn, $sql);
            if($result){
                $showAlert=true;
                header("Location:/index.php?signupsuccess=true");
                exit();
            }
        }
        else{
            $showError="password is not match";
            header("Location:/index.php?signupsuccess=false&error=$showError");
            
        }
    }
    header("Location:/index.php?signupsuccess=false&error=$showError");

}



























// $showAlert = false;
// $showError = false;
// if($_SERVER["REQUEST_METHOD"] == "POST"){
//     include 'dbconnected.php';
//     $username = $_POST["signupemail"];
//     $password = $_POST["signuppassword"];
//     $cpassword = $_POST["cpassword"];
//     // $exists=false;

//     // Check whether this username exists
//     $existSql = "SELECT * FROM `users` WHERE username = '$username'";
//     $result = mysqli_query($conn, $existSql);
//     $numRows = mysqli_num_rows($result);
//     echo $numRows;

//     if($numRows > 0){
//         // $exists = true;
//         $showError = "Username Already Exists";
//     }
//     // else{
//     //     // $exists = false; 
//         if(($password == $cpassword)){
//             $hash = password_hash($password, PASSWORD_DEFAULT);
//             $sql = "INSERT INTO `users` ( `user_email`, `user_pass`, `dt`) VALUES ( '$username', '$hash', current_timestamp());";
//             $result = mysqli_query($conn, $sql);
//             if ($result){
//                 $showAlert = true;
//                 header("location:/forum/inde.php");
//             }
//         }
//         else{
//             $showError = "Passwords do not match";
//         }
    
// }
    
?>

