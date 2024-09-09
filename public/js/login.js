$(document).ready(function() {
    $("#login_form").submit(function(event) {
        event.preventDefault();

        var form = $(this)[0];
        var formData = new FormData(form);

        $.ajax({
            url: "http://localhost:8000/api/auth/login",
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function(data) {
                $(".error").html('');
                $(".result").html('');

                if ('access_token' in data) {
                    localStorage.setItem("user_token", "Bearer " + data.access_token);
                    window.open("/data", "_self");
                } else if ('errors' in data) {
                    
                    printErrorMsg(data.errors);
                } else {
                    $(".result").html(data.error || 'An unknown error occurred.');
                }
            },
            error: function(xhr) {
                if (xhr.responseJSON && xhr.responseJSON.errors) {
                    printErrorMsg(xhr.responseJSON.errors);
                } else {
                    $(".error").html('');
                    $(".result").html(
                    "Email or Password doesn't match");
                }
            }
        });
    });

    function printErrorMsg(errors) {
        $(".error").html('');
        $.each(errors, function(key, value) {
            $("." + key + "_err").html(value);
        });
    }
});