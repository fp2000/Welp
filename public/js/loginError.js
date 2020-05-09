function loginError(error) {
    $('#loginError').removeClass('d-none');
    $('#loginErrorText').text(error);
}