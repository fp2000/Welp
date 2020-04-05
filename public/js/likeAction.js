function likeAction (nickName, postId) {
    fetch(serverUrl + '/post/like/' + postId + '/'+ nickName).then(function (response) {
        return response;
    }).then (function(action){
        console.log(action);
    });
}



