$(function () {
    let pendaftaranTable = $("#pendaftaranTable").DataTable({
        processing: true,
        scrollX: true,
        ajax: $("#pendaftaranTable").data("pendaftaran"),

        columns: [
            {
                data: "no_antrean",
                name: "no_antrean",
                className: "text-center",
            },
            {
                data: "nama_lengkap",
                name: "nama_lengkap",
                className: "text-center",
            },
            {
                data: "status",
                name: "status",
                className: "text-center",
            },
            {
                data: null,
                className: "text-center",
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    return `
                        <div class="d-inline-flex gap-1">
                            <button
                                type="button"
                                class="btn btn-sm btn-icon btn-text-warning waves-effect btn-edit"
                                title="Edit"
                                data-id="${row.id}">
                                <i class="ti ti-edit"></i>
                            </button>

                            <button
                                type="button"
                                class="btn btn-sm btn-icon btn-text-danger waves-effect btn-delete"
                                title="Hapus"
                                data-id="${row.id}">
                                <i class="ti ti-trash"></i>
                            </button>
                        </div>
                    `;
                },
            },
        ],

        order: [[0, "asc"]],
        displayLength: 5,
        lengthMenu: [5, 10, 25, 50, 75, 100],
    });

    $(document).on("click", ".create-new", function () {
        $("#modalPendaftaran .modal-title").text("Tambah Data Pendaftaran");

        $("#formPendaftaran")[0].reset();
        $("#formPendaftaran .is-invalid").removeClass("is-invalid");
        $("#formPendaftaran .invalid-feedback").text("");
        $("#pendaftaranId").val("");
        $("#jenis_kunjungan").val("").trigger("change");
        $("#pasien_id").val("").trigger("change");

        bootstrap.Modal.getOrCreateInstance(
            document.getElementById("modalPendaftaran"),
        ).show();
    });

    // $(document).on("click", ".btn-edit", function () {
    //     let id = $(this).data("id");

    //     $.ajax({
    //         url: "/pendaftaran/" + id,
    //         type: "GET",

    //         success: function (res) {
    //             let data = res.data ?? res;
    //             const tanggal = data.tanggal_lahir
    //                 ? data.tanggal_lahir.substring(0, 10)
    //                 : "";

    //             $("#pendaftaranId").val(data.id);
    //             $("#no_antrean").val(data.no_antrean);
    //             $("#nama_lengkap").val(data.nama_lengkap);
    //             document
    //                 .querySelector("#tanggal_lahir")
    //                 ._flatpickr?.setDate(tanggal, true, "Y-m-d");
    //             $("#jenis_kelamin").val(data.gender).trigger("change");
    //             $("#usia").val(data.usia);
    //             $("#no_hp").val(data.no_hp);
    //             $("#alamat").val(data.alamat);
    //             $("#jenis_pasien").val(data.jenis_pasien).trigger("change");

    //             $("#modalPendaftaran .modal-title").text(
    //                 "Edit Data Pendaftaran",
    //             );

    //             bootstrap.Modal.getOrCreateInstance(
    //                 document.getElementById("modalPendaftaran"),
    //             ).show();
    //         },

    //         error: function (xhr) {
    //             Swal.fire(
    //                 "Error",
    //                 xhr.responseJSON?.message ??
    //                     "Gagal mengambil data pendaftaran.",
    //                 "error",
    //             );
    //         },
    //     });
    // });

    $("#formPendaftaran")
        .off("submit")
        .on("submit", function (e) {
            e.preventDefault();

            let id = $("#pendaftaranId").val();
            let formData = new FormData(this);

            let ajaxUrl = id
                ? "/pendaftaran/" + id
                : $("#pendaftaranTable").data("store");

            if (id) {
                formData.append("_method", "PUT");
            }

            $.ajax({
                url: ajaxUrl,
                type: "POST",
                data: formData,
                processData: false,
                contentType: false,

                success: function (res) {
                    bootstrap.Modal.getOrCreateInstance(
                        document.getElementById("modalPendaftaran"),
                    ).hide();

                    $("#pasien_id").val("").trigger("change");
                    $("#jenis_kunjungan").val("").trigger("change");
                    $("#formPendaftaran")[0].reset();
                    $("#pendaftaranId").val("");

                    pendaftaranTable.ajax.reload(null, false);

                    Swal.fire(
                        "Berhasil",
                        res.message ?? "Data pendaftaran berhasil disimpan.",
                        "success",
                    );
                },

                error: function (xhr) {
                    if (xhr.status === 422) {
                        let msg = "";

                        $("#formPendaftaran .is-invalid").removeClass(
                            "is-invalid",
                        );
                        $("#formPendaftaran .invalid-feedback").text("");
                        $.each(xhr.responseJSON.errors, function (key, value) {
                            $("#" + key).addClass("is-invalid");
                            $("#error-" + key).text(value[0]);
                        });
                    } else {
                        Swal.fire(
                            "Error",
                            xhr.responseJSON?.message ??
                                "Terjadi kesalahan saat menyimpan data.",
                            "error",
                        );
                    }
                },
            });
        });

    $(document).on("click", ".btn-delete", function () {
        let id = $(this).data("id");

        Swal.fire({
            title: "Yakin ingin menghapus pendaftaran?",
            text: "Data pendaftaran akan dihapus.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/pendaftaran/" + id,
                    type: "POST",
                    data: {
                        _method: "DELETE",
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },

                    success: function (res) {
                        pendaftaranTable.ajax.reload(null, false);

                        Swal.fire(
                            "Terhapus!",
                            res.message ?? "Data pendaftaran berhasil dihapus.",
                            "success",
                        );
                    },

                    error: function (xhr) {
                        Swal.fire(
                            "Error",
                            xhr.responseJSON?.message ??
                                "Gagal menghapus data pendaftaran.",
                            "error",
                        );
                    },
                });
            }
        });
    });
});

flatpickr("#tanggal_kunjungan", {
    dateFormat: "Y-m-d",
    altInput: true,
    altFormat: "d-m-Y",
    maxDate: "today",
    allowInput: true,
});
document.querySelector(".ti-calendar").addEventListener("click", function () {
    document.querySelector("#tanggal_kunjungan")._flatpickr?.open();
});

$(".select2-placeholder-muted").select2({
    placeholder: function () {
        return $(this).data("placeholder");
    },
    allowClear: true,
    width: "100%",
    dropdownParent: $("#modalPendaftaran"),
    minimumResultsForSearch: Infinity,

    templateSelection: function (data) {
        if (!data.id) {
            return $("<span>")
                .text(data.text || data.placeholder || "")
                .addClass("text-muted");
        }

        return data.text;
    },
});
