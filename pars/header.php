<?php
   session_start();
echo '
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
<div class="container-fluid">
  <a class="navbar-brand" href="index.php">idiscuss</a>
  <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
      <li class="nav-item">
        <a class="nav-link active" aria-current="page" href="index.php">Home</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="about.php">about</a>
      </li>
      <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
          category
        </a>
        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">';
        $sql = "SELECT category_name, category_id FROM `category`LIMIT 3 ";
        $result = mysqli_query($conn, $sql); 
        while($row = mysqli_fetch_assoc($result)){
         echo '<li><a class="dropdown-item" href="threadslist.php?catid='. $row['category_id']. '">'.$row['category_name'].'n</a></li>';
        }
        
        echo'
        </ul>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="contact.php">contact</a>
      </li>
    </ul>
    
    <div class="d-flex mx-2">';
    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
      echo '<form class="d-flex my-0" method="get" action="search.php" >
      <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success mx-2" type="submit">Search</button>
      <p class=" text-inline  text-light my-0 mx-2">welcome'.$_SESSION['username']. '</p>
      <a href="pars/logout.php"  class="btn btn-success">logout</a>

    </form>';
    }
    else{
      echo '<form class="d-flex " method="get" action="search.php" >
      <input class="form-control me-2" name="search" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-success mx-2" type="submit">Search</button>
    </form>
      <button class="btn btn-outline-success ml-2"  data-bs-toggle="modal" data-bs-target="#loginmodal" >login</button>
      <button class="btn btn-outline-success mx-2" data-bs-toggle="modal" data-bs-target="#signupmodal" >signup</button>';
    }

      echo'
    </div>
   </div>
</div>
</nav>
';
include "pars/loginmodel.php";
include "pars/signupmodel.php";
if(isset($_GET['signupsuccess']) && $_GET['signupsuccess']=="true"){
  echo '<div class="alert alert-success my-0 alert-dismissible fade show" role="alert">
  <strong>success!</strong>You can now login
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
}
//  else{
//   echo '<div class="alert alert-warning my-0 alert-dismissible fade show" role="alert">
//   <strong>success!</strong> your pasword is wrong
//   <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
// </div>';
//   }

?>