const serverUrl = 'http://localhost:3000'; 
const queryString = window.location.search;
const urlParams = new URLSearchParams(queryString);
const nickName = urlParams.get('nickName');

fetch(serverUrl + '/user/'+ nickName).then(function (response) {
    return response.json();        
}).then (function(user){
    $("#profilePicture").attr("src", `http://localhost:3000/uploads/${user.nickName}.jpg`);
    $("#profileNickName").text(user.nickName);
    $("#profileName").text(user.firstName);
    $("#profileLastName").text(user.lastName);
    $("#profileRegDate").text(user.regDate);
});