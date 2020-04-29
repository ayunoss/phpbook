$(document).ready (function () {
    $("#button").on("click", function (event) {
        event.preventDefault();
        let url = location.href;
        $.ajax ({
            url: url,
            type: "POST",
            data: ({
                name: $("#name").val(),
                phonenumber: $("#phonenumber").val(),
                email: $("#email").val(),
                feedback: $("#feedback").val(),
            }),
            dataType: "html",
            success: function (data) {
                data = JSON.parse(data);
                if (data.status === 'error') {
                    $.each(data.errors, function(key, value) {
                        var errorMessage = '<p class="error" style="color: red">' + value + '</p>';
                        if (key == "invalid_email") {
                            $(errorMessage).insertAfter(".emailError");
                        }
                        setTimeout(function() { $('.error')[0].remove();}, 4000);
                    });
                } else if (data.status === 'success') {
                    alert("Thank you for your message. We will reply to it as soon as it possible.");
                    window.location.href = "/";
                }
            }
        })
    });
});