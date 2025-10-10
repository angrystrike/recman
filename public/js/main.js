'use strict';

(function ($) {

  $.ajax({
    url: '/isLogged',
    type: 'GET',
    success: function (response) {
      if (response === 'true') {
        register_form.addClass("hidden")
        more_info_form.removeClass("hidden")
      }
    }
  })

  $('#birth_date').datepicker({
    maxDate: '0',
    dateFormat: 'yy-mm-dd',
    yearRange: '-100:+0',
    changeMonth: true,
    changeYear: true
  })

  $('#phone').inputmask('+9 (999) 999-9999')

  let register_form = $('#register_form')
  let more_info_form = $('#more_info_form')
  let social = $('#social')
  let errors = $('#errors')

  $(document).on('click', '#to_more_info_form', function () {
    let form_data = register_form.serialize()

    $.ajax({
      url: '/members/create',
      type: 'POST',
      dataType: 'json',
      data: {
        'form_data': form_data
      },

      statusCode: {
        200: function () {
          register_form.addClass("hidden")
          errors.addClass("hidden")
          more_info_form.removeClass("hidden")
        },
        422: function (response) {
          errors.removeClass("hidden")
          errors.empty()

          let data = JSON.parse(response.responseText)
          data.forEach(function (item) {
            showErrorMessage('#errors', item)
          })
        }
      }
    })
  })

  function showErrorMessage (selector, text) {
    $(selector).prepend('<strong class="text-danger">' + text + '</strong><br>')
  }

  $(document).on('click', '#back-to-register-form', function () {
    $.ajax({
      url: '/currentMember',
      type: 'GET',
      dataType: 'json',

      success: function (response) {
        for (let key in response) {
          if (response.hasOwnProperty(key)) {
            if (response[key] != null) {
              if (key === 'country') {
                $('#country').val(response[key]).change()
              } else if (key === 'phone_number') {
                $('#phone_number').inputmask('setvalue', response[key])
              }
              else {
                $('#' + key).attr('value', response[key])
              }
            }
          }
        }
      }
    })

    more_info_form.addClass("hidden")
    register_form.removeClass("hidden")
  })

  let maxFileSize = 2000 * 1024
  $('#photo').on('change', function () {
    if (this.files[0].size > maxFileSize) {
      errors.removeClass("hidden")
      errors.empty()
      showErrorMessage('#errors', 'Image file size cannot be more than 2 MB')
      $('#photo').replaceWith('<input type="file" accept="image/*" class="form-control-file" name="photo" id="photo">')
    }
  })

  more_info_form.submit(function (e) {
    e.preventDefault()
    let formData = new FormData(this)

    $.ajax({
      url: '/members/update',
      type: 'POST',
      data: formData,

      statusCode: {
        200: function () {
          $('#form_header').addClass("hidden")
          more_info_form.addClass("hidden")
          errors.addClass("hidden")
          social.removeClass("hidden");
        },
        422: function (response) {
          errors.removeClass("hidden");
          errors.empty()
          let data = JSON.parse(response.responseText)
          data.forEach(function (item) {
            showErrorMessage('#errors', item)
          })
        }
      },
      cache: false,
      contentType: false,
      processData: false
    })
  })

})(jQuery)