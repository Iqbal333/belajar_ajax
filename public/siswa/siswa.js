function ajaxData() {
    $.ajax({
        url: '/user',
        type: 'GET',
        dataType: 'JSON',
        beforeSend : function() {
            $('#t_user tbody').html(`
                <tr>
                    <td colspan="4" class="text-center">
                        <h4>Loading... Please Wait</h4>
                    </td>
                </tr>
            `)
        },

        success: function(res) {
            if(res.results.length === 0) {
                $('#t_user tbody').html(`
                    <tr>
                        <td colspan="3" class="text-center">
                        <h>Data Not Found!</h></td>
                    </tr>
                `)
            } else {
                // console.log(res.message);
                let rowData = res.results.map(v => {
                    return `
                        <tr>
                            <td>${v.id}</td>
                            <td>${v.name}</td>
                            <td>${v.phone_number}</td>
                            <td>${v.email}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-success btn-edit" data-id="${v.id}">Edit</button>
                                    <button type="button" class="btn btn-danger btn-delete" data-id="${v.id}">Delete</button>
                                </div>
                            </td>
                        </tr>
                    `
                }).join('')

                $('#t_user tbody').html(rowData)

                $('#t_user tfoot').html(`
                    <tr>
                        <td colspan="5" class="text-right">
                            <b>Total Data : ${res.results.length}</b>
                        </td>
                    </tr>
                `)
            }
        },
        error : function(err) {
            $('#t_user tbody').html(`
                <tr>
                    <td colspan="5" class="text-center>
                        <h4 class="text-danger">Internal Server Error</h4>
                    </td>
                </tr>
            `)
        },
        complete: function() {

        }
    })
    
}

toastr.options = {
    "closeButton": false,
    "debug": false,
    "newestOnTop": false,
    "progressBar": true,
    "positionClass": "toast-bottom-right",
    "preventDuplicates": false,
    "onclick": null,
    "showDuration": "300",
    "hideDuration": "1000",
    "timeOut": "5000",
    "extendedTimeOut": "1000",
    "showEasing": "swing",
    "hideEasing": "linear",
    "showMethod": "fadeIn",
    "hideMethod": "fadeOut"
}

function ajaxDetail(id, button, action) {
    $.ajax({
        url: `user/${id}`,
        type: 'GET',
        dataType: 'JSON',
        beforeSend: function() {
            button.html('Loading..').prop('disabled', true)
        },
        success: function(res){
            if(action === 'edit') {
                $('#edit_name').val(res.result.name)
                $('#edit_phone_number').val(res.result.phone_number)
                $('#edit_email').val(res.result.email)

                $('#modal_edit').modal('show')
            }

            if(action === 'delete') {
                $('#delete_id').val(res.result.id)
                $('#modal_delete').modal('show')
            }
        },
        error: function(err){
            toastr.error(err.responseJSON.exception, 'Failed')
        },
        complete: function(){
            if(action === 'edit') {
                button.html('Edit').prop('disabled', false)
            }

            if(action === 'delete') {
                button.html('Delete').prop('disabled', false)
            }
        }
    })
}

$(function() {

    ajaxData()

    $('#btn_reload').on('click', function() {
       ajaxData();
    });

    $('#btn_add').on('click', function() {
        $('#form_add')[0].reset()
        $('#modal_add').modal('show')
    });

    $('#form_add').validate({
        submitHandler: function(form) {
            $.ajax({
                url: '/user/store',
                type: 'POST',
                data: $(form).serialize(),
                beforeSend: function() {
                    $('#btn_save').prop('disabled', true).html('Loading...')
                },

                success: function(res) {
                    ajaxData()
                    // alert(res.message)
                    toastr.success(res.message, 'Success')
                    $('#modal_add').modal('hide')
                },
                error: function(err) {
                    toastr.success(res.message, 'Failed')
                    // alert(err.responseJSON.message)
                },
                complete: function() {
                    $('#btn_save').prop('disabled', false).html('Save')
                }
            })
        }
    })

    $('#t_user').on('click', '.btn-edit', function() {
        let id = $(this).data('id')

        let button = $(this)

        $.ajax({
            url: `user/${id}`,
            type: 'GET',
            dataType: 'JSON',
            beforeSend: function() {
                button.html('Loading...').prop('disabled', true)
            },
            success: function(res){
                $('#edit_name').val(res.result.name)
                $('#edit_phone_number').val(res.result.phone_number)
                $('#edit_email').val(res.result.email)
                $('#edit_id').val(res.result.id)

                $('#modal_edit').modal('show');
            },
            error: function(err){
                toastr.error(err.responseJSON.message, 'Failed')
            },
            complete: function(){
                button.html('Edit').prop('disabled', false)
            }
        })
    })

    $('#form_edit').validate({
        submitHandler: function(form) {
            let id = $('#edit_id').val()
            $.ajax({
                url: `/user/update/${id}`,
                type: 'POST',
                data: $(form).serialize(),
                beforeSend: function() {
                    $('#btn_update').prop('disabled', true).html('Loading...')
                },

                success: function(res) {
                    ajaxData()
                    // alert(res.message)
                    toastr.success(res.message, 'Success')
                    $('#modal_edit').modal('hide')
                },
                error: function(err) {
                    toastr.success(res.message, 'Failed')
                    // alert(err.responseJSON.message)
                },
                complete: function() {
                    $('#btn_update').prop('disabled', false).html('Update')
                }
            })
        }
    })

    $('#form_delete').validate({
        submitHandler: function(form) {
            let id = $('#delete_id').val()
            $.ajax({
                url: `/user/delete/${id}`,
                type: 'POST',
                data: $(form).serialize(),
                beforeSend: function() {
                    $('#btn_delete').prop('disabled', true).html('Loading...')
                },

                success: function(res) {
                    ajaxData()
                    // alert(res.message)
                    toastr.success(res.message, 'Success')
                    $('#modal_delete').modal('hide')
                },
                error: function(err) {
                    toastr.success(res.message, 'Failed')
                    // alert(err.responseJSON.message)
                },
                complete: function() {
                    $('#btn_delete').prop('disabled', false).html('Ya')
                }
            })
        }
    })

    $('#t_user').on('click', '.btn-delete', function() {
        let id = $(this).data('id')
        let button = $(this)

        ajaxDetail(id, button, 'delete')
    })

});