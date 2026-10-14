$(function () {
    let pasienTable = $("#pasienTable").DataTable({
        processing: true,
        scrollX: true,
        ajax: $("#pasienTable").data("pasien"),

        columns: [
            {
                data: "DT_RowIndex",
                name: "DT_RowIndex",
                className: "text-center",
                orderable: false,
                searchable: false,
            },
            {
                data: "no_rm",
                name: "no_rm",
                className: "text-center",
            },
            {
                data: "nama_lengkap",
                name: "nama_lengkap",
                className: "text-center",
            },
            {
                data: "tanggal_lahir",
                name: "tanggal_lahir",
                className: "text-center",
                render: function (data) {
                    if (!data) return "-";
                    return data.substring(0, 10).split("-").reverse().join("-");
                },
            },
            {
                data: "gender",
                name: "gender",
                className: "text-center",
                render: function (data) {
                    if (data === "L") return "Laki-laki";
                    if (data === "P") return "Perempuan";

                    return data ?? "-";
                },
            },
            {
                data: "usia",
                name: "usia",
                className: "text-center",
            },
            {
                data: "no_hp",
                name: "no_hp",
                className: "text-center",
            },
            {
                data: "alamat",
                name: "alamat",
            },
            {
                data: "jenis_pasien",
                name: "jenis_pasien",
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
        $("#modalPasien .modal-title").text("Tambah Data Pasien");

        $("#formPasien")[0].reset();
        $("#formPasien .is-invalid").removeClass("is-invalid");
        $("#formPasien .invalid-feedback").text("");
        $("#pasienId").val("");
        $("#jenis_pasien").val("").trigger("change");
        $("#jenis_kelamin").val("").trigger("change");

        bootstrap.Modal.getOrCreateInstance(
            document.getElementById("modalPasien"),
        ).show();
    });

    $(document).on("click", ".btn-edit", function () {
        let id = $(this).data("id");

        $.ajax({
            url: "/pasien/" + id,
            type: "GET",

            success: function (res) {
                let data = res.data ?? res;
                const tanggal = data.tanggal_lahir
                    ? data.tanggal_lahir.substring(0, 10)
                    : "";

                $("#pasienId").val(data.id);
                $("#no_rm").val(data.no_rm);
                $("#nama_lengkap").val(data.nama_lengkap);
                document
                    .querySelector("#tanggal_lahir")
                    ._flatpickr?.setDate(tanggal, true, "Y-m-d");
                $("#jenis_kelamin").val(data.gender).trigger("change");
                $("#usia").val(data.usia);
                $("#no_hp").val(data.no_hp);
                $("#alamat").val(data.alamat);
                $("#jenis_pasien").val(data.jenis_pasien).trigger("change");

                $("#modalPasien .modal-title").text("Edit Data Pasien");

                bootstrap.Modal.getOrCreateInstance(
                    document.getElementById("modalPasien"),
                ).show();
            },

            error: function (xhr) {
                Swal.fire(
                    "Error",
                    xhr.responseJSON?.message ?? "Gagal mengambil data pasien.",
                    "error",
                );
            },
        });
    });

    $("#formPasien")
        .off("submit")
        .on("submit", function (e) {
            e.preventDefault();

            let id = $("#pasienId").val();
            let formData = new FormData(this);

            let ajaxUrl = id
                ? "/pasien/" + id
                : $("#pasienTable").data("store");

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
                        document.getElementById("modalPasien"),
                    ).hide();

                    $("#jenis_pasien").val("").trigger("change");
                    $("#jenis_kelamin").val("").trigger("change");
                    $("#formPasien")[0].reset();
                    $("#pasienId").val("");

                    pasienTable.ajax.reload(null, false);

                    Swal.fire(
                        "Berhasil",
                        res.message ?? "Data pasien berhasil disimpan.",
                        "success",
                    );
                },

                error: function (xhr) {
                    if (xhr.status === 422) {
                        let msg = "";

                        $("#formPasien .is-invalid").removeClass("is-invalid");
                        $("#formPasien .invalid-feedback").text("");
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
            title: "Yakin ingin menghapus pasien?",
            text: "Data pasien akan dihapus.",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Ya, hapus!",
            cancelButtonText: "Batal",
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: "/pasien/" + id,
                    type: "POST",
                    data: {
                        _method: "DELETE",
                        _token: $('meta[name="csrf-token"]').attr("content"),
                    },

                    success: function (res) {
                        pasienTable.ajax.reload(null, false);

                        Swal.fire(
                            "Terhapus!",
                            res.message ?? "Data pasien berhasil dihapus.",
                            "success",
                        );
                    },

                    error: function (xhr) {
                        Swal.fire(
                            "Error",
                            xhr.responseJSON?.message ??
                                "Gagal menghapus data pasien.",
                            "error",
                        );
                    },
                });
            }
        });
    });
});

flatpickr("#tanggal_lahir", {
    dateFormat: "Y-m-d",
    altInput: true,
    altFormat: "d-m-Y",
    maxDate: "today",
    allowInput: true,
});
document.querySelector(".ti-calendar").addEventListener("click", function () {
    document.querySelector("#tanggal_lahir")._flatpickr?.open();
});

$(".select2-placeholder-muted").select2({
    placeholder: function () {
        return $(this).data("placeholder");
    },
    allowClear: true,
    width: "100%",
    dropdownParent: $("#modalPasien"),
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
