<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if (!isset($_SESSION["nickName"]) && !isset($_SESSION["userId"])){
  header('Location: index.php');
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link id="link" rel="stylesheet" type="text/css" href="public/css/mainStyle.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
    <title>Create Post</title>
</head>
<body>

<!--NavBar-->
<nav class="navbar navbar-expand-lg navbar-light customNavBar">
    <a class="navbar-brand" id="navBarLogo" href="index.php">WELP!</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto" id="userOptions">
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
            <form action="functions/logOut.php" method="POST" enctype="multipart/form-data">
              <button type="submit" class="dropdown-item" id="btnNavBarLogOut">Log Out </button>
            </form>       
          </div>
        </li>
      </ul>
    </div>
  </nav>
<!--End NavBar-->

    <div class="container">
      <h1 class="m-4">Create a new Post</h1>
      <div class="row">

<!--Post Formulary div-->
        <div class="col-md-7">
            <form action="functions/submitPost.php" method="POST" enctype="multipart/form-data">
                <div class="row mt-4">
                    <div class="col-md-7">
                        <div class="form-group">
                        <label for="title">Post Title </label>
                        <input id="titleTxtPostForm" type="text" name="title" class="form-control" id="title" required>          
                        </div>
                    </div>

                    <div class="col-md-5">
                        <label for="topic">Please, select a topic</label>
                        <div class="form-group">
                            <select class="form-control" id="topic" name="topic" required>
                            </select>
                        </div>
                    </div>

                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="text">Text</label>
                            <textarea id="textTxtPostForm" class="form-control" id="text" name="text" rows="3" required></textarea>
                        </div>
                    </div>
                </div>

                <div class="row mt-4">                    
                    <div class="col-md-12">
                        <h5 class="mb-4">Insert Video (Optional)</h5>
                        <div class="form-group">
                          <label for="content">Enter your video url here</label>
                          <textarea class="form-control" id="content" name="content" rows="3"></textarea>                             
                        </div>
                    </div>
                </div>
                <p class="mt-4">Please make sure the content you are uploading does not contain sensible or nsfw content before posting it</p>
                <input type="hidden" id="author" name="author" value="<?php echo $_SESSION["nickName"];?>">
                <input type="hidden" id="userId" name="userId" value="<?php echo $_SESSION["userId"];?>">


                <button id="btnSubmitPost" type="submit" class="btn btn-primary button1" value="OK">Submit your new Post</button>
            </form>
        </div>
<!--End Post Formulary div-->

<!--Recommended Posts Area-->
    <div class="col-md-5">
      <div class="recommendedPosts mainBorder">
        <h5 class="pt-1">Recommended Posts</h5>
        <div id="recommendedPostsPlaceHolder">
        </div>
      </div>
    </div>    
<!--End Recommended Posts Area-->
      </div>    
    </div>

    
</body>
<script src="public/js/serverUrl.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="public/js/recommendedPosts.js"></script>

<script>

fetch(serverUrl + '/topics/').then(function (response) {
    return response.json();
}).then (function(topics){ 
    text = "";
    for (i = 0; i < topics.length; i++) {
        text += `<option value="${topics[i].topic}">${topics[i].topic}</option>`;
    }  
    document.getElementById("topic").innerHTML = text;
});

</script>
</html>