<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
        <style>
          #ques{
            min-height: 444px;
            margin-top: 99px;
          }
        </style>
    <title>welcome to i-discuss</title>
</head>

<body>
<?php include "pars/dbconnected.php";
  ?>
    <?php
  include "pars/header.php";?>
   
  <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `thread` WHERE thread_id=$id"; 
    $result = mysqli_query($conn, $sql);
    while($row = mysqli_fetch_assoc($result)){
        $tittle = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_users_id = $row['thread_use_id'];

        // $thread_use_id=$row['comment_by'];
        $sql2="SELECT user_email FROM `users` WHERE sno='$thread_users_id'";
        $result2= mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        $posted_by=$row2['user_email'];
    }
    
    ?>



<?php
    $showAlert=false;
      $method=$_SERVER["REQUEST_METHOD"];
    if($method=='POST'){
      // insert intu comment db
      $comment=$_POST['comment'];
      $serie=$_POST['sno'];
      $sql = " INSERT INTO `comment` ( `comment_contain`, `thread_id`, `comment_by`, `comment_time`) VALUES ( '$comment', '$id', '$serie', current_timestamp())"; 
    $result = mysqli_query($conn, $sql);
    $showAlert=true;
    if($showAlert){
      echo '
      <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>SUCCESS!</strong>   Your comment has been add ! 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
      
      ';
    }
      
    }
    
    ?>
    
    <!-- catagory coantainer start here -->
    <div class="container my-4">
    <div class="jumbotron">
  <h1 class="display-4"><?php echo $tittle; ?></h1>
  <p class="lead"><?php echo $desc; ?> </p>
  <hr class="my-4">
  <p>this is a peer to peer forum for shareing knowledge with each other
  No Spam / Advertising / Self-promote in the forums. ...
Do not post copyright-infringing material. ...
Do not post “offensive” posts, links or images. ...
Do not cross post questions. ...
Remain respectful of other members at all times.
  </p>
  <p> posted_by: <em> <?php echo  $row2['user_email']; ?></em></p>
</div>
    </div>




          
        <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            echo '<div class="container " id="ques">
            <div class="container my-10">
              <h1>post a comment</h1>
              <form method="post" action="'. $_SERVER['REQUEST_URI'].'">
              <div class="mb-3 my-4">
                    <label for="exampleFormControlTextarea1" class="form-label">type your comment</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="comment" rows="3"></textarea>
                    <input type="hidden" id="sno" name="sno" value="'. $_SESSION["sno"].'">
                </div>
                <button type="submit"  class="btn btn-success">post comment</button>
            </form>
        </div>';
        }
        else{
          echo '
          <div class="container ">
          <h1>post a comment</h1>
          <p class="lead">You are not logged in. Please login to be able to post comment</p>
        </div>
     
          ';
        }
        ?>




        <?php
    $id = $_GET['threadid'];
    $sql = "SELECT * FROM `comment` WHERE thread_id=$id"; 
    $result = mysqli_query($conn, $sql);
    $noresult=true;
    while($row = mysqli_fetch_assoc($result)){
        $noresult=false;
        $id = $row['comment_id'];
        $containt = $row['comment_contain'];
        $comment_time=$row['comment_time'];

        $thread_use_id=$row['comment_by'];
        $sql2="SELECT user_email FROM `users` WHERE sno='$thread_use_id'";
        $result2= mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
       

      echo '<div class="d-flex ">
  <div class="flex-shrink-0">
    <img src="userdef.jpg" width="55px" alt="...">
  </div>
  <div class="flex-grow-1 ms-3">
  <p class="fw-bold my-0"> '.$row2['user_email'].''. $comment_time .'</p>
   '.$containt.'
  </div>
</div>';

}
if($noresult){
    echo '<div class="jumbotron jumbotron-fluid my-4">
     <div class="container">
        <h1 class="display-4">No comment Found</h1>
        <p class="lead"> Be the first person of to ask a question </p>
      </div>
    </div>';
    }
    
?> 

<!-- <?php
    $showAlert=false;
      $method=$_SERVER["REQUEST_METHOD"];
    if($method=='POST'){
      // insert intu comment db
      $comment=$_POST['comment']; 

        $comment = str_replace("<", "&lt;", $comment);
        $comment = str_replace(">", "&gt;", $comment); 
      $sno=$POST['sno'];
      $sql = " INSERT INTO `comment` ( `comment_contain`, `thread_id`, `comment_by`, `comment_time`) VALUES ( '$comment', '$id', '$sno', current_timestamp())"; 
    $result = mysqli_query($conn, $sql);
    $showAlert=true;
    if($showAlert){
      echo '
      <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>SUCCESS!</strong>   Your comment has been add ! 
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
      
      ';
    }
      
    }
    
    ?> -->
 
    <!-- <?php include 'pars/footer.php'; ?> -->


    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>