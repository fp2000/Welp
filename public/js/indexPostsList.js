const serverUrl = 'http://localhost:3000'; 

addContent(0);

var lastPosition = 0;


function checkI (i){
  if (i % 2 == 0) {
      return "lightGray";
  } else {
      return "gray";
  }        
}


function addContent(positions) {
  fetch(serverUrl + '/posts/'+ positions).then(function (response) {
    return response.json();
  }).then (function(posts){
      lastPosition += 10;

      text = "";
      for (i = 0; i < posts.length; i++) {
          let postId = posts[i].postId;
          let likes = posts[i].likes.length;

          text += `
              <div class="indexPost ${checkI(i)}">
                <a class="indexPostTitleLink" href="singlePost.php?postId=${postId}"><h4 class="indexPostTitle">${posts[i].title}</h4></a>
                <div class="indexPostDetails">
                  <div class="row">
                    <div class="col">
                      Author: <a href="profile.php?nickName=${posts[i].author}">${posts[i].author}</a>
                    </div>
                    <div class="col">
                      Publication Date:${posts[i].creationDate}
                    </div>
                  </div>
                </div>
                <div class="indexPostText">
                    <a href="singlePost.php?postId=${postId}"><p>${posts[i].text}</p></a>
                </div>
                <div class="indexPostMedia">
                  <div class="indexPostMediaContent">
                      ${posts[i].content}
                  </div>
                </div>
                <div class="indexPostRating">
                  <div class="row">
                    <div class="col-md-3">
                      <button class="btn btn-success button1" onclick="likeAction('${posts[i].nickName}', '${posts[i].postId}')">${likes}</button>
                    </div>
                    <div class="col-md-3">
                      <a href="">${posts[i].topic}</a>
                    </div>
                    <div class="col-md-3">
                      <a href="">Visits</a>: ${posts[i].visits}
                    </div>
                  </div>
                </div>
            </div>

          `;
      }
      $(text).insertBefore($('#placeHolder'));
  });
}


$(document).ready(function() { 
  $(window).scroll(function(){
    if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10) {
      addContent(lastPosition);
    }
  });
});
