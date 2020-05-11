<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (isset($_SESSION["status"])){
  if ($_SESSION["status"] == "active") {
  }
  else if (($_SESSION["status"] == "pending")){
    header("Location: accountConfirmation.php");
  } else {
    header("Location: unavaliableAccount.php");
  }
}
?>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="public/css/mainStyle.css">
    <link rel="stylesheet" type="text/css" href="public/css/toggleSwitch.css">
    <link rel="stylesheet" type="text/css" href="public/css/singlePost.css">
    <link rel="stylesheet" type="text/css" href="public/css/accountConfirmationStyle.css">  
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <meta charset="UTF-8">
    <title>Account succesfully activated</title>
</head>
<body>
<!--NavBar-->
  <nav class="navbar navbar-expand-lg navbar-light customNavBar">
    <a class="navbar-brand" id="navBarLogo" href="index.php">WELP!</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">

      <ul class="navbar-nav ml-auto" id="notLoggedOptions">
        <li class="nav-item active">
          <button type="button" id="navLogInBtn" class="btn btn-primary button1" data-toggle="modal" data-target="#login">Log In</button>
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
            <a class="dropdown-item" href="profile.php?nickName=<?php echo $_SESSION["nickName"]; ?>">My profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="accountSettings.php?nickName=<?php echo $_SESSION["nickName"]; ?>">Settings</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" id="btnNavBarLogOut" href="functions/logOut.php">Log Out</a>
            <div class="dropdown-divider"></div>
            <span class="dropdown-item">Dark mode</span>
            <label class="switch">            
              <input type="checkbox" onchange="toggleDarkLight()">
              <span class="slider round"></span>
            </label>
          </div>
        </li>
      </ul>
    </div>
  </nav>
<!--End NavBar-->
    
<div class="container">
      <div class="bgBlack">
        <div class="bgWhite">
          <div class="row">
            <div class="col-md-12">
              <h1>Your account has been activated</h1>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <p>Congratulations, now you are a member of the welp community.</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <p>You can now log in to your account here: <a onclick="$('#login').modal('show')">Login</a> or go back to <a href="index.php">index</a></p>
            </div>
          </div>
          
        </div>
    </div>
</div>

    <!--Login Modal-->
    <div class="modal fade" id="login" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Login</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

                <form action="functions/userLogin.php" method="POST" enctype="multipart/form-data">
                  <div class="form-group">
                    <input id="modalLogInNickName" class="form-control" type="text" name="nickName" placeholder="Username" required>
                    <br>
                    <input id="modalLogInPassword" class="form-control" type="password" name="password" placeholder="Password" required>
                    <br>
                    <input type="hidden" id="currentUrl" name="currentUrl" value=CurrentUrl>

                    <button type="submit" id="modalLogInBtn" class="btn btn-primary button1" >Log In</button>
                    
                  </div>
                  
                </form>
            </div>
            <div class="modal-footer d-flex justify-content-center modalBottom">
              <p>Don't have an account? Create yours <a href="registration.html">here</a>!</p>
            </div>
          </div>
        </div>
    </div>
<!--End Login Modal-->




</body>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>