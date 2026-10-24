$(function () {
    let antreanTable = $("#antreanTable").DataTable({
        processing: true,
        scrollX: true,
        ajax: $("#antreanTable").data("antrean"),

        columns: [
            {
                data: "no_antrean",
                name: "no_antrean",
                className: "text-center",
            },
            {
                data: "pasien.nama_lengkap",
                name: "nama_lengkap",
                className: "text-center",
            },
            {
                data: "status",
                name: "status",
                className: "text-center",
                render: function (data, type) {
                    if (type === "display") {
                        return data === "Selesai"
                            ? '<span class="badge bg-success">Selesai</span>'
                            : '<span class="badge bg-primary">' +
                                  data +
                                  "</span>";
                    }
                    return data;
                },
            },
            {
                data: null,
                className: "text-center",
                orderable: false,
                searchable: false,
                render: function (data, type, row) {
                    if (row.status === "Selesai") {
                        return `
                            <span class="badge bg-label-success">
                                Selesai
                            </span>
                        `;
                    }

                    if (row.status === "Dipanggil") {
                        return `
                             <a
                                href="/pemeriksaan?pendaftaran_id=#"
                                class="btn btn-sm btn-primary btn-mulai-pemeriksaan">
                                <i class="ti ti-stethoscope me-1"></i>
                                Mulai Pemeriksaan
                            </a>
                        `;
                    }

                    return `
                        <button
                            type="button"
                            class="btn btn-sm btn-info btn-panggil"
                            data-id="${row.id}">
                            <i class="ti ti-volume me-1"></i>
                            Panggil
                        </button>
                    `;
                },
            },
        ],

        order: [],
        displayLength: 5,
        lengthMenu: [5, 10, 25, 50, 75, 100],
    });
});

$(document).on("click", ".btn-panggil", function () {
    const id = $(this).data("id");

    Swal.fire({
        title: "Panggil pasien?",
        text: "Status antrean akan diubah menjadi Dipanggil.",
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Ya, Panggil",
        cancelButtonText: "Batal",
    }).then((result) => {
        if (result.isConfirmed) {
            updateStatusAntrean(id, "Dipanggil");
        }
    });
});

$(document).on("click", ".btn-mulai-pemeriksaan", function () {
    const id = $(this).data("id");

    window.location.href = `/pemeriksaan/create?pendaftaran_id=${id}`;
});

function updateStatusAntrean(id, status) {
    $.ajax({
        url: `/antrean-pemeriksaan/${id}/status`,
        type: "PATCH",
        data: {
            status: status,
            _token: $('meta[name="csrf-token"]').attr("content"),
        },
        success: function (response) {
            Swal.fire("Berhasil", response.message, "success");
            $("#antreanTable").DataTable().ajax.reload(null, false);
        },
        error: function (xhr) {
            Swal.fire(
                "Gagal",
                xhr.responseJSON?.message || "Status antrean gagal diperbarui.",
                "error",
            );
        },
    });
}
