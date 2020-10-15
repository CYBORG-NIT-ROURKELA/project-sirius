const mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
$("#loginForm").on('submit', (function(e) {
    e.preventDefault();
    validateLoginForm();
}));
const validateLoginForm = () => {
    const loginEmail = document.getElementById("email");
    const loginPassword = document.getElementById("password");

    //EMAIL VALIDATIONS
    if (loginEmail.value == "") {
        document.getElementById("email-alert").innerHTML =
            "**email cannot be empty";
        loginEmail.addEventListener("click", () => {
            setInterval(() => {
                document.getElementById("email-alert").innerHTML = "";
            }, 2500);
        });
        return false;
    }
    if (!loginEmail.value.match(mailformat)) {
        document.getElementById("email-alert").innerHTML =
            "**invalid email adress";
        loginEmail.addEventListener("click", () => {
            setInterval(() => {
                document.getElementById("email-alert").innerHTML = "";
            }, 2500);
        });
        return false;
    }
    //PASSWORD VALIDATION
    if (loginPassword.value == "") {
        document.getElementById("password-alert").innerHTML =
            "**password cannot be empty";
        loginPassword.addEventListener("click", () => {
            setInterval(() => {
                document.getElementById("password-alert").innerHTML = "";
            }, 2500);
        });
        return false;
    }

};