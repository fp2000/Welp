const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const nickName = urlParams.get('nickName');

fetch(serverUrl + '/user/'+ nickName).then(function (response) {
    return response.json();        
}).then (function(user){
    $("#profilePicture").attr("src", serverUrl + `/uploads/${user.nickName}.jpg`);
    $("#profileNickName").text(user.nickName);
    $("#profileName").text(user.firstName);
    $("#profileLastName").text(user.lastName);
    $("#profileRegDate").text(user.regDate);
    $("#userPostsName").text(user.nickName + "'s posts");
});


fetch(serverUrl + '/posts/author/' + nickName).then(function (response) {
    return response.json();
}).then (function(posts){
    var text = "";
    for (i = 0; i < posts.length; i++) {
        text += `
            <div class="singleRecommendedPost">
                <div class="row">
                    <div class="col-md-12"><a href="singlePost.php?postId=${posts[i].postId}"><h5>${posts[i].title}</h5></a></div>
                </div>
                <div class="row">
                    <div class="col-md-12"><h5>${posts[i].visits} visits</h5></div>
                </div>
            </div>`;
    };
    document.getElementById('postsPlaceHolder').innerHTML = text;
});

function showModifyUserMenu() {
    $("#userModificationButton").removeClass("d-none");
}