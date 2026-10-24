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
                            Antrean Pasien
                        </h5>
                    </div>
                </div>
                <div class="card-datatable table-responsive pt-0">
                    <table class="table border-top" id="antreanTable" data-antrean="{{ route('antrean-pemeriksaan.getData') }}">
                        <thead>
                            <tr>
                                <th class="text-center" width="8%">No. Antrean</th>
                                <th style="text-align:center">Nama Pasien</th>
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

@push('scripts')
<script src="{{ asset('assets/backend/antreanPemeriksaan.js') }}"></script>
@endpush

@endsection