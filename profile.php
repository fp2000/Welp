<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link id="link" rel="stylesheet" type="text/css" href="public/css/mainStyle.css">
    <link id="link" rel="stylesheet" type="text/css" href="public/css/toggleSwitch.css">
    <link id="link" rel="stylesheet" type="text/css" href="public/css/profileStyle.css">
    <title>Inicio</title>
</head>
<body class="light-mode" id="body">

<!--NavBar-->
<nav class="navbar navbar-expand-lg navbar-light customNavBar mb-3">
    <a class="navbar-brand" href="index.php">WELP!</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">

      <ul class="navbar-nav ml-auto" id="notLoggedOptions">
        <li class="nav-item active">
          <button type="button" class="btn btn-primary button1" data-toggle="modal" data-target="#login">Log In</button>
          <a href="registration.html" class="btn btn-success button1">Sign Up</a>
        </li>
      </ul>
      <ul class="navbar-nav ml-auto d-none" id="userOptions">
        <li class="nav-item">
          <a class="nav-link disabled" href="#">Welcome back <span class="firstName"><?php echo $_SESSION["firstName"]; ?></span></a>
        </li>
        <li class="nav-item dropdown mr-5">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            My account
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="profile.php?userId=<?php echo $_SESSION["userId"]; ?>">Control Panel</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="functions/logOut.php">Log Out</a>
          </div>
        </li>   
      </ul>
    </div>
  </nav>
<!--End NavBar-->


  <div class="container">
    
  <div class="row">
      <div class="col-md-4">

<!-- Profile details -->
        <div class="mainBorder mainBackground">
          <div class="row">
            <div class="col-md-12 d-flex justify-content-center">
              <img id="profilePicture" class="m-3" src="">
            </div>
          </div>
          <div class="row m-2 align-items-center">          
            <div class="col-md-12">
              <h4 id="profileNickName" class="ml-1"></h4>
              <hr>
            </div>
          </div>
          <div class="row m-2">
            <div class="col-md-6"><div id="profileName"></div><hr></div>
            <div class="col-md-6"><div id="profileLastName"></div><hr></div>
          </div>
          <div class="row m-2 mb-4">
            <div class="col-md-12">Registered since: <span id="profileRegDate"></span></div>            
          </div>
          <div class="d-none" id="userModificationButton">
            <div class="d-flex justify-content-center">
              <a href="accountSettings.php" class="btn btn-success button1">Edit</a>
            </div> 
          </div>
          
        </div>
<!--End Profile details -->

      </div>  

<!-- User Profile posts -->
      <div class="col-md-8">
        <div class="recommendedPosts mainBorder">
          <h5 class="pt-1"><div id="userPostsName"></div></h5>
          <div id="postsPlaceHolder"></div>
        </div>
      </div>
<!-- End User Profile posts -->

    </div>    
  </div>




    
</body>
<script src="public/js/serverUrl.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="public/js/profile.js"></script>
<script src="public/js/changeMenu.js"></script>
<script>
  //document.getElementById("currentUrl").value=window.location.href;


</script>
<?php
  if (isset($_SESSION["nickName"])){    
    echo '<script>hideMenus();</script>';
    if ($_SESSION["nickName"] == $_GET['nickName']){
      echo '<script>showModifyUserMenu();</script>';
    }
  }
?>
</html>