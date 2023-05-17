$(function () {
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    var table = $('.wallet-table').DataTable({
        processing: true,
        serverSide: true,
        serverMethod: 'post',
        order: [[ 4, "desc" ]],
        // ajax: "/user/wallets",
        ajax: {
            url: "/user/wallets",
            data: function (d) {
                d.approved = $('#approved').val()
                // d.search = $('input[type="search"]').val()
            }
        },
        dom: 'Blfrtip',
              buttons: [
                   {
                       extend: 'pdf',
                       exportOptions: {
                           columns: [0,1,2,3,4] // Column index which needs to export
                       }
                   },
                   {
                       extend: 'csv',
                       exportOptions: {
                           columns: [0,1,2,3,4] // Column index which needs to export
                       }
                   },
                   {
                       extend: 'excel',
                   }
              ],
        columns: [
            {data:'id',name: 'id','orderable': false},
            {data: 'description', name: 'description','orderable': false},
            {data: 'transaction_type', name: 'transaction_type','orderable': false},
            {data: 'transaction_amount', name: 'transaction_amount','orderable': false},
            {data:'created_at',name: 'created_at','orderable': true},

        ],
    });
    $('#approved').change(function(){
        table.draw();
    });
});
