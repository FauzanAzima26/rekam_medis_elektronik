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
                            Pasien
                        </h5>
                        <button type="button" class="btn btn-success create-new ms-auto"> <i class="ti ti-plus me-1"></i> Tambah Pasien </button>
                    </div>
                </div>
                <div class="card-datatable table-responsive pt-0">
                    <table class="table border-top" id="pasienTable" data-pasien="{{ route('pasien.getData') }}">
                        <thead>
                            <tr>
                                <th class="text-center" width="8%">No.</th>
                                <th class="text-center" width="8%">No. RM</th>
                                <th style="text-align:center">Nama</th>
                                <th style="text-align:center">Tanggal Lahir</th>
                                <th style="text-align:center">Jenis Kelamin</th>
                                <th style="text-align:center">Usia</th>
                                <th style="text-align:center">No. Hp</th>
                                <th style="text-align:center">Alamat</th>
                                <th style="text-align:center">Jenis Pasien</th>
                                <th style="text-align:center;">Aksi</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@include('pasien._tambahData')

@push('scripts')
<script src="{{ asset('assets/backend/pasien.js') }}"></script>
@endpush

@endsection