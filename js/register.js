$(document).ready(function () {
    $("#submitBtn").on("click", function () {
        // Check if passwords match
        var password = $("#password").val();
        var confirmPassword = $("#confirmPassword").val();

        if (password !== confirmPassword) {
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: 'Passwords do not match. Please try again.'
            });
            return;
        }

        // Serialize the form data
        var formData = $("#signupForm").serialize();

        // Perform AJAX request
        $.ajax({
            type: "POST",
            url: "php/register.php",
            data: formData,
            success: function (response) {
                if (response.status === "success") {
                    // Clear form inputs
                    $("#signupForm").trigger("reset");
                    // Display success message
                    Swal.fire({
                        icon: 'success',
                        title: 'Success!',
                        text: 'User registered successfully!'
                    });
                } else {
                    // Display error message
                    Swal.fire({
                        icon: 'error',
                        title: 'Registration failed',
                        text: response.message
                    });
                }
            },
            error: function (error) {
                console.log(error);
                Swal.fire({
                    icon: 'error',
                    title: 'Error',
                    text: 'An error occurred. Please try again.'
                });
            }
        });
    });
});
