const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const postId = urlParams.get('postId');




fetch(serverUrl + '/post/'+ postId).then(function (response) {
        return response.json();        
    }).then (function(post){
        document.title = post.title;
        document.getElementById('singlePostTitle').innerHTML= post.title;
        document.getElementById('publishDate').innerHTML= post.creationDate;
        document.getElementById('author').innerHTML= `<a href="profile.php?nickName=${post.author}">${post.author}</a>`;
        document.getElementById('text').innerHTML= post.text;
        document.getElementById('likes').innerHTML= post.likes;
        document.getElementById('visits').innerHTML= post.visits;
        document.getElementById('topic').innerHTML= post.topic;
        
});

setTimeout(function () {
    fetch(serverUrl + '/post/visit/'+ postId);
}, 5000);




fetch(serverUrl + '/replys/postId/'+ postId).then(function (response) {
    return response.json();
  }).then (function(replys){
    $('#ratingReplys').text(replys.length);
    $('#commentsNumber').text(replys.length);


    for (i = 0; i < replys.length; i++) {
        let text = `
                <div class="singleReply" id="r${replys[i].replyId}">
                <hr>
                    <div class="row">
                        <div class="col-md-4">
                            Author:  ${replys[i].nickName}
                            <br>
                            Date: ${replys[i].date}
                        </div>
                        <div class="col-md-4">
                            ${replys[i].text}
                        </div>
                        <div class="col-md-3 replyButton">
                            <button type="button" id="bt${replys[i].replyId}" class="btn btn-success button1" onclick="replyAction('${replys[i].replyId}')"> Send reply </button>              
                        </div>
                    </div>`;
                for (j = 0; j < replys[i].replys.length; j++) {
                    text+= `
                        <div class="replyReply">
                            <div class="row">
                                <div class="col-md-1">
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        <div class="col-md-4">
                                            Author: ${replys[i].replys[j].nickName}
                                            <br>
                                            Date: ${replys[i].replys[j].date}
                                        </div>
                                        <div class="col-md-6">
                                            ${replys[i].replys[j].text}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        `;
                }
            text += 
            '</div>';
        $(text).insertAfter($('#placeHolder'));
    }      
  });

