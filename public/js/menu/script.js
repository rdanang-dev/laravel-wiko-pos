// const { default: iziToast } = require("izitoast");
// const iziToastMin = require("izitoast/dist/js/iziToast.min");

// $(function () {
$.ajaxSetup({
    headers: {
        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
    },
});
// });

$("#dt").DataTable({
    processing: true,
    serverSide: true,
    scrollY: "43vh",
    scrollCollapse: true,
    paging: true,
    ajax: {
        url: "/menus/index",
        type: "GET",
    },
    columns: [
        {
            data: "DT_RowIndex",
            name: "DT_RowIndex",
            orderable: false,
            searchable: false,
        },
        { data: "nama", name: "nama" },
        { data: "harga", name: "harga" },
        { data: "created_at", name: "created_at" },
        { data: "action", name: "action" },
    ],
    order: [0, "asc"],
});

//Add Modal
$(".btnAddMenu").on("click", function () {
    $("#menuModalLabel").html("Add Menu");
    $("#btnSubmit").html("Add to Menu");
    $("#id").val("");
    $("#nama").val("");
    $("#harga").val("");
    $("#menuModal").modal("show");
});

// Edit Modal
// ketika class btnEditModal yang ada di alam body di click
$("#dt").on("click", ".btnEditMenu", function () {
    $("#menuModalLabel").html("Edit Menu");
    $("#btnSubmit").html("Save Changes");
    $("#menuModal").modal("show");

    //this di sini
    //.data('id') berisi menu-> slug yang udeh di kirim dari menucontroller,
    //fetchingan dari data tables
    var dataid = $(this).data("id");
    // console.log(menu_slug);
    $.get("/menus/index/" + dataid + "/edit", function (menu) {
        $("#id").val(menu.id);
        $("#nama").val(menu.nama);
        $("#harga").val(menu.harga);
    });
});

$("#btnSubmit").on("click", function (e) {
    e.preventDefault();
    $.ajax({
        data: $(".modal-body form").serialize(),
        url: "/menus/index",
        type: "post",
        method: "post",
        dataType: "json",
        success: function (data) {
            $(".modal-body form").trigger("reset");
            $("#menuModal").modal("hide");
            // $("#dt").DataTable().draw();
            $("#dt").DataTable().ajax.url("/menus/index").load();

            iziToast.success({
                title: "Data Saved",
                message: "Data Saved Successfully",
                position: "bottomRight",
            });
        },
        error: function (data) {
            console.log("Error", data);
            iziToast.error({
                title: "Data not Saved",
                message: "Error",
                position: "bottomRight",
            });
        },
    });
});
