function checkNickName(nickName) {
    fetch(serverUrl + '/user/check/'+ nickName).then(function (response) {
        return response.json();        
    }).then (function(user){
        if (!user) {
            $('#nickNameError').text('nickName not available');
        }
    });    
}