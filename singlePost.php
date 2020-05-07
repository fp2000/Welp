<!DOCTYPE html>
<html lang="en">
<?php
session_start();
?>

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="public/css/mainStyle.css">
  <link rel="stylesheet" type="text/css" href="public/css/toggleSwitch.css">
  <link rel="stylesheet" type="text/css" href="public/css/singlePost.css">
  <link href="https://fonts.googleapis.com/css?family=Montserrat&display=swap" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  <title>Single Post</title>
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
            <a class="dropdown-item" href="profile.php?nickName=<?php echo $_SESSION["nickName"]; ?>">Control Panel</a>
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

    <div class="row">
      <div class="col-md-9">

        <!-- Post Details -->
        <div class="row">
          <div class="col-md-12">
            <div id="post">
              <div class="singlePost mainBorder gray">
                <h2 id="singlePostTitle" class="singlePostTitle"></h2>
                <div class="singlePostDetails">
                  <div class="row">
                    <div class="col-md-12">Published the <span id="publishDate"></span> by <span id="author"></span></div>
                  </div>
                </div>
                <div class="singlePostText" id="text"></div>
                <div class="singlePostMedia">
                  <div class="singlePostMediaContent">
                    <div id="content"></div>
                  </div>                  
                </div>
                <span class="modifyPostButton" id="modifyPostButton"></span>
                <span class="deletePostButton" id="deletePostButton"></span>
              </div>              
            </div>
          </div>
        </div>
        <!-- End Post Detais -->
        <div class="row">
          <div class="col-md-12">
            <!-- Comment reply formulary -->
            <div id="notCreateCommentArea">
              <div class="row m-3">
                <div class="col-md-12 notCreatePostDiv">
                  <div class="notCreatePostDivText">
                    If you want to create a post or give an opinion <a onclick="$('#login').modal('show')">Login</a> or <a href="registration.html">create an account</a>
                  </div>
                </div>
              </div>
            </div>

            <div class="commentArea mainBorder d-none" id="commentArea">
              <div class="row">
                <div class="col-md-12">
                  <h5>Leave a comment</h5>
                </div>
                <div class="col-md-12">
                  <form action="./functions/submitReply.php" method="POST">
                    <div class="form-group">
                      <textarea class="form-control" id="replyTextBox" name="text" rows="3" required></textarea>
                    </div>
                    <input type="hidden" id="nickName" name="nickName" value="<?php echo $_SESSION["nickName"]; ?>">
                    <input type="hidden" id="userId" name="userId" value="<?php echo $_SESSION["userId"]; ?>">
                    <input type="hidden" id="postId" name="postId" value="<?php echo $_GET['postId']; ?>">
                    <button id="btnSubmitReply" type="submit" class="btn btn-primary button1" value="OK">Submit your reply</button>
                  </form>
                </div>
              </div>
            </div>
            <!--End Comment reply formulary -->
            <!-- Comment area -->
            <div class="commentArea mainBorder">
              <div id="replySection">

                <div class="row">
                  <div class="col-md-12">
                    <h4 class="mt-2">Comments (<span id="commentsNumber"></span>)</h4>
                  </div>
                </div>

                <div id="placeHolder"></div>
              </div>
              <!-- End Comment area -->

            </div>
          </div>
        </div>
      </div>

      <div class="col-md-3">
        <!-- Small details -->
        <div class="singlePostRating mainBorder">
          <div class="row">
            <div class="col-md-12">
              <span>Topic</span> : <span id="topic"></span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <span id="likeAction">Likes</span> : <span id="likes">asdfasdf</span>
            </div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <span id="visits"></span> Visits
            </div>
          </div>
          <div class="row ">
            <div class="col-md-12">
              <div>
                <span id="ratingReplys"></span> Replys
              </div>
            </div>
          </div>
        </div>
        <!-- Small details -->

        <!-- Recommended posts area -->
        <div class="recommendedPosts mainBorder">
          <h5 class="pt-1">Recommended Posts</h5>
          <div id="recommendedPostsPlaceHolder"></div>
        </div>
        <!-- End Recommended posts area -->
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

<!-- Edit post modal -->
    <div class="modal fade" id="editPost" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modify Post</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form action="functions/modifyPost.php" method="POST" enctype="multipart/form-data">
            <div class="modal-body">
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                      <label for="title">Post Title </label>
                      <input type="text" name="modifyPostTitle" class="form-control" id="modifyPostTitle" required>          
                      </div>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-12">
                      <div class="form-group">
                          <label for="text">Text</label>
                          <textarea class="form-control" id="modifyPostText" name="modifyPostText" rows="3" required></textarea>
                      </div>
                  </div>
              </div>
              <div class="row" id="modifyPostContentModal"></div>

              <input type="hidden" id="modifyPostAuthor" name="postAuthor">
              <input type="hidden" id="author" name="author" value="<?php echo $_SESSION["nickName"];?>">
              <input type="hidden" id="postId" name="postId" value="<?php echo $_GET["postId"];?>">

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
              <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
          </form>
        </div>
      </div>
    </div>

<!--End Edit post modal -->

<!-- Delete post confirmation -->
    <div class="modal fade" id="deletePostConfirmation" tabindex="-1" role="dialog"  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          
          <div class="modal-body">
            Are you sure you want to delete this post?
          </div>
          <div class="modal-footer">
            <form action="functions/deletePost.php" method="POST" enctype="multipart/form-data">     
              <input type="hidden" id="deletePostAuthor" name="deletePostAuthor">
              <input type="hidden" id="author" name="author" value="<?php echo $_SESSION["nickName"];?>">
              <input type="hidden" id="postId" name="postId" value="<?php echo $_GET["postId"];?>">
              <button type="submit" class="btn btn-danger">Delete Post</button>
            </form>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          </div>
        </div>
      </div>
    </div>
<!--End Delete post confirmation -->

<!-- Modify reply modal -->
<div class="modal fade" id="modifyReplyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <form action="functions/modifyReply.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">

          <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                      <label for="text">Text</label>
                      <textarea class="form-control" id="modifyReplyText" name="modifyReplyText" rows="3" required></textarea>
                  </div>
              </div>
          </div>
          <input type="hidden" id="modifyReplyId" name="modifyReplyId">
          <input type="hidden" id="modifyReplyAuthor" name="modifyReplyAuthor">
          <input type="hidden" id="author" name="author" value="<?php echo $_SESSION["nickName"];?>">
          <input type="hidden" id="postId" name="postId" value="<?php echo $_GET["postId"];?>">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>

    </div>
  </div>
</div>
<!-- End modify reply modal -->

<!-- Delete reply confirmation -->
  <div class="modal fade" id="deleteReplyConfirmation" tabindex="-1" role="dialog"  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        
        <div class="modal-body">
          Are you sure you want to delete this reply?
        </div>
        <div class="modal-footer">
          <form action="functions/deleteReply.php" method="POST" enctype="multipart/form-data">     

            <input type="hidden" id="deleteReplyId" name="deleteReplyId">
            <input type="hidden" id="deleteReplyAuthor" name="deleteReplyAuthor">
            <input type="hidden" id="author" name="author" value="<?php echo $_SESSION["nickName"];?>">
            <input type="hidden" id="postId" name="postId" value="<?php echo $_GET["postId"];?>">

            <button type="submit" class="btn btn-danger">Delete Reply</button>
          </form>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
<!-- End Delete reply confirmation -->


<!-- Modify ChildReply modal -->
<div class="modal fade" id="modifyChildReplyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      
      <form action="functions/modifyChildReply.php" method="POST" enctype="multipart/form-data">
        <div class="modal-body">

          <div class="row">
              <div class="col-md-12">
                  <div class="form-group">
                      <label for="text">Text</label>
                      <textarea class="form-control" id="modifyChildReplyText" name="modifyChildReplyText" rows="3" required></textarea>
                  </div>
              </div>
          </div>
          <input type="hidden" id="modifyChildReplyId" name="modifyChildReplyId">
          <input type="hidden" id="modifyChildReplyAuthor" name="modifyChildReplyAuthor">
          <input type="hidden" id="modifyChildReplyChildReplyId" name="modifyChildReplyChildReplyId">
          <input type="hidden" id="author" name="author" value="<?php echo $_SESSION["nickName"];?>">
          <input type="hidden" id="postId" name="postId" value="<?php echo $_GET["postId"];?>">

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Save changes</button>
        </div>
      </form>

    </div>
  </div>
</div>
<!-- End modify ChildReply modal -->

<!-- Delete ChildReply confirmation -->
  <div class="modal fade" id="deleteChildReplyConfirmation" tabindex="-1" role="dialog"  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        
        <div class="modal-body">
          Are you sure you want to delete this reply?
        </div>
        <div class="modal-footer">
          <form action="functions/deleteChildReply.php" method="POST" enctype="multipart/form-data">     

          <input type="hidden" id="deleteChildReplyId" name="deleteChildReplyId">
          <input type="hidden" id="deleteChildReplyAuthor" name="deleteChildReplyAuthor">
          <input type="hidden" id="deleteChildReplyChildReplyId" name="deleteChildReplyChildReplyId">
          <input type="hidden" id="author" name="author" value="<?php echo $_SESSION["nickName"];?>">          
          <input type="hidden" id="postId" name="postId" value="<?php echo $_GET["postId"];?>">

            <button type="submit" class="btn btn-danger">Delete Reply</button>
          </form>
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
      </div>
    </div>
  </div>
<!-- End Delete ChildReply confirmation -->





</body>
<script>
  function replyAction(replyId) {
    if (<?php echo isset($_SESSION["nickName"]) ? "true" : "false";?>){
      showReplyBox(replyId);
    } else {
      $('#login').modal('show');
    }
  }
  var currentUser = "<?php echo $_SESSION["nickName"];?>";

</script>
<script src="public/js/serverUrl.js"></script>
<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script src="public/js/singlePost.js"></script>
<script src="public/js/darkMode.js"></script>
<script src="public/js/recommendedPosts.js"></script>
<script src="public/js/changeMenu.js"></script>

<script>
  //document.getElementById("currentUrl").value = window.location.href;



  function showReplyBox(replyId) {
    text = `
          <div class="row" id="rb${replyId}">
            <div class="col-md-1">
            </div>
            <div class="col-md-10">
              <form action="./functions/submitChildReply.php" method="POST">
                <div class="form-group">
                  <textarea id="txtA${replyId}" class="form-control" id="text" name="text" rows="3" required></textarea>
                </div>
                
                <input type="hidden" id="nickName" name="nickName" value="<?php echo isset($_SESSION['nickName']) ? $_SESSION['nickName'] : "undefined" ?>">
                <input type="hidden" id="userId" name="userId" value="<?php echo isset($_SESSION['userId']) ? $_SESSION['userId'] : "undefined" ?>">
                <input type="hidden" id="postId" name="postId" value="<?php echo $_GET['postId']; ?>">
                <input type="hidden" name="replyId" value="${replyId}">
                <button type="submit" id="sbmt${replyId}" class="btn btn-primary button1" value="OK">Submit your reply</button>
              </form>
            </div>
          </div>
          `;
    document.getElementById("bt" + replyId).onclick = function() {
      hide(replyId);
    };
    $(text).insertAfter($('#r' + replyId));
  }

  function hide(replyId) {
    $('#rb' + replyId).remove();
    document.getElementById("bt" + replyId).onclick = function() {
      showReplyBox(replyId);
    };
  }
</script>

</html>

<?php
if (isset($_SESSION["nickName"])) {
  echo '<script>hideMenus();</script>';
  echo '<script>showCommentBoxSinglePost();</script>';
}
?>