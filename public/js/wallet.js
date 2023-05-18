$(function () {
    var selectedType = '';
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
                d.approved = selectedType; // Modify this line
            }
        },
        dom: 'Blfrtip',
              buttons: [
                   {
                       extend: 'pdf',
                       exportOptions: {
                           columns: [0,1,2,3,4] // Column index which needs to export
                       },
                       filename: function(){
                            var d = new Date();
                            var n = d.getTime();
                            return 'myPdfFile' + n;
                        },
                   },
                   {
                       extend: 'csv',
                       exportOptions: {
                           columns: [0,1,2,3,4] // Column index which needs to export
                       },
                       filename: function(){
                            var d = new Date();
                            var n = d.getTime();
                            return 'myCsvFile' + n;
                        },
                   },
                   {
                       extend: 'excel',
                       filename: function(){
                            var d = new Date();
                            var n = d.getTime();
                            return 'myExcelFile' + n;
                        },
                   }
              ],
        columns: [
            {data:'id',name: 'id','orderable': false},
            {data: 'description', name: 'description','orderable': false},
            {
                data: 'transaction_type',
                name: 'transaction_type',
                'orderable': false,
                render: function(data, type, row) {
                    var badgeClass = (data === 'credit') ? 'badge bg-success' : 'badge bg-danger';
                    return '<span class="' + badgeClass + '">' + data + '</span>';
                }
            },
            {data: 'transaction_amount', name: 'transaction_amount','orderable': false},
            {data:'created_at',name: 'created_at','orderable': true},

        ],
    });
    $('#approved').change(function(){
        selectedType = $(this).val(); // Add this line
        table.draw();
    });
});

