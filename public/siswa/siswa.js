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
                            <td>${v.name}</td>
                            <td>${v.phone_number}</td>
                            <td>${v.email}</td>
                            <td>${v.id}</td>
                        </tr>
                    `
                }).join('')

                $('#t_user tbody').html(rowData)

                $('#t_user tfoot').html(`
                    <tr>
                        <td colspan="3" class="text-right">
                            <b>Total Data : ${res.results.length}</b>
                        </td>
                    </tr>
                `)
            }
        },
        error : function(err) {
            $('#t_user tbody').html(`
                <tr>
                    <td colspan="3" class="text-center>
                        <h4 class="text-danger">Internal Server Error</h4>
                    </td>
                </tr>
            `)
        },
        complete: function() {

        }
    })
}

$(function() {

    ajaxData();

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
                    $('#modal_add').modal('hide')
                },
                error: function(err) {
                    alert(err.responseJSON.message)
                },
                complete: function() {
                    $('#btn_save').prop('disabled', false).html('Save')
                }
            })
        }
    })

});