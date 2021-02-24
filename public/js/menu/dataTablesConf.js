$('#dt').DataTable({
    processing: true,
    serverSide: true,
    scrollY: '43vh',
    scrollCollapse: true,
    paging: true,
    ajax: {
        url: "/menus/datatable",
        type: 'GET'
    },
    columns: [
        { data: 'DT_RowIndex', 'orderable': false, 'searchable': false },
        {data:'nama',name:'nama'},
        {data:'harga',name:'harga'},
        {data:'created_at',name:'created_at'},
        {data:'action',name:'action'},
    ],
    order:[0,'asc']
    });
