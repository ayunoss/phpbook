$(document).ready (function () {
    $("#signupForm").on("submit", function (event) {
        event.preventDefault();
        $.ajax ({
            url: "/register",
            type: "POST",
            data: ({
                username: $("#login").val(),
                phonenumber: $("#phonenumsignup").val(),
                email: $("#emailsignup").val(),
                passwordsignup: $("#passwordsignup").val(),
                password_confirm: $("#passwordsignup_confirm").val(),
            }),
            dataType: "html",
            success: function (data) {
                data = JSON.parse(data);
                if (data.status === 'error') {
                    $.each(data.errors, function(key, value) {
                        var errorMessage = '<p class="error" style="color: red">' + value + '</p>';
                        if (key == "invalid_email") {
                            $(errorMessage).insertAfter(".emailError");
                        } if (key == "pwd_not_match") {
                            $(errorMessage).insertAfter(".pwdError");
                        }

                        setTimeout(function() { $('.error')[0].remove();}, 4000);
                    });
                } else if (data.status === 'success') {
                    window.location.href = "/login";
                }
            }
        })
    });
});