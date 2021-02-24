@extends('layouts.backend')
@section('moreCustomStyle')
<link rel="stylesheet" href="{{ asset('css/cart/style.css') }}">
@endsection
@section('content')
<div class="container-fluid">
    <div class="row page-title-header pt-4">
        <div class="col-12">
            <div class="page-header d-flex justify-content-start align-items-center">
                <h4 class="page-title">Transaksi</h4>
            </div>
        </div>
    </div>
    <div class="row modal-group">
        <div class="modal fade" id="scanModal" tabindex="-1" role="dialog" aria-labelledby="scanModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="scanModalLabel">Scan Barcode</h5>
                        <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="alert alert-danger kode_barang_error" role="alert" hidden="">
                                    <i class="mdi mdi-information-outline"></i> Kode barang tidak tersedia
                                </div>
                            </div>
                            <div class="col-12 text-center" id="area-scan">
                            </div>
                            <div class="col-12 barcode-result" hidden="">
                                <h5 class="font-weight-bold">Hasil</h5>
                                <div class="form-border">
                                    <p class="barcode-result-text"></p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer" id="btn-scan-action" hidden="">
                        <button type="button"
                            class="btn btn-primary btn-sm font-weight-bold rounded-0 btn-continue">Lanjutkan</button>
                        <button type="button"
                            class="btn btn-outline-secondary btn-sm font-weight-bold rounded-0 btn-repeat">Ulangi</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="tableModal" tabindex="-1" role="dialog" aria-labelledby="tableModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="tableModalLabel">Daftar Barang</h5>
                        <button type="button" class="close close-btn" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="search" placeholder="Cari barang">
                                </div>
                            </div>
                            <div class="col-12">
                                <ul class="list-group product-list">
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($message = Session::get('transaction_success'))
        <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body bg-grey">
                        <div class="row">
                            <div class="col-12 text-center mb-4">
                                <img src="{{ asset('gif/success4.gif') }}">
                                <h4 class="transaction-success-text">Transaksi Berhasil</h4>
                            </div>
                            @php
                            $transaksi = \App\Transaction::where('transactions.kode_transaksi', '=', $message)
                            ->select('transactions.*')
                            ->first();
                            @endphp
                            <div class="col-12">
                                <table class="table-receipt">
                                    <tr>
                                        <td>
                                            <span class="d-block little-td">Kode Transaksi</span>
                                            <span class="d-block font-weight-bold">{{ $message }}</span>
                                        </td>
                                        <td>
                                            <span class="d-block little-td">Tanggal</span>
                                            <span
                                                class="d-block font-weight-bold">{{ date('d M, Y', strtotime($transaksi->created_at)) }}</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <span class="d-block little-td">Kasir</span>
                                            <span class="d-block font-weight-bold">{{ $transaksi->kasir }}</span>
                                        </td>
                                        <td>
                                            <span class="d-block little-td">Total</span>
                                            <span class="d-block font-weight-bold text-success">Rp.
                                                {{ number_format($transaksi->total,2,',','.') }}</span>
                                        </td>
                                    </tr>
                                </table>
                                <table class="table-summary mt-3">
                                    <tr>
                                        <td class="line-td" colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td class="little-td big-td">Bayar</td>
                                        <td>Rp. {{ number_format($transaksi->bayar,2,',','.') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="little-td big-td">Kembali</td>
                                        <td>Rp. {{ number_format($transaksi->kembali,2,',','.') }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-sm btn-close-modal" data-dismiss="modal">Tutup</button>
                        <a href="{{ url('/transaction/receipt/' . $message) }}" target="_blank"
                            class="btn btn-sm btn-cetak-pdf">Cetak Struk</a>
                    </div>
                </div>
            </div>
        </div>
        @endif
    </div>
    <form method="POST" name="transaction_form" id="transaction_form" action="{{ url('/transaction/process') }}">
        @csrf
        <div class="row">
            <div class="col-lg-8 col-md-8 col-sm-12 mb-4">
                <div class="row">
                    <div class="col-12 mb-4 bg-dark-blue">
                        <div class="card card-noborder b-radius">
                            <div class="card-body">
                                <div class="row">
                                    <div
                                        class="col-12 d-flex justify-content-between align-items-center transaction-header">
                                        <div class="d-flex justify-content-start align-items-center">
                                            <div class="icon-holder">
                                                <i class="mdi mdi-swap-horizontal"></i>
                                            </div>
                                            <div class="transaction-code ml-3">
                                                <p class="m-0 text-white">Kode Transaksi</p>
                                                <p class="m-0 text-white">T{{ date('dmYHis') }}</p>
                                                <input type="text" name="kode_transaksi" value="T{{ date('dmYHis') }}"
                                                    hidden="">
                                            </div>
                                        </div>
                                        <div class="btn-group mt-h">
                                            <button class="btn btn-search" data-toggle="modal" data-target="#tableModal"
                                                type="button">
                                                <i class="mdi mdi-magnify"></i>
                                            </button>
                                            <button class="btn btn-scan" data-toggle="modal" data-target="#scanModal"
                                                type="button">
                                                <i class="mdi mdi-crop-free"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card card-noborder b-radius">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 d-flex justify-content-start align-items-center">
                                        <div class="cart-icon mr-3">
                                            <i class="mdi mdi-cart-outline"></i>
                                        </div>
                                        <p class="m-0 text-black-50">Daftar Pesanan</p>
                                    </div>
                                    <div class="col-12 mt-3 table-responsive">
                                        <table class="table table-checkout">
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
                <div class="card card-noborder b-radius">
                    <div class="card-body pt-0">
                        <div class="row">
                            <div class="col-12 payment-1">
                                <table class="table-payment-1">
                                    <tr>
                                        <td class="text-left">Tanggal</td>
                                        <td class="text-right">{{ date('d M, Y') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Waktu</td>
                                        <td class="text-right">{{ date('H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">Kasir</td>
                                        <td class="text-right">{{ auth()->user()->nama }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-12 mt-4">
                                <table class="table-payment-2">
                                    <tr>
                                        <td class="text-left">
                                            <span class="subtotal-td">Subtotal</span>
                                            <span class="jml-barang-td">0 Barang</span>
                                        </td>
                                        <td class="text-right nilai-subtotal1-td">Rp. 0</td>
                                        <td hidden=""><input type="text" class="nilai-subtotal2-td" name="subtotal"
                                                value="0"></td>
                                    </tr>
                                    <tr>
                                        <td class="text-left">
                                            <span class="diskon-td">Diskon</span>
                                            <a href="#" class="ubah-diskon-td">Ubah diskon</a>
                                            <a href="#" class="simpan-diskon-td" hidden="">Simpan</a>
                                        </td>
                                        <td class="text-right d-flex justify-content-end align-items-center pt-2">
                                            <input type="number" class="form-control diskon-input mr-2" min="0"
                                                max="100" name="diskon" value="0" hidden="">
                                            <span class="nilai-diskon-td mr-1">0</span>
                                            <span>%</span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="2" class="text-center nilai-total1-td">Rp. 0</td>
                                        <td hidden=""><input type="text" class="nilai-total2-td" name="total" value="0">
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-12 mt-2">
                                <table class="table-payment-3">
                                    <tr>
                                        <td>
                                            <div class="input-group">
                                                <div class="input-group-prepend">
                                                    <div class="input-group-text">Rp.</div>
                                                </div>
                                                <input type="text"
                                                    class="form-control number-input input-notzero bayar-input"
                                                    name="bayar" placeholder="Masukkan nominal bayar">
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="nominal-error" hidden="">
                                        <td class="text-danger nominal-min">Nominal bayar kurang</td>
                                    </tr>
                                    <tr>
                                        <td class="text-right d-inline-flex float-right">
                                            <button class="btn btn-cart mr-2" type="button">Cart</button>
                                            <button class="btn btn-bayar" type="button">Bayar</button>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
@push('moreCustomJs')
@once
@endonce
@endpush
