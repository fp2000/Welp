const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const postId = urlParams.get('postId');

var modifyContentModal = `
    <div class="col-md-12">
        <div class="form-group">
            <label for="content">Enter your video url here</label>
            <textarea class="form-control" id="modifyPostContent" name="modifyPostContent" rows="3"></textarea>
        </div>
    </div>`;



fetch(serverUrl + '/post/'+ postId).then(function (response) {
        return response.json();        
    }).then (function(post){
        document.title = post.title;
        var postDate = new Date(post.creationDate).toLocaleString();
        document.getElementById('singlePostTitle').innerHTML= post.title;
        document.getElementById('publishDate').innerHTML= postDate;
        document.getElementById('author').innerHTML= `<a href="profile.php?nickName=${post.author}">${post.author}</a>`;
        document.getElementById('text').innerHTML= post.text;
        document.getElementById('likes').innerHTML= post.likes.length;
        document.getElementById('visits').innerHTML= post.visits;
        document.getElementById('topic').innerHTML= post.topic;
        if (post.content != undefined){
            document.getElementById('content').innerHTML= post.content;        
            document.getElementById('modifyPostContentModal').innerHTML= modifyContentModal;
        }        
        if (currentUser === post.author) {
            $('#modifyPostButton').html('<button type="button" id="navLogInBtn" class="btn btn-primary button1" data-toggle="modal" data-target="#editPost">Edit</button>');
            $('#deletePostButton').html('<button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deletePostConfirmation">Delete post</button>');

            document.getElementById("modifyPostAuthor").value=post.author;
            document.getElementById("deletePostAuthor").value=post.author;
            document.getElementById("modifyPostTitle").value=post.title;
            document.getElementById("modifyPostText").value=post.text;
            document.getElementById("modifyPostContent").value=post.content;
        }

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
        var date = new Date(replys[i].date).toLocaleString();
        let text = `
                <div class="singleReply" id="r${replys[i].replyId}">
                <hr>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-12">
                                    Author:  ${replys[i].nickName} Date: ${date}
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    ${replys[i].text}
                                </div>  
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="row">
                                <div class="col-md-7"></div>
                                <div class="col-md-5" replyButton">
                                    <button type="button" id="bt${replys[i].replyId}" class="btn btn-success button1" onclick="replyAction('${replys[i].replyId}')"> Send reply </button>
                                </div>
                            </div>
                            <br>`
                if (currentUser === replys[i].nickName) {
                    text+= `
                            <div class="row">                            
                                <div class="col-md-7">                                    
                                </div>
                                <div class="col-md-2 replyButton">
                                    <button type="button" class="btn btn-success button1" data-toggle="modal" data-target="#modifyReplyModal" onclick="fillModifyReplyFormulary('${replys[i].replyId}', '${replys[i].text}', '${replys[i].nickName}')">
                                        <i class="material-icons">edit</i></i>
                                    </button>
                                </div>
                                <div class="col-md-2 replyButton">
                                    <button type="button" class="btn btn-success button1" data-toggle="modal" data-target="#deleteReplyConfirmation" onclick="fillDeleteReplyConfirmation('${replys[i].replyId}', '${replys[i].nickName}')" >
                                        <i class="material-icons">delete</i></i>
                                    </button>
                                </div>
                            </div>`
                }
                text += `
                        </div>
                        
                    </div>
                    
                    
                    `;
                for (j = 0; j < replys[i].replys.length; j++) {
                    var date = new Date(replys[i].replys[j].date).toLocaleString();
                    text+= `
                        <div class="replyReply mt-1">
                            <div class="row">
                                <div class="col-md-1"></div>
                                <div class="col-md-7">
                                    <div class="row">
                                        <div class="col-md-12"> Author: ${replys[i].replys[j].nickName} Date: ${date} </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12"> ${replys[i].replys[j].text} </div>
                                    </div>
                                </div>`
                                if (currentUser === replys[i].replys[j].nickName) {
                                    text+= `
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-4"></div>
                                                    <div class="col-md-3 replyButton">
                                                        <button type="button" class="btn btn-success button1" data-toggle="modal" data-target="#modifyChildReplyModal" onclick="fillModifyChildReplyFormulary('${replys[i].replyId}', '${replys[i].replys[j].text}', '${replys[i].replys[j].nickName}', '${replys[i].replys[j].childReplyId}')">
                                                            <i class="material-icons">edit</i></i>
                                                        </button>
                                                    </div>
                                                    <div class="col-md-3 replyButton">
                                                        <button type="button" class="btn btn-success button1" data-toggle="modal" data-target="#deleteChildReplyConfirmation" onclick="fillDeleteChildReplyConfirmation('${replys[i].replyId}', '${replys[i].replys[j].nickName}', '${replys[i].replys[j].childReplyId}')" >
                                                            <i class="material-icons">delete</i></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>`
                                }
                                text += `
                            </div>
                        </div>
                        `;
                }
            text += 
            '</div>';
        $(text).insertAfter($('#placeHolder'));
    }      
  });

  function fillModifyReplyFormulary(replyId, replyText, nickName) {
    document.getElementById("modifyReplyText").value=replyText;
    document.getElementById("modifyReplyId").value=replyId;
    document.getElementById("modifyReplyAuthor").value=nickName;
}

function fillDeleteReplyConfirmation(replyId, nickName) {
    document.getElementById("deleteReplyId").value=replyId;
    document.getElementById("deleteReplyAuthor").value=nickName;
}

function fillModifyChildReplyFormulary(replyId, replyText, nickName, childReplyId) {
    document.getElementById("modifyChildReplyText").value=replyText;
    document.getElementById("modifyChildReplyId").value=replyId;
    document.getElementById("modifyChildReplyAuthor").value=nickName;
    document.getElementById("modifyChildReplyChildReplyId").value=childReplyId;
}

function fillDeleteChildReplyConfirmation(replyId, nickName, childReplyId) {
    document.getElementById("deleteChildReplyId").value=replyId;
    document.getElementById("deleteChildReplyAuthor").value=nickName;
    document.getElementById("deleteChildReplyChildReplyId").value=childReplyId;
}