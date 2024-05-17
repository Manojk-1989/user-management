$(document).ready(function() {

    initialPagelLoad();
});

$(document).on('click', '.delete-product', function() {
    var deleteUrl = $(this).data('url');
    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            $.ajax({
                url: deleteUrl,
                type: 'DELETE',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(response) {
                    Swal.fire(
                        'Deleted!',
                        response.message,
                        'success'
                    ).then(function() {
                        location.reload();
                    });
                },
                error: function(xhr) {
                    var errorMessage = xhr.responseJSON && xhr.responseJSON.message ? xhr.responseJSON.message : 'An error occurred while deleting the company.';
                    Swal.fire(
                        'Error!',
                        errorMessage,
                        'error'
                    );
                }
                
            });
        }
    });
});


function initialPagelLoad() {
    var table = $('#user-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: BASE_URL +'/user-lists',
        autoWidth: true, // Disable autoWidth to allow custom column widths
        columns: [
            { data: 'id'},
            { data: 'name'},
            { data: 'department_name'},
            { data: 'designation_name'},
            
            { data: 'created_at'},
            { data: 'updated_at'},
            { 
                data: null,
                render: function(data, type, full, meta) {
                    return '<div class="btn-group" role="group" >' +
                               '<a href="' + BASE_URL + '/view-user/' + full.encriptedId + '" class="btn btn-success btn-sm edit-btn">View</a>' +
                           '</div>';
                }
            },
            { 
                data: null,
                render: function(data, type, full, meta) {
                    return '<div class="btn-group" role="group" >' +
                               '<a href="' + BASE_URL + '/user/' + full.encriptedId + '/edit" class="btn btn-primary btn-sm edit-btn">Edit</a>' +
                               '<button class="btn btn-danger btn-sm delete-btn delete-user" data-url="' + BASE_URL + '/delete-user/' + full.encriptedId + '">Delete</button>' +
                           '</div>';
                }
            }
            
        ]
    });
}