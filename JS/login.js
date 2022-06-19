function ShowRegisterForm() {
    $(".login form[name='login-form']").slideUp(200);
    $(".login form[name='register-form']").slideDown(200);
}
function ShowLoginForm() {
    $(".login form[name='register-form']").slideUp(200);
    $(".login form[name='login-form']").slideDown(200);
}