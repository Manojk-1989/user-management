$(document).ready(function() {
    let currentPage = 1;
    let isLoading = false;

    initialPageLoad();

    $('#search_form').on('submit', function(e) {
        e.preventDefault();
        currentPage = 1;
        initialPageLoad($('#search').val(), true);
    });

    $(window).on('scroll', function() {
        if ($(window).scrollTop() + $(window).height() >= $(document).height() - 100) {
            if (!isLoading) {
                isLoading = true;
                currentPage++;
                initialPageLoad($('#search').val());
            }
        }
    });

    function initialPageLoad(search = '', reset = false) {
        if (reset) {
            $('#department-content').empty();
        }

        $.ajax({
            url: BASE_URL + '/user-cards',
            method: 'GET',
            data: { search: search, page: currentPage },
            success: function(response) {
                isLoading = false;
                if (response.data.length > 0) {
                    $.each(response.data, function(index, user) {
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
                } else {
                    if (reset) {
                        $('#department-content').append('<p>No departments found.</p>');
                    }
                }
            },
            error: function(xhr, status, error) {
                isLoading = false;
                console.error('Error fetching departments:', error);
                $('#department-content').append('<p>An error occurred while fetching departments.</p>');
            }
        });
    }
});
