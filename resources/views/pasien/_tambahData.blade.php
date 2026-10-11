<div class="modal fade" id="modalPasien" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-simple modal-edit-user">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="text-center mb-6">
                    <h4 class="mb-2">Add New Record</h4>
                    <p>Adding a new record will create a new entry in the system.</p>
                </div>
                <form id="formPasien" class="row g-6" onsubmit="return false">
                    @csrf
                    <input type="hidden" name="pasienId" id="pasienId" class="pasienId">
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditUserFirstName">No. RM</label>
                        <input
                            type="text"
                            id="modalEditUserFirstName"
                            name="no_rm"
                            class="form-control no_rm"
                            value="John" />
                            <div class="invalid-feedback" id="error-no_rm"></div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditUserLastName">Nama Lengkap</label>
                        <input
                            type="text"
                            id="modalEditUserLastName"
                            name="nama_lengkap"
                            class="form-control nama_lengkap"
                            placeholder="Masukan nama lengkap"
                            value="Doe" />
                            <div class="invalid-feedback" id="error-nama_lengkap"></div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditUserName">Tanggal Lahir</label>
                        <input
                            type="date"
                            id="modalEditUserName"
                            name="tanggal_lahir"
                            class="form-control tanggal_lahir"
                            placeholder="johndoe007"
                            value="johndoe007" />
                            <div class="invalid-feedback" id="error-tanggal_lahir"></div>
                    </div>
                    <div class="col-12 col-md-6">
                        <label class="form-label" for="modalEditUserEmail">Jenis Kelamin</label>
                        <select
                            id="modalEditUserStatus"
                            name="gender"
                            class="select2 form-select gender"
                            aria-label="Default select example">
                            <option disabled>Jenis Kelamin</option>
                            <option value="L">Laki-laki</option>
                            <option value="P">Perempuan</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="modalEditUserStatus">Usia</label>
                        <input
                            type="number"
                            id="usia"
                            name="usia"
                            class="form-control usia"
                            value="johndoe007" />
                            <div class="invalid-feedback" id="error-usia"></div>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="modalEditUserPhone">No. Handphone</label>
                        <div class="input-group">
                            <input
                                type="tel"
                                id="no_hp"
                                name="no_hp"
                                class="form-control no_hp"
                                placeholder="081234567890" />
                            <div class="invalid-feedback" id="error-no_hp"></div>
                        </div>
                    </div>
                    <div class="col-12 col-md-4">
                        <label class="form-label" for="modalEditTaxID">Jenis Pasien</label>
                        <select
                            id="modalEditUserStatus"
                            name="jenis_pasien"
                            class="select2 form-select jenis_pasien"
                            aria-label="Default select example">
                            <option disabled>Jenis Pasien</option>
                            <option value="T">Tunai</option>
                            <option value="BPJS">BPJS</option>
                        </select>
                    </div>
                    <div class="col-12 col-md-12">
                        <label class="form-label" for="modalEditTaxID">Alamat</label>
                        <textarea
                            id="modalEditTaxID"
                            name="alamat"
                            class="form-control alamat"></textarea>
                        <div class="invalid-feedback" id="error-alamat"></div>
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