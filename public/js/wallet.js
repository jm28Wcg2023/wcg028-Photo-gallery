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
        ajax: "/user/wallets",
        columns: [
            {data:'id',name: 'id','orderable': false},
            {data: 'description', name: 'description','orderable': false},
            {data: 'transaction_type', name: 'transaction_type','orderable': false},
            {data: 'transaction_amount', name: 'transaction_amount','orderable': false},
            {data:'created_at',name: 'created_at','orderable': true},

        ],
    });
});
