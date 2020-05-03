function verify(){
    var pw1 = $("#password1").val();
    var pw2 = $("#password2").val();
    if (pw1.localeCompare(pw2) == 0){
        $("#error").text("");
    } else {
        $("#error").text("Passwords have to be the same");            
    }         
}