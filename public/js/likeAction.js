function likeAction (nickName, postId) {
    fetch(serverUrl + '/post/like/' + postId + '/'+ nickName).then(function (response) {
        return response;
    }).then (function(action){
        updateLikesNumber(postId);
    });

}
function updateLikesNumber(postId) {
    fetch(serverUrl + '/post/'+ postId).then(function (response) {
        return response.json();        
    }).then (function(post){
        $('#likeBtn' + postId).html("Likes: " + post.likes.length);
    });
}


