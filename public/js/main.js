'use strict';

(function ($) {

    $('#phone').inputmask('+9 (999) 999-9999')

    const errors = $('#errors')

    $(document).on('click', '#register', function () {
        let form_data = $('#register_form').serialize()

        $.ajax({
            url: '/members/create',
            type: 'POST',
            dataType: 'json',
            data: {
                'form_data': form_data
            },
            statusCode: {
                200: function () {
                    errors.addClass('hidden')
                    window.location.href = '/login'
                },
                422: function (response) {
                    errors.removeClass('hidden')
                    errors.empty()

                    let data = JSON.parse(response.responseText)
                    data.forEach(function (item) {
                        showErrorMessage('#errors', item)
                    })
                }
            }
        })
    })

    $(document).on('click', '#login', function () {
        $.ajax({
            url: '/members/login',
            type: 'POST',
            dataType: 'json',
            data: {
                'form_data': $('#login_form').serialize()
            },
            statusCode: {
                200: function () {
                    errors.addClass('hidden')
                    alert('Login success!')
                },
                401: function (response) {
                    errors.removeClass('hidden')
                    errors.empty()

                    let data = JSON.parse(response.responseText)
                    data.forEach(function (item) {
                        showErrorMessage('#errors', item)
                    })
                }
            }
        })
    });

    function showErrorMessage (selector, text) {
        $(selector).prepend('<strong class="text-danger">' + text + '</strong><br>')
    }

})(jQuery)