@extends('layouts.app')

@section('content')

<div class="container-fluid mt-5 mb-5">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                {{-- Header --}}
                <div class="card-header border-bottom">
                    <div class="d-flex align-items-center gap-2">
                        <span class="badge bg-label-success p-2 rounded">
                            <i class="ti ti-stethoscope ti-md"></i>
                        </span>

                        <div>
                            <h5 class="card-title mb-0 fw-semibold">
                                Pemeriksaan Pasien
                            </h5>
                            <small class="text-muted">
                                Form pemeriksaan dan resep obat pasien
                            </small>
                        </div>
                    </div>
                </div>

                <form id="formPemeriksaan">
                    <div class="card-body">

                        {{-- Informasi Pasien --}}
                        <h6 class="fw-semibold mb-3">
                            <i class="ti ti-user me-1"></i>
                            Informasi Pasien
                        </h6>

                        <div class="row g-3 mb-4">
                            <div class="col-md-3">
                                <label class="form-label">No. Rekam Medis</label>
                                <input type="text" class="form-control"
                                    id="no_rm" name="no_rm" readonly>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">No. Antrean</label>
                                <input type="text" class="form-control"
                                    id="no_antrean" name="no_antrean" readonly>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Nama Pasien</label>
                                <input type="text" class="form-control"
                                    id="nama_pasien" name="nama_pasien" readonly>
                            </div>

                            <div class="col-md-3">
                                <label class="form-label">Tanggal Pemeriksaan</label>
                                <input type="text" class="form-control"
                                    id="tanggal_pemeriksaan"
                                    name="tanggal_pemeriksaan" readonly>
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- Keluhan dan Pemeriksaan Fisik --}}
                        <h6 class="fw-semibold mb-3">
                            <i class="ti ti-activity me-1"></i>
                            Keluhan dan Pemeriksaan Fisik
                        </h6>

                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <label for="keluhan_utama" class="form-label">
                                    Keluhan Utama <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="keluhan_utama"
                                    name="keluhan_utama" rows="3"
                                    placeholder="Masukkan keluhan utama pasien"
                                    required></textarea>
                            </div>

                            <div class="col-md-3">
                                <label for="tekanan_darah" class="form-label">
                                    Tekanan Darah
                                </label>
                                <input type="text" class="form-control"
                                    id="tekanan_darah" name="tekanan_darah"
                                    placeholder="Contoh: 120/80 mmHg">
                            </div>

                            <div class="col-md-3">
                                <label for="suhu_tubuh" class="form-label">
                                    Suhu Tubuh (°C)
                                </label>
                                <input type="number" class="form-control"
                                    id="suhu_tubuh" name="suhu_tubuh"
                                    step="0.1" min="0"
                                    placeholder="Contoh: 36.5">
                            </div>

                            <div class="col-md-3">
                                <label for="berat_badan" class="form-label">
                                    Berat Badan (kg)
                                </label>
                                <input type="number" class="form-control"
                                    id="berat_badan" name="berat_badan"
                                    step="0.01" min="0"
                                    placeholder="Contoh: 60">
                            </div>

                            <div class="col-md-3">
                                <label for="tinggi_badan" class="form-label">
                                    Tinggi Badan (cm)
                                </label>
                                <input type="number" class="form-control"
                                    id="tinggi_badan" name="tinggi_badan"
                                    step="0.01" min="0"
                                    placeholder="Contoh: 165">
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- Hasil Pemeriksaan --}}
                        <h6 class="fw-semibold mb-3">
                            <i class="ti ti-clipboard-check me-1"></i>
                            Hasil Pemeriksaan
                        </h6>

                        <div class="row g-3 mb-4">
                            <div class="col-md-12">
                                <label for="diagnosis" class="form-label">
                                    Diagnosis <span class="text-danger">*</span>
                                </label>
                                <textarea class="form-control" id="diagnosis"
                                    name="diagnosis" rows="3"
                                    placeholder="Masukkan diagnosis pasien"
                                    required></textarea>
                            </div>

                            <div class="col-md-12">
                                <label for="tindakan" class="form-label">
                                    Tindakan Medis
                                </label>
                                <textarea class="form-control" id="tindakan"
                                    name="tindakan" rows="3"
                                    placeholder="Masukkan tindakan medis yang dilakukan"></textarea>
                            </div>

                            <div class="col-md-12">
                                <label for="catatan" class="form-label">
                                    Catatan Tambahan
                                </label>
                                <textarea class="form-control" id="catatan"
                                    name="catatan" rows="3"
                                    placeholder="Catatan tambahan jika diperlukan"></textarea>
                            </div>
                        </div>

                        <hr class="my-4">

                        {{-- Resep Obat --}}
                        <div class="d-flex align-items-center justify-content-between mb-3">
                            <h6 class="fw-semibold mb-0">
                                <i class="ti ti-pill me-1"></i>
                                Resep Obat
                            </h6>

                            <button type="button" class="btn btn-sm btn-outline-primary"
                                id="btnTambahObat">
                                <i class="ti ti-plus me-1"></i>
                                Tambah Obat
                            </button>
                        </div>

                        <div id="daftarResepObat">
                            <div class="resep-obat-item border rounded p-3 mb-3">
                                <div class="d-flex justify-content-between align-items-center mb-3">
                                    <h6 class="mb-0">Obat 1</h6>

                                    <button type="button"
                                        class="btn btn-sm btn-icon btn-label-danger btnHapusObat"
                                        title="Hapus obat">
                                        <i class="ti ti-trash"></i>
                                    </button>
                                </div>

                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <label class="form-label">Nama Obat</label>
                                        <select class="form-select nama-obat"
                                            name="resep[0][obat_id]">
                                            <option value="">Pilih obat</option>
                                        </select>
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Dosis</label>
                                        <input type="text" class="form-control"
                                            name="resep[0][dosis]"
                                            placeholder="Contoh: 500 mg">
                                    </div>

                                    <div class="col-md-2">
                                        <label class="form-label">Jumlah</label>
                                        <input type="number" class="form-control"
                                            name="resep[0][jumlah]" min="1"
                                            placeholder="Jumlah">
                                    </div>

                                    <div class="col-md-4">
                                        <label class="form-label">Aturan Pakai</label>
                                        <input type="text" class="form-control"
                                            name="resep[0][aturan_pakai]"
                                            placeholder="Contoh: 3 kali sehari">
                                    </div>

                                    <div class="col-md-12">
                                        <label class="form-label">Catatan Obat</label>
                                        <input type="text" class="form-control"
                                            name="resep[0][catatan]"
                                            placeholder="Contoh: diminum setelah makan">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-info d-flex align-items-start gap-2 mb-0">
                            <i class="ti ti-info-circle ti-md mt-1"></i>
                            <div>
                                Resep obat bersifat opsional. Jika pasien tidak
                                memerlukan obat, bagian ini dapat dikosongkan.
                            </div>
                        </div>

                    </div>

                    {{-- Footer --}}
                    <div class="card-footer border-top d-flex justify-content-between">
                        <a href="{{ route('antrean-pemeriksaan.index') }}"
                            class="btn btn-label-secondary">
                            <i class="ti ti-arrow-left me-1"></i>
                            Kembali ke Antrean
                        </a>

                        <button type="submit" class="btn btn-success"
                            id="btnSimpanPemeriksaan">
                            <i class="ti ti-device-floppy me-1"></i>
                            Simpan & Selesaikan
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="{{ asset('assets/backend/pemeriksaan.js') }}"></script>
@endpush

@endsection