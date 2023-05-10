$(function () {
    var table = $('.wallet-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "/user/wallets",
        columns: [
            {data:'id',name: 'id',"orderable": false},
            {data: 'description', name: 'description'},
            {data: 'transaction_type', name: 'transaction_type'},
            {data: 'transaction_amount', name: 'transaction_amount', },
        ]
    });
});
