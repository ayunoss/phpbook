$(document).ready (function () {
    $("#form").on("submit", function (event) {
        event.preventDefault();
        $.ajax ({
            url: "/password-recovery",
            type: "POST",
            data: ({
                email: $("#email").val(),
            }),
            dataType: "html",
            success: function (data) {
                data = JSON.parse(data);
                if (data.status === 'error') {
                    $.each(data.errors, function(key, value) {
                        var errorMessage = '<p class="error" style="color: red">' + value + '</p>';
                        if (key == "invalid_email") {
                            $(errorMessage).insertAfter(".error");
                        }
                        setTimeout(function() { $('.error')[0].remove();}, 4000);
                    });
                } else if (data.status === 'success') {
                    window.location.href = "/login";
                    alert("Please check your email and follow the instructions below to confirm your registration.");
                }
            }
        })
    });
});