<!DOCTYPE html>
<html lang="en">
<?php
session_start();
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
    <title>Account <?php echo $_SESSION["status"]?></title>
</head>
<body>
    
    <div class="container">
      <div class="bgBlack">
        <div class="bgWhite">
          <div class="row">
            <div class="col-md-12">
              <h1>Your account has been <?php echo $_SESSION["status"]?></h1>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <p>Your account is not available right now</p>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <br>
              <a href="functions/logOut.php">Back to home</a>
            </div>
          </div>
          
        </div>
      </div>
    </div>
</body>

<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</html>