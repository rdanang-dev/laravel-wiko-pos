@extends('layouts.backend')
@section('moreCustomStyle')
{{-- <link rel="stylesheet" href="{{ asset('css/menu/style.css') }}"> --}}
@endsection
@section('content')
<div class="container-fluid py-4">

    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="d-flex bd-highlight">
                <h4 class="flex-grow-1 bd-highlight">Daftar Barang</h4>
                <a href="#" class="btn btn-primary" data-toggle="modal" data-target="#addMenuModal">
                    <i class="mdi mdi-plus"></i>
                </a>
            </div>
            <hr>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card b-radius card-noborder">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <table id="dt" class="table table-striped table-bordered table-sm">
                                <thead>
                                    <tr>
                                        <th scope="col-1">No</th>
                                        <th scope="col-7">Nama</th>
                                        <th scope="col-2">Harga</th>
                                        <th scope="col-1">Created At</th>
                                        <th scope="col-1">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
</div>


<!-- Add Modal -->
<div class="modal fade" id="addMenuModal" data-backdrop="static" data-keyboard="false" tabindex="-1"
    aria-labelledby="addMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addMenuModalLabel">Add Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table class="table table-striped table-bordered table-sm">

                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Add to Menu</button>
            </div>
        </div>
    </div>
</div>

@endsection
@push('moreCustomJs')
@once
<script src="{{ asset('js/menu/dataTablesConf.js') }}"></script>
{{-- <script>
    $('#dt').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: "{{ route('menus.datatable') }}",
type: 'GET'
},
columns: [
{data:'nama',name:'nama'},
{data:'harga',name:'harga'},
],
order:[0,'asc']
});
</script> --}}
@endonce
@endpush
