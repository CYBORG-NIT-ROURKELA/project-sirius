//Login form validation
const mailformat = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
$("#loginForm").on('submit', (function(e) {
    e.preventDefault();
    validateLoginForm();
}));
const validateLoginForm = () => {
    const loginEmail = document.getElementById("email");
    const loginPassword = document.getElementById("password");

    //EMAIL VALIDATION
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

//Preview input values validation
$("#preview-btn").on('click', () => {
    validatePreview();
    // console.log("entered");
});
const validatePreview = () => {
    const fontStyle = document.getElementById("font-style");
    const fontSize = document.getElementById("font-size");
    const RColor = document.getElementById("color-r");
    const GColor = document.getElementById("color-g");
    const BColor = document.getElementById("color-b");
    const XCoordinate = document.getElementById("x-coordinate");
    const YCoordinate = document.getElementById("y-coordinate");

    // FONT STYLE VALIDATIONS
    if (fontStyle.value == "") {
        document.getElementById("fontstyle-alert").innerHTML =
            "**Font style cannot be empty, Select a font";
        fontStyle.addEventListener("click", () => {
            setInterval(() => {
                document.getElementById("fontstyle-alert").innerHTML = "";
            }, 2500);
        });
        return false;
    }

    // FONT SIZE VALIDATIONS
    if (fontSize.value == "") {
        document.getElementById("fontsize-alert").innerHTML =
            "**Font size cannot be empty";
        fontSize.addEventListener("click", () => {
            setInterval(() => {
                document.getElementById("fontsize-alert").innerHTML = "";
            }, 2500);
        });
        return false;
    }
    if (isNaN(fontSize.value)) {
        document.getElementById("fontsize-alert").innerHTML =
            "**font size contains only numbers";
        fontSize.addEventListener("click", () => {
            setInterval(() => {
                document.getElementById("fontsize-alert").innerHTML = "";
            }, 2500);
        });
        return false;
    }
    if (fontSize.value == 0) {
        document.getElementById("fontsize-alert").innerHTML =
            "**Font size cannot be zero";
        fontSize.addEventListener("click", () => {
            setInterval(() => {
                document.getElementById("fontsize-alert").innerHTML = "";
            }, 2500);
        });
        return false;
    }


    //RGB VALUES VALIDATION
    if (RColor.value == "") {
        document.getElementById("rcolor-alert").innerHTML =
            "**color_r cannot be empty";
        RColor.addEventListener("click", () => {
            setInterval(() => {
                document.getElementById("rcolor-alert").innerHTML = "";
            }, 2500);
        });
        return false;
    }
    if (isNaN(RColor.value)) {
        document.getElementById("rcolor-alert").innerHTML =
            "**color_r contains only numbers";
        RColor.addEventListener("click", () => {
            setInterval(() => {
                document.getElementById("rcolor-alert").innerHTML = "";
            }, 2500);
        });
        return false;
    }
    if (RColor.value < 0 && RColor.value > 255) {
        document.getElementById("rcolor-alert").innerHTML =
            "**should contain value from 0 to 255";
        RColor.addEventListener("click", () => {
            setInterval(() => {
                document.getElementById("rcolor-alert").innerHTML = "";
            }, 2500);
        });
        return false;
    }

    if (GColor.value == "") {
        document.getElementById("gcolor-alert").innerHTML =
            "**color_g cannot be empty";
        GColor.addEventListener("click", () => {
            setInterval(() => {
                document.getElementById("gcolor-alert").innerHTML = "";
            }, 2500);
        });
        return false;
    }
    if (isNaN(GColor.value)) {
        document.getElementById("gcolor-alert").innerHTML =
            "**color_g contains only numbers";
        GColor.addEventListener("click", () => {
            setInterval(() => {
                document.getElementById("gcolor-alert").innerHTML = "";
            }, 2500);
        });
        return false;
    }
    if (GColor.value < 0 && GColor.value > 255) {
        document.getElementById("gcolor-alert").innerHTML =
            "**should contain value from 0 to 255";
        GColor.addEventListener("click", () => {
            setInterval(() => {
                document.getElementById("gcolor-alert").innerHTML = "";
            }, 2500);
        });
        return false;
    }

    if (BColor.value == "") {
        document.getElementById("bcolor-alert").innerHTML =
            "**color_b cannot be empty";
        BColor.addEventListener("click", () => {
            setInterval(() => {
                document.getElementById("bcolor-alert").innerHTML = "";
            }, 2500);
        });
        return false;
    }
    if (isNaN(BColor.value)) {
        document.getElementById("bcolor-alert").innerHTML =
            "**color_b contains only numbers";
        BColor.addEventListener("click", () => {
            setInterval(() => {
                document.getElementById("bcolor-alert").innerHTML = "";
            }, 2500);
        });
        return false;
    }
    if (BColor.value < 0 && BColor.value > 255) {
        document.getElementById("bcolor-alert").innerHTML =
            "**should contain value from 0 to 255";
        BColor.addEventListener("click", () => {
            setInterval(() => {
                document.getElementById("bcolor-alert").innerHTML = "";
            }, 2500);
        });
        return false;
    }


    if (XCoordinate.value == "") {
        document.getElementById("xcoordinate-alert").innerHTML =
            "**Font size cannot be empty";
        XCoordinate.addEventListener("click", () => {
            setInterval(() => {
                document.getElementById("xcoordinate-alert").innerHTML = "";
            }, 2500);
        });
        return false;
    }
    if (isNaN(XCoordinate.value)) {
        document.getElementById("xcoordinate-alert").innerHTML =
            "**font size contains only numbers";
        XCoordinate.addEventListener("click", () => {
            setInterval(() => {
                document.getElementById("xcoordinate-alert").innerHTML = "";
            }, 2500);
        });
        return false;
    }

    if (YCoordinate.value == "") {
        document.getElementById("ycoordinate-alert").innerHTML =
            "**Font size cannot be empty";
        YCoordinate.addEventListener("click", () => {
            setInterval(() => {
                document.getElementById("ycoordinate-alert").innerHTML = "";
            }, 2500);
        });
        return false;
    }
    if (isNaN(YCoordinate.value)) {
        document.getElementById("ycoordinate-alert").innerHTML =
            "**font size contains only numbers";
        YCoordinate.addEventListener("click", () => {
            setInterval(() => {
                document.getElementById("ycoordinate-alert").innerHTML = "";
            }, 2500);
        });
        return false;
    }
};