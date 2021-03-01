@extends('layouts.backend')
@section('moreCustomStyle')
{{-- <link rel="stylesheet" href="{{ asset('css/menu/style.css') }}"> --}}
@endsection
@section('content')
<div class="container-fluid py-4">

    <!-- Header -->
    <div class="row">
        <div class="col-md-12 col-lg-12">
            <div class="d-flex bd-highlight">
                <h4 class="flex-grow-1 bd-highlight">Daftar Barang</h4>
                <a href="javascript:void(0)" class="btn btn-primary btnAddMenu">
                    <i class="mdi mdi-plus"></i>
                </a>
            </div>
            <hr>
        </div>
    </div>

    <!-- Card DataTables -->
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="card b-radius card-noborder">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">

                            @if(session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                            @endif

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


    <!-- Menu Modal -->
    <div class="modal fade" id="menuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="menuModalLabel"></h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{-- <form action="{{ route('menus.menu') }}" method="post"> --}}
                    <form id="menuModalForm">
                        {{-- @csrf --}}

                        <input type="hidden" name="id" id="id">

                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" name="nama" id="nama" class="form-control">
                            {{-- @error('nama')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror --}}
                        </div>

                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="text" name="harga" id="harga" class="form-control">
                            {{-- @error('harga')
                            <span class="invalid-feedback">{{ $message }}</span>
                            @enderror --}}
                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary" id="btnSubmit"></button>
                </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Delete Modal -->
    <div class="modal fade" id="deleteMenuModal" tabindex="-1" aria-labelledby="menuModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <form id="menuModalForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="menuModalDeleteLabel">

                        </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Are you sure you want to delete this item ?
                        <input type="hidden" name="id" id="deleteMenuId">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger" id="btnDelete">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
@endsection
@push('moreCustomJs')
@once
<script src="{{ asset('js/menu/script.js') }}"></script>
@endonce
@endpush
