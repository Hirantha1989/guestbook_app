$(function () {
    // Initialize form validation on the registration form.
    $("form[name='comments']").validate({
        // Specify validation rules
        rules: {
            name: {
                required: true,
                minlength: 3
            },
            email: {
                required: true,
                // Built-in "email" rule is used
                email: true
            },
            message: {
                required: true,
                minlength: 5
            }
        },
        // Specify validation error messages
        messages: {
            name: {
                required: "Please enter your name",
                minlength: "Your name must be at least 3 characters long"
            },
            email: "Please enter a valid email address",
            message: {
                required: "Please provide a message",
                minlength: "Your message must be at least 5 characters long"
            }
        },

        // Submit the form when all the attributes are valid
        submitHandler: function (form) {
            form.submit();
        }
    });

});

window.fbAsyncInit = function () {
    FB.init({
        appId: '133275537381356',
        autoLogAppEvents: true,
        xfbml: true,
        version: 'v8.0'
    });
};

function shareOnFb(postId) {
    let base_url = $('#baseUrl').val();
    let name = $('#btn_' + postId).attr('data-name');
    let message = $('#btn_' + postId).attr('data-message');
    console.log(base_url);
    FB.ui({
        method: 'feed',
        link: 'http://127.0.0.1:8000',
        picture: '',
        name: 'Guest Book App',
        caption: name,
        description: message
    }, function (response) {
    });
}

window.setInterval(function () {
    let base_url = $('#baseUrl').val();
    let url = base_url + '/comments/getComments';
    $.ajax({

        'url': url,
        'type': 'GET',
        'data': {},
        'success': function (data) {
            $('.articles-container').html(data.data);

        },
        'error': function (request, error) {
        }
    });
}, 60000);

