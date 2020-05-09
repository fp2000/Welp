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
    echo $_SESSION["status"];
  }
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link id="link" rel="stylesheet" type="text/css" href="public/css/mainStyle.css">
    <link id="link" rel="stylesheet" type="text/css" href="public/css/toggleSwitch.css">
    <link id="link" rel="stylesheet" type="text/css" href="public/css/profileStyle.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <title><?php echo $_SESSION["nickName"]; ?> Account Settings</title>
</head>

<body class="light-mode" id="body">


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
            <a class="dropdown-item" href="profile.php?nickName=<?php echo $_SESSION["nickName"]; ?>">Settings</a>
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


<!-- Login Error -->
  <div class="alert alert-warning alert-dismissible fade show m-2 d-none" role="alert" id="loginError">
    <span id="loginErrorText"></span>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
      <span aria-hidden="true">&times;</span>
    </button>
  </div>
<!--End Login Error -->

  <div class="container">

    <div class="row mt-4">
      <div class="col-md-6">
        <div class="row">
          <div class="col-md-6">
            <h4>Personal data</h4>
            <p>First Name: <span id="profileName"></span></p>
            <p>Last Name: <span id="profileLastName"></span></p>
            <button class="btn btn-primary button1 m-1" data-toggle="modal" data-target="#modifyPersonalDataModal" >Modify personal data</button>
            <h4>Password</h4>
            <button class="btn btn-primary button1 m-1" data-toggle="modal" data-target="#modifyPasswordModal">Modify your password</button>
            
            <button type="button" class="btn btn-danger m-1" data-toggle="modal" data-target="#deleteAccountModal">Delete account</button>
            
          </div>
          <div class="col-md-6">
            <h4>Profile Picture</h4>
            <div class="col-md-12 d-flex justify-content-center">
              <img id="profilePicture" class="m-3" src="">
            </div>
            <button class="btn btn-primary button1 m-1" data-toggle="modal" data-target="#modifyProfilePictureModal">Modify your profile picture</button>
          </div>
        </div>
      </div>
      <!-- User Profile posts -->
      <div class="col-md-6">
        <div class="recommendedPosts mainBorder">
          <h5 class="pt-1"><div id="userPostsName"></div></h5>
          <div id="postsPlaceHolder"></div>
        </div>
      </div>
      <!-- End User Profile posts -->
    </div>  
</div>


<!-- Modify personal data modal -->
<div class="modal fade" id="modifyPersonalDataModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modify Personal data modal</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="functions/modifyPersonalData.php" method="POST" enctype="multipart/form-data">

        <div class="modal-body">
          <div class="row m-1">
            <div class="col-md-4">First Name</div>
            <div class="col-md-8"><input type="text" class="form-control" id="profileNameModal" name="profileNameModal"></div>
          </div>
          <div class="row m-1">
            <div class="col-md-4">Last Name</div>
            <div class="col-md-8"><input type="text" class="form-control" id="profileLastNameModal" name="profileLastNameModal"></div>
          </div>
        </div>
        <input type="hidden" id="nickName" name="nickName" value="" class="nickName">
        <input type="hidden" id="currentUrl" name="currentUrl" value="" class="currentUrl">
        <input type="hidden" id="currentUser" name="currentUser" value="<?php echo isset($_SESSION['nickName']) ? $_SESSION['nickName'] : "undefined" ?>">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>

      </form>
    </div>
  </div>
</div>
<!--End Modify personal data modal -->

<!-- Modify password modal -->
<div class="modal fade" id="modifyPasswordModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modify your password</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="functions/modifyPassword.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                      <label for="password1">Introduce a new password</label>
                      <input type="password" name="password1" class="form-control" id="password1" required>
                  </div>
              </div>                        
          </div>
        <input type="hidden" id="nickName" name="nickName" value="" class="nickName">
        <input type="hidden" id="currentUser" name="currentUser" value="<?php echo isset($_SESSION['nickName']) ? $_SESSION['nickName'] : "undefined" ?>">
          <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                      <label for="password2">Please, confirm your password</label>
                      <input onchange="verify()" type="password" name="password2" class="form-control" id="password2" required>
                      <span id="error"></span>
                  </div>
              </div>
          </div>
        
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
      
    </div>
  </div>
</div>
<!-- End Modify password modal -->

<!-- Modify profile picture modal -->
<div class="modal fade" id="modifyProfilePictureModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modify profile picture</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="functions/modifyProfilePicture.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">
          <p>Select your new profile picture here</p>
          <input type="file" id="photo" name="photo" accept="image/png, image/jpeg">
        </div>
        <input type="hidden" id="currentUrl" name="currentUrl" value="" class="currentUrl">
        <input type="hidden" id="author" name="author" value="" class="nickName">
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>
    </div>
  </div>
</div>
<!--End Modify profile picture modal -->

<!-- Delete Account Modal -->
<div class="modal fade" id="deleteAccountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Delete your account?</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        This action can not be undone, continue?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <form action="functions/deleteAccount.php" method="POST" enctype="multipart/form-data">
          <input type="hidden" id="nickName"  name="nickName" value="" class="nickName">
          <button type="submit" class="btn btn-danger m-1">Delete account</button>
        </form>
      </div>
    </div>
  </div>
</div>
<!--End Delete Account Modal -->


</body>

<script>
  var currentUser = "<?php echo isset($_SESSION['nickName']) ? $_SESSION['nickName'] : "undefined" ?>";
</script>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="public/js/serverUrl.js"></script>
<script src="public/js/profile.js"></script>
<script src="public/js/changeMenu.js"></script>
<script src="public/js/passwordValidator.js"></script>


<script>
  
  $(".currentUrl").val(window.location.href);
  //document.getElementById("currentUrl").value=window.location.href;
</script>
<?php
  if (isset($_SESSION["nickName"])){
    echo '<script>hideMenus();</script>';
  }
  if (isset($_GET['loginStatus'])){
    $error = $_GET['loginStatus'];
    echo "<script>loginError('$error')</script>";
  }
?>


</html>