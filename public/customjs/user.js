$(document).ready(function() {

    $('.select2').select2()

    $('#product_image').change(function() {
        var file = this.files[0];
        var reader = new FileReader();
        reader.onload = function(e) {
            $('#previewImage').attr('src', e.target.result);
            $('#imagePreview').css('display', 'block');
            $('#imagePreviewAlreadyExist').hide();
        };
        reader.readAsDataURL(file);
    });

    $('#phone_number').on('input', function() {
        var maxLength = 10;
        var currentValue = $(this).val();
        var numericValue = currentValue.replace(/[^0-9]/g, '');
        if (numericValue.length > maxLength) {
            numericValue = numericValue.slice(0, maxLength);
        }
        
        $(this).val(numericValue);
    });
    

    
    $('#user_form').submit(function(event) {
        event.preventDefault();
        var url = $(this).data('url');
        var formData = new FormData($(this)[0]);
        var userId = $('#user_id').val();
        if (userId) {
            url = BASE_URL + '/update-user/' + userId;
            formData.append('_method', 'PUT');
        }

        $.ajax({
            url: url,
            type: 'POST',
            data: formData,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                console.log(response);
                if (response.status === 200 || response.status === 201) {
                    showSwal('success', 'Success!', response.message, 'OK', function() {
                        location.reload();
                    });
                } else {
                    showSwal('error', 'Error!', 'An unexpected error occurred. Please try again later.', 'OK');
                }
            },
            error: function(xhr, status, error) {
                if (xhr.status === 500) {
                    showSwal('error', 'Error!', xhr.statusText, 'OK', function() {
                        location.reload();
                    });
                } else{
                    $('.text-red-500').remove();
                    var errors = xhr.responseJSON.errors;
                    $.each(errors, function(field, messages) {
                        if (field == 'product_image') {
                            $('#product_image').closest('.form-group').append('<span class="text-red-500 text-danger">' + messages[0] + '</span>');
                        } else {
                            $.each(messages, function(index, message) {
                                $('#' + field).closest('.form-group').append('<span class="text-red-500 text-danger">' + message + '</span>');
                            });
                        }
                    });
                }
                
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
});




