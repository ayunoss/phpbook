$(document).ready (function () {
    $("#form").on("submit", function (event) {
        let url = location.href;
        event.preventDefault();
        $.ajax ({
            url: url,
            type: "POST",
            data: ({
                newpwd: $("#newpwd").val(),
                newpwd_confirm: $("#newpwd_confirm").val(),
            }),
            dataType: "html",
            success: function (data) {
                data = JSON.parse(data);
                if (data.status === 'error') {
                    $.each(data.errors, function(key, value) {
                        var errorMessage = '<p class="error" style="color: red">' + value + '</p>';
                        if (key == "invalid_pwd") {
                            $(errorMessage).insertAfter(".error");
                        }
                        setTimeout(function() { $('.error')[0].remove();}, 4000);
                    });
                } else if (data.status === 'success') {
                    window.location.href = "/login";
                    alert("Please try to sign in with new password.");
                }
            }
        })
    });
});