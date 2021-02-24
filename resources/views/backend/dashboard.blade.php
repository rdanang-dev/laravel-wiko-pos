@extends('layouts.backend')
@section('moreCustomStyle')
<link rel="stylesheet" href="{{ asset('css/dashboard/style.css') }}">
@endsection
@section('content')
<div class="container-fluid py-4">
    <div class="row page-title-header">
        <div class="col-12">
            <div class="page-header d-flex justify-content-between align-items-center">
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">

            <div class="row">
                <div class="col-lg-6 col-md-12 col-sm-6 col-12 mb-4">
                    <div class="card b-radius card-noborder bg-blue">
                        <div class="card-body custom-card-p">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-start align-items-center icon-card">
                                    <div class="icon-round text-white">Rp</div>
                                    <div class="ml-3">
                                        <p class="m-0 text-white">Pemasukan Harian</p>
                                        <h5 class="text-white">120</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6 col-md-12 col-sm-6 col-12 mb-4">
                    <div class="card b-radius card-noborder">
                        <div class="card-body custom-card-p">
                            <div class="row">
                                <div class="col-12 d-flex justify-content-start align-items-center icon-card">
                                    <div class="icon-round-2">
                                        <i class="mdi mdi-account-multiple"></i>
                                    </div>
                                    <div class="ml-3">
                                        <p class="m-0">Pelanggan Harian</p>
                                        <h5>120 Orang</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-5">
                    <div class="card b-radius card-noborder">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-12 mb-4 d-flex justify-content-between align-items-center">
                                    <h5 class="font-weight-semibold chart-title">Pemasukan 1 Minggu Terakhir</h5>
                                    <div class="dropdown">
                                        <button class="btn btn-filter-chart icon-btn dropdown-toggle" type="button"
                                            id="dropdownMenuIconButton1" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            Pemasukan
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuIconButton1">
                                            <a class="dropdown-item chart-filter" href="#"
                                                data-filter="pemasukan">Pemasukan</a>
                                            <a class="dropdown-item chart-filter" href="#"
                                                data-filter="pelanggan">Pelanggan</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <canvas id="myChart" style="width: 100%; height: 315px;"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
            <div class="card b-radius card-noborder">
                <div class="card-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <p class="m-0">Total Pemasukan</p>
                            <h2 class="font-weight-bold">Rp.semua <h2>
                                    <p class="m-0 txt-light"></p>
                        </div>
                        <div class="col-12 text-center mt-4">
                            <div class="btn-view-all">
                                <i class="mdi mdi-chevron-down"></i>
                            </div>
                        </div>
                        <div class="col-12">
                            <hr>
                            <div class="d-flex justify-content-between align-items-center">
                                <h5 class="font-weight-semibold">Riwayat Transaksi</h5>
                                <button class="btn btn-view-transaction" type="button" data-access="">Semua</button>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="text-group mt-3">
                                <div class="d-flex justify-content-between">
                                    <div class="d-flex justify-content-start">
                                        <span class="icon-transaksi">
                                            <i class="mdi mdi-swap-horizontal"></i>
                                        </span>
                                        <div class="ml-2">
                                            <p class="kode_transaksi font-weight-semibold"></p>
                                            <p class="des-transaksi">Rp.
                                                asdfa<span class="dot"><i
                                                        class="mdi mdi-checkbox-blank-circle"></i></span>
                                                asdfafs</p>
                                        </div>
                                    </div>
                                    <span class="w-transaksi">123123</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('moreCustomJs')
@once
@endonce
@endpush
