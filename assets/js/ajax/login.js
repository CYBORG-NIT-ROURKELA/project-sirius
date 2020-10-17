$(document).ready(function() {
    $("#loginForm").on('submit', (function(e) {
        e.preventDefault();
        var loginEmail = $("#email").val();
        var loginPassword = $("#password").val();
        $.ajax({
            url: '../apis/login.php',
            data: {
                loginEmail: loginEmail,
                loginPassword: loginPassword,
            },
            type: 'POST',
            success: function(response) {
                // console.log((response));
                var res = JSON.parse(response);
                if (res.status == "success") {
                    // alert(res.message);
                    swal('Login Successfull!', '', 'success').then((value) => {
                        window.location = '../views/admin.html';
                    });
                } else {
                    swal(res.message, '', 'error');

                }
            }
        });
        return false;
    }));
    return false;
});