addContent(0);
var lastPosition = 0;

function checkI (i){
  if (i % 2 == 0) {
      return "lightGray";
  } else {
      return "gray";
  }        
}

$(document).ready(function() { 
  $(window).scroll(function(){    
    if ($(window).scrollTop() >= $(document).height() - $(window).height() - 10) {
      console.log(lastPosition);
      callAddContent();
      
    }
  });
});


var canGo = true,
    delay = 2000;

function callAddContent() {
    if (canGo) {
        canGo = false;
        addContent(lastPosition);

        setTimeout(function () {
            canGo = true;
        }, delay)
    } else {
    }
}

function addContent(positions) {
  fetch(serverUrl + '/posts/'+ positions).then(function (response) {
    return response.json();
  }).then (function(posts){
      
      if (posts.length > 0){
        lastPosition += 10;
      }
      text = "";
      for (i = 0; i < posts.length; i++) {
          let postId = posts[i].postId;
          let likes = posts[i].likes.length;

          text += `
              <div class="indexPost ${checkI(i)}">
                <a id="${postId}" class="indexPostTitleLink" href="singlePost.php?postId=${postId}"><h4 class="indexPostTitle">${posts[i].title}</h4></a>
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
                </div>`
                if (posts[i].content != undefined) {
                  text+= `
                  <div class="indexPostMedia">
                    <div class="indexPostMediaContent">
                        ${posts[i].content}
                    </div>
                  </div>`;
                }
                text+=`
                <div class="indexPostRating">
                  <div class="row">
                    <div class="col-md-3">
                      <button class="btn btn-success button1" id="likeBtn${posts[i].postId}" onclick="likeButton('${posts[i].nickName}', '${posts[i].postId}')">Likes: ${likes}</button>
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