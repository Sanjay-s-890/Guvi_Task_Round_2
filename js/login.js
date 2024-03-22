$(document).ready(function() {
    $('#login-form').submit(function(e) {
        e.preventDefault();
        var email = $('#email').val();
        var password = $('#password').val();
        $.ajax({
            type: 'POST',
            url: '../php/login.php',
            data: { email: email, password: password },
            success: function(response) {
                if(response === 'success') {
                    localStorage.setItem('current_loggedin_email', email);
                    window.location.href = "profile.html";
                } else {
                    alert('Invalid login credentials!');
                }
            }
        });
    });
});