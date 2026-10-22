@extends('layouts.app')

@section('content')

<div class="container-fluid mt-5 mb-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-label-success p-2 rounded">
                            <i class="ti ti-packages ti-md"></i>
                        </span>

                        <h5 class="card-title mb-0 fw-semibold">
                            Pendaftaran Pasien
                        </h5>
                        <button type="button" class="btn btn-success create-new ms-auto"> <i class="ti ti-plus me-1"></i> Tambah Pendaftaran </button>
                    </div>
                </div>
                <div class="card-datatable table-responsive pt-0">
                    <table class="table border-top" id="pendaftaranTable" data-pendaftaran="{{ route('pendaftaran.getData') }}">
                        <thead>
                            <tr>
                                <th class="text-center" width="8%">No. Antrean</th>
                                <th style="text-align:center">Nama</th>
                                <th style="text-align:center">Tanggal Kunjungan</th>
                                <th style="text-align:center">Keluhan</th>
                                <th style="text-align:center">Jenis Kunjungan</th>
                                <th style="text-align:center">Status</th>
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('pendaftaran._tambahData')

@push('scripts')
<script src="{{ asset('assets/backend/pendaftaran.js') }}"></script>
@endpush

@endsection