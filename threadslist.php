<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
    #ques {
        min-height: 444px;
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
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `category` WHERE category_id=$id"; 
    $result = mysqli_query($conn, $sql);

    while($row = mysqli_fetch_assoc($result)){
        $catname = $row['category_name'];
        $catdesc = $row['category_discription'];
    }
    
    ?>

    <?php
    $showAlert=false;
      $method=$_SERVER["REQUEST_METHOD"];
    if($method=='POST'){
      $th_title=$_POST['title'];
      $th_desc=$_POST['desc'];

      $th_title= str_replace("<", "&lt;", $th_title);
      $th_title = str_replace(">", "&gt;", $th_title); 
      $th_desc = str_replace("<", "&lt;",  $th_desc);
      $th_desc = str_replace(">", "&gt;",   $th_desc); 


      $serie=$_POST['sno'];
      $sql = "INSERT INTO `thread` ( `thread_title`, `thread_desc`, `thread_cat_id`, `thread_use_id`, `dt`) VALUES ( '$th_title', '$th_desc', '$id', '$serie', current_timestamp())"; 
    $result = mysqli_query($conn, $sql);
    $showAlert=true;
    if($showAlert){
      echo '
      <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>SUCCESS!</strong>   Your thread has been add ! please wait comunity response thank you
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
      
      ';
    }
      
    }
    
    ?>


    <!-- catagory coantainer start here -->
    <div class="container my-4">
        <div class="jumbotron">
            <h1 class="display-4">welcome to <?php echo $catname; ?> forum</h1>
            <p class="lead"><?php echo $catdesc; ?> </p>
            <hr class="my-4">
            <p>this is a peer to peer forum for shareing knowledge with each other
                No Spam / Advertising / Self-promote in the forums. ...
                Do not post copyright-infringing material. ...
                Do not post “offensive” posts, links or images. ...
                Do not cross post questions. ...
                Remain respectful of other members at all times.
            </p>
            <a class="btn btn-success btn-lg" href="#" role="button">Learn more</a>
        </div>
    </div>
    <div class="container" id="ques">




        <?php
        if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
            echo '<div class="container my-10">
            <h1>Start a Discussion</h1>
            <form method="post" action="'. $_SERVER["REQUEST_URI"].'">
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">problem title</label>
                    <input type="text" class="form-control" name="title" id="exampleInputEmail1"
                        aria-describedby="emailHelp">
                    <div id="emailHelp" class="form-text">keep your title short and crisp as possible.</div>
                </div>
                <input type="hidden" id="sno" name="sno" value="'. $_SESSION["sno"].'">
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Ellaborate your concern</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" name="desc" rows="3"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Submit</button>
            </form>
        </div>';
        }
        else{
          echo '
          <div class="container">
          <h1>Start a Discussion</h1>
          <p class="lead">You are not logged in. Please login to be able to start a Discussion</p>
        </div>
     
          ';
        }
        ?>








        <div class="container mb-5"  id="ques">
        <h1 class="py-2">Browse Question</h1>
        <?php
        
    $id = $_GET['catid'];
    $sql = "SELECT * FROM `thread` WHERE thread_cat_id=$id"; 
    $result = mysqli_query($conn, $sql);
    $noresult=true;
    while($row = mysqli_fetch_assoc($result)){
        $noresult=false;
        $id = $row['thread_id'];
        $tittle = $row['thread_title'];
        $desc = $row['thread_desc'];
        $thread_time=$row['dt'];
        $thread_user_id=$row['thread_use_id'];
        $sql2="SELECT user_email FROM `users` WHERE sno='$thread_user_id'";
        $result2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($result2);
        
        
        
       
    
       echo '<div class="d-flex ">
  <div class="flex-shrink-0">
    <img src="userdef.jpg" width="55px" alt="...">
  </div>
     <div class="flex-grow-1 ms-3">'.
    '<h4><a class="text-dark" href="thread.php?threadid='.$id.'">'.$tittle.'</a></h4>
      '.$desc.'</div>'.' <p class="fw-bold my-0"> ask by: '.$row2['user_email'].'  '. $thread_time .' </p>'.
'</div>';

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
</div>



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