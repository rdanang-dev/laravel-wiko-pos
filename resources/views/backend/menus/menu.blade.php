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
                <div class="dropdown">
                    <button class="btn btn-icons btn-inverse-primary btn-filter shadow-sm" type="button"
                        id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-filter-variant"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                        <h6 class="dropdown-header">Urut Berdasarkan :</h6>
                        <div class="dropdown-divider"></div>
                        <a href="#" class="dropdown-item" data-filter="kode_barang">Kode Barang</a>
                        <a href="#" class="dropdown-item" data-filter="jenis_barang">Jenis Barang</a>
                        <a href="#" class="dropdown-item filter-btn" data-filter="nama_barang">Nama Barang</a>
                        <a href="#" class="dropdown-item filter-btn" data-filter="berat_barang">Berat Barang</a>
                        <a href="#" class="dropdown-item filter-btn" data-filter="merek">Merek Barang</a>
                        <a href="#" class="dropdown-item filter-btn" data-filter="stok">Stok Barang</a>
                        <a href="#" class="dropdown-item filter-btn" data-filter="harga">Harga Barang</a>
                    </div>
                </div>
                <div class="dropdown dropdown-search">
                    <button class="btn btn-icons btn-inverse-primary btn-filter shadow-sm ml-2" type="button"
                        id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="mdi mdi-magnify"></i>
                    </button>
                    <div class="dropdown-menu search-dropdown" aria-labelledby="dropdownMenuIconButton1">
                        <div class="row">
                            <div class="">
                                <input type="text" class="form-control" name="search" placeholder="Cari barang">
                            </div>
                        </div>
                    </div>
                </div>
                <a href="{{ url('/product/new') }}" class="btn btn-icons btn-inverse-primary btn-new ml-2">
                    <i class="mdi mdi-plus"></i>
                </a>
            </div>
            <hr>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <table class="table table-hover table-dark">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">First</th>
                        <th scope="col">Last</th>
                        <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td colspan="2">Larry the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('plugins/js/quagga.min.js') }}"></script>
<script src="{{ asset('js/manage_product/product/script.js') }}"></script>
<script type="text/javascript">
    @if ($message = Session::get('create_success'))
      swal(
          "Berhasil!",
          "{{ $message }}",
          "success"
      );
    @endif

    @if ($message = Session::get('update_success'))
      swal(
          "Berhasil!",
          "{{ $message }}",
          "success"
      );
    @endif

    @if ($message = Session::get('delete_success'))
      swal(
          "Berhasil!",
          "{{ $message }}",
          "success"
      );
    @endif

    @if ($message = Session::get('import_success'))
      swal(
          "Berhasil!",
          "{{ $message }}",
          "success"
      );
    @endif

    @if ($message = Session::get('update_failed'))
      swal(
          "",
          "{{ $message }}",
          "error"
      );
    @endif

    @if ($message = Session::get('supply_system_status'))
      swal(
          "",
          "{{ $message }}",
          "success"
      );
    @endif

    $(document).on('click', '.filter-btn', function(e){
      e.preventDefault();
      var data_filter = $(this).attr('data-filter');
      $.ajax({
        method: "GET",
        url: "{{ url('/product/filter') }}/" + data_filter,
        success:function(data)
        {
          $('tbody').html(data);
        }
      });
    });

    $(document).on('click', '.btn-edit', function(){
      var data_edit = $(this).attr('data-edit');
      $.ajax({
        method: "GET",
        url: "{{ url('/product/edit') }}/" + data_edit,
        success:function(response)
        {
          $('input[name=id]').val(response.product.id);
          $('input[name=kode_barang]').val(response.product.kode_barang);
          $('input[name=nama_barang]').val(response.product.nama_barang);
          $('input[name=merek]').val(response.product.merek);
          $('input[name=stok]').val(response.product.stok);
          $('input[name=harga]').val(response.product.harga);
          var berat_barang = response.product.berat_barang.split(" ");
          $('input[name=berat_barang]').val(berat_barang[0]);
          $('select[name=jenis_barang] option[value="'+ response.product.jenis_barang +'"]').prop('selected', true);
          $('select[name=satuan_berat] option[value="'+ berat_barang[1] +'"]').prop('selected', true);
          validator.resetForm();
        }
      });
    });

    $(document).on('click', '.btn-delete', function(e){
      e.preventDefault();
      var data_delete = $(this).attr('data-delete');
      swal({
        title: "Apa Anda Yakin?",
        text: "Data barang akan terhapus, klik oke untuk melanjutkan",
        icon: "warning",
        buttons: true,
        dangerMode: true,
      })
      .then((willDelete) => {
        if (willDelete) {
          window.open("{{ url('/product/delete') }}/" + data_delete, "_self");
        }
      });
    });
</script>
@endsection
