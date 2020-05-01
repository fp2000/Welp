function hideMenus() {
    $("#notLoggedOptions").addClass("d-none");
    $("#userOptions").removeClass("d-none");

    $("#notCreatePostDiv").addClass("d-none");
    $("#createPostDiv").removeClass("d-none");
}

function showCommentBoxSinglePost() {
    $("#notCreateCommentArea").addClass("d-none");
    $("#commentArea").removeClass("d-none");
}