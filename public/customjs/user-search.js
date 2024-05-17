$(document).ready(function() {
    initialPageLoad();

    $('#search_form').on('submit', function(e) {
        e.preventDefault();
        initialPageLoad($('#search').val());
    });
});

function initialPageLoad(search = '') {
    $.ajax({
        url: BASE_URL +'/user-cards',
        method: 'GET',
        data: { search: search },
        success: function(response) {
            $('#department-content').empty();

            if (response.length > 0) {
                $.each(response, function(index, user) {
                    console.log(user);
                    $('#department-content').append(
                        '<div class="col-lg-4 col-md-4 col-sm-4 mb-3">' +
                            '<div class="card card-primary">' +
                                '<div class="card-header">' +
                                    '<h3 class="card-title">' + user.name + '</h3>' +
                                '</div>' +
                                '<div class="card-body">' +
                                    '<p><strong>Department:</strong> ' + user.department.name + '</p>' +
                                    '<p><strong>Designation:</strong> ' + user.designation.name + '</p>' +
                                    '<p><strong>Phone Number:</strong> ' + user.phone_number + '</p>' +
                                '</div>' +
                            '</div>' +
                        '</div>'
                    );
                });
            }
             else {
                $('#department-content').append('<p>No departments found.</p>');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error fetching departments:', error);
            $('#department-content').append('<p>An error occurred while fetching departments.</p>');
        }
    });
}
