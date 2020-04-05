
fetch(serverUrl + '/posts/recommended/').then(function (response) {
    return response.json();
}).then (function(posts){
    var text = "";

    for (i = 0; i < posts.length; i++) {
        text += `
            <div class="singleRecommendedPost">
                <div class="row">
                    <div class="col-md-12">
                        <a href="singlePost.php?postId=${posts[i].postId}"><h5>${posts[i].title}</h5></a>                    
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <h5>${posts[i].visits} visits</h5>                
                    </div>
                </div>
            </div>            
        `;

    }
    document.getElementById('recommendedPostsPlaceHolder').innerHTML = text;
});