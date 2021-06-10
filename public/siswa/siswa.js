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
});