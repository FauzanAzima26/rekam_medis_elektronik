<div class="modal fade" id="modalPendaftaran" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-6">
                    <h4 class="mb-2">Add New Record</h4>
                    <p>Adding a new record will create a new entry in the system.</p>
                </div>
                <form id="formPendaftaran" class="row g-6" onsubmit="return false">
                    @csrf
                    <input type="hidden" name="pasienId" id="pasienId" class="pendaftaranId" />
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditUserFirstName">Tanggal Kunjungan</label>
                        <div class="input-group">
                            <input
                                type="text"
                                id="tanggal_kunjungan"
                                name="tanggal_kunjungan"
                                class="form-control tanggal_kunjungan"
                                placeholder="Masukan tanggal kunjungan" />
                            <span class="input-group-text">
                                <i class="ti ti-calendar"></i>
                            </span>
                        </div>
                        <div class="invalid-feedback" id="error-tanggal_kunjungan"></div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditUserLastName">Pasien</label>
                        <select
                            id="pasien_id"
                            name="pasien_id"
                            class="select2 form-select pasien select2-placeholder-muted"
                            aria-label="Default select example"
                            data-placeholder="Pilih Pasien">
                            <option value=""></option>
                            @foreach($pasien as $item)
                            <option value="{{ $item->id }}">{{ $item->no_rm }} - {{ $item->nama_lengkap }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback" id="error-pasien_id"></div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="no_antrean">No. Antrean</label>

                        <div class="input-group">
                            <input
                                type="text"
                                id="no_antrean"
                                name="no_antrean"
                                placeholder="Masukan no. antrean"
                                autocomplete="off"
                                class="form-control no_antrean"
                                required />
                        </div>

                        <div class="invalid-feedback" id="error-no_antrean"></div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditUserEmail">Jenis Kunjungan</label>
                        <select
                            id="jenis_kunjungan"
                            name="jenis_kunjungan"
                            class="select2 form-select jenis_kunjungan select2-placeholder-muted"
                            aria-label="Default select example"
                            data-placeholder="Jenis Kunjungan">
                            <option value=""></option>
                            <option value="umum">Umum</option>
                            <option value="pasien">Pasien</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-12">
                        <label class="form-label" for="modalEditUserStatus">Keluhan</label>
                        <textarea
                            id="keluhan"
                            name="keluhan"
                            class="form-control keluhan"
                            rows="3"
                            placeholder="Masukan keluhan"></textarea>
                        <div class="invalid-feedback" id="error-keluhan"></div>
                    </div>
                    <div class="col-12 text-center">
                        <button type="submit" class="btn btn-primary me-3">Submit</button>
                        <button
                            type="reset"
                            class="btn btn-label-secondary"
                            data-bs-dismiss="modal"
                            aria-label="Close">
                            Cancel
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>