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
    order:[0,'desc']
    });

//Add Modal
$('.btnAddMenu').on('click', function(){
    $('.modal-body form').attr("method", "post");
    $('#menuModalLabel').html("Add Menu");
    $('#btnSubmit').html("Add to Menu");
    $('#nama').val('');
    $('#harga').val('');
    $('#menuModal').modal('show');
});

// Edit Modal
// ketika class btnEditModal yang ada di alam body di click
$('#dt').on('click', '.btnEditMenu', function(){
    $('.modal-body form').attr("method", "put");
    $('#menuModalLabel').html("Edit Menu");
    $('#btnSubmit').html("Save Changes");
    $('#menuModal').modal('show');

    //this di sini ialah
    //.data('id') berisi menu-> slug yang udeh di kirim dari menucontroller,
    //fetchingan dari data tables
    var menu_slug = $(this).data('id');
    console.log(menu_slug);
    $.get('/menus/index/'+menu_slug+'/edit', function(menu){
        $('#nama').val(menu.nama);
        $('#harga').val(menu.harga);
    })
});
