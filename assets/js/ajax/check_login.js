$.ajax({
    url: '../apis/check_login.php',
    type: 'POST',
    success: function(response) {
        // console.log(response);
        response = JSON.parse(response);
        console.log(response.result);
        if (response.status == "success") {
            
            $('.user_name').html("welcome" + response.result.name + ":)");
        } else {
            swal('Login to continue!', '', 'error').then((value) => {
                window.location = './login.html';
            });
        }
    }
});