"use strict";

let fv, modal;

document.addEventListener("DOMContentLoaded", function (e) {
    (function () {
        const formAddNewRecord = document.getElementById("formPasien");

        setTimeout(() => {
            $(document).on("click", ".create-new", function () {
                const modalElement = document.getElementById("modalPasien");

                $("#barangId").val("");

                modalElement.querySelector(".no_rm").value = "";
                modalElement.querySelector(".nama_lengkap").value = "";
                modalElement.querySelector(".tanggal_lahir").value = "";
                modalElement.querySelector(".gender").value = "";
                modalElement.querySelector(".usia").value = "";
                modalElement.querySelector(".no_hp").value = "";
                modalElement.querySelector(".alamat").value = "";
                modalElement.querySelector(".jenis_pasien").value = "";

                fv.resetForm(true);
                $("#formPasien .is-invalid").removeClass("is-invalid");
                $("#formPasien .invalid-feedback").empty();
                bootstrap.Modal.getOrCreateInstance(modalElement).show();
            });
        }, 200);

        // Form validation for Add new record
        fv = FormValidation.formValidation(formAddNewRecord, {
            fields: {
                no_rm: {
                    validators: {
                        notEmpty: {
                            message: "No. RM Wajib Diisi",
                        },
                    },
                },
                nama_lengkap: {
                    validators: {
                        notEmpty: {
                            message: "Nama Lengkap Wajib Diisi",
                        },
                    },
                },
                tanggal_lahir: {
                    validators: {
                        notEmpty: {
                            message: "Tanggal Lahir Wajib Diisi",
                        },
                    },
                },
                gender: {
                    validators: {
                        notEmpty: {
                            message: "Jenis Kelamin Wajib Diisi",
                        },
                    },
                },
                usia: {
                    validators: {
                        notEmpty: {
                            message: "Usia Wajib Diisi",
                        },
                    },
                },
                no_hp: {
                    validators: {
                        notEmpty: {
                            message: "No. Hp Wajib Diisi",
                        },
                    },
                },
                alamat: {
                    validators: {
                        notEmpty: {
                            message: "Alamat Wajib Diisi",
                        },
                    },
                },
                jenis_pasien: {
                    validators: {
                        notEmpty: {
                            message: "Jenis Pasien Wajib Diisi",
                        },
                    },
                },
            },
            plugins: {
                trigger: new FormValidation.plugins.Trigger(),
                bootstrap5: new FormValidation.plugins.Bootstrap5({
                    // Use this for enabling/changing valid/invalid class
                    // eleInvalidClass: '',
                    eleValidClass: "",
                    rowSelector: ".col-12",
                }),
                submitButton: new FormValidation.plugins.SubmitButton(),
                // defaultSubmit: new FormValidation.plugins.DefaultSubmit(),
                autoFocus: new FormValidation.plugins.AutoFocus(),
            },
            init: (instance) => {
                instance.on("plugins.message.placed", function (e) {
                    if (
                        e.element.parentElement.classList.contains(
                            "input-group",
                        )
                    ) {
                        e.element.parentElement.insertAdjacentElement(
                            "afterend",
                            e.messageElement,
                        );
                    }
                });
            },
        });

        // FlatPickr Initialization & Validation
        const flatpickrDate = document.querySelector('[name="basicDate"]');

        if (flatpickrDate) {
            flatpickrDate.flatpickr({
                enableTime: false,
                // See https://flatpickr.js.org/formatting/
                dateFormat: "m/d/Y",
                // After selecting a date, we need to revalidate the field
                onChange: function () {
                    fv.revalidateField("basicDate");
                },
            });
        }
    })();
});

// datatable (jquery)
$(function () {
    var dt_basic_table = $("#pasienTable"),
        dt_basic;
    var url = $("#pasienTable").data("pasien");

    if (dt_basic_table.length) {
        dt_basic = dt_basic_table.DataTable({
            ajax: url,
            // data: dataDummyBarang,
            columns: [
                {
                    data: null,
                    defaultContent: "",
                    className: "control",
                    orderable: false,
                    searchable: false,
                },
                { data: "" },
                {
                    data: null,
                    render: (data, type, row, meta) => meta.row + 1,
                    className: "text-center",
                },
                {
                    data: "no_rm",
                    className: "text-center",
                },
                {
                    data: "nama_lengkap",
                    className: "text-center",
                },
                {
                    data: "tanggal_lahir",
                    className: "text-center",
                },
                {
                    data: "gender",
                    className: "text-center",
                    render: function (data) {
                        if (data === "L") {
                            return "Laki-laki";
                        } else if (data === "P") {
                            return "Perempuan";
                        }
                        return data ?? "-";
                    },
                },
                {
                    data: "usia",
                    className: "text-center",
                },
                {
                    data: "no_hp",
                    className: "text-center",
                },
                {
                    data: "alamat",
                    className: "text-center",
                },
                { data: "" },
            ],
            columnDefs: [
                {
                    // For Responsive
                    data: null,
                    defaultContent: "",
                    className: "control",
                    orderable: false,
                    searchable: false,
                    responsivePriority: 2,
                    targets: 0,
                    render: function (data, type, full, meta) {
                        return "";
                    },
                },
                {
                    // For Checkboxes
                    data: null,
                    defaultContent: "",
                    targets: 1,
                    orderable: false,
                    searchable: false,
                    responsivePriority: 3,
                    checkboxes: true,
                    render: function () {
                        return '<input type="checkbox" class="dt-checkboxes form-check-input">';
                    },
                    checkboxes: {
                        selectAllRender:
                            '<input type="checkbox" class="form-check-input">',
                    },
                },
                {
                    targets: -1,
                    data: null,
                    className: "text-center",
                    orderable: false,
                    searchable: false,
                    render: function (data, type, row) {
                        return `
                <div class="d-inline-flex gap-1">
                    <button type="button"
                        class="btn btn-sm btn-icon btn-text-secondary waves-effect"
                        title="Edit"
                        data-id="${row.id}">
                        <i class="ti ti-edit"></i>
                    </button>

                    <button type="button"
                        class="btn btn-sm btn-icon btn-text-danger waves-effect"
                        title="Hapus"
                        data-id="${row.id}">
                        <i class="ti ti-trash"></i>
                    </button>
                </div>
            `;
                    },
                },
            ],
            order: [[2, "asc"]],
            dom: '<"card-header flex-column flex-md-row"<"head-label text-center"><"dt-action-buttons text-end pt-6 pt-md-0"B>><"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6 d-flex justify-content-center justify-content-md-end mt-n6 mt-md-0"f>>t<"row"<"col-sm-12 col-md-6"i><"col-sm-12 col-md-6"p>>',
            displayLength: 5,
            lengthMenu: [5, 10, 25, 50, 75, 100],
            language: {
                paginate: {
                    next: '<i class="ti ti-chevron-right ti-sm"></i>',
                    previous: '<i class="ti ti-chevron-left ti-sm"></i>',
                },
                zeroRecords: "Tidak ada data pasien ✨",
            },
            buttons: [
                {
                    extend: "collection",
                    className:
                        "btn btn-label-success dropdown-toggle me-4 waves-effect waves-light border-none",
                    text: '<i class="ti ti-file-export ti-xs me-sm-1"></i> <span class="d-none d-sm-inline-block">Export</span>',
                    buttons: [
                        {
                            extend: "print",
                            text: '<i class="ti ti-printer me-1" ></i>Print',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [3, 4, 5, 6, 7],
                                // prevent avatar to be display
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = "";
                                        $.each(el, function (index, item) {
                                            if (
                                                item.classList !== undefined &&
                                                item.classList.contains(
                                                    "user-name",
                                                )
                                            ) {
                                                result =
                                                    result +
                                                    item.lastChild.firstChild
                                                        .textContent;
                                            } else if (
                                                item.innerText === undefined
                                            ) {
                                                result =
                                                    result + item.textContent;
                                            } else
                                                result =
                                                    result + item.innerText;
                                        });
                                        return result;
                                    },
                                },
                            },
                            customize: function (win) {
                                //customize print view for dark
                                $(win.document.body)
                                    .css("color", config.colors.headingColor)
                                    .css(
                                        "border-color",
                                        config.colors.borderColor,
                                    )
                                    .css(
                                        "background-color",
                                        config.colors.bodyBg,
                                    );
                                $(win.document.body)
                                    .find("table")
                                    .addClass("compact")
                                    .css("color", "inherit")
                                    .css("border-color", "inherit")
                                    .css("background-color", "inherit");
                            },
                        },
                        {
                            extend: "csv",
                            text: '<i class="ti ti-file-text me-1" ></i>Csv',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [3, 4, 5, 6, 7],
                                // prevent avatar to be display
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = "";
                                        $.each(el, function (index, item) {
                                            if (
                                                item.classList !== undefined &&
                                                item.classList.contains(
                                                    "user-name",
                                                )
                                            ) {
                                                result =
                                                    result +
                                                    item.lastChild.firstChild
                                                        .textContent;
                                            } else if (
                                                item.innerText === undefined
                                            ) {
                                                result =
                                                    result + item.textContent;
                                            } else
                                                result =
                                                    result + item.innerText;
                                        });
                                        return result;
                                    },
                                },
                            },
                        },
                        {
                            extend: "excel",
                            text: '<i class="ti ti-file-spreadsheet me-1"></i>Excel',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [3, 4, 5, 6, 7],
                                // prevent avatar to be display
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = "";
                                        $.each(el, function (index, item) {
                                            if (
                                                item.classList !== undefined &&
                                                item.classList.contains(
                                                    "user-name",
                                                )
                                            ) {
                                                result =
                                                    result +
                                                    item.lastChild.firstChild
                                                        .textContent;
                                            } else if (
                                                item.innerText === undefined
                                            ) {
                                                result =
                                                    result + item.textContent;
                                            } else
                                                result =
                                                    result + item.innerText;
                                        });
                                        return result;
                                    },
                                },
                            },
                        },
                        {
                            extend: "pdf",
                            text: '<i class="ti ti-file-description me-1"></i>Pdf',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [3, 4, 5, 6, 7],
                                // prevent avatar to be display
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = "";
                                        $.each(el, function (index, item) {
                                            if (
                                                item.classList !== undefined &&
                                                item.classList.contains(
                                                    "user-name",
                                                )
                                            ) {
                                                result =
                                                    result +
                                                    item.lastChild.firstChild
                                                        .textContent;
                                            } else if (
                                                item.innerText === undefined
                                            ) {
                                                result =
                                                    result + item.textContent;
                                            } else
                                                result =
                                                    result + item.innerText;
                                        });
                                        return result;
                                    },
                                },
                            },
                        },
                        {
                            extend: "copy",
                            text: '<i class="ti ti-copy me-1" ></i>Copy',
                            className: "dropdown-item",
                            exportOptions: {
                                columns: [3, 4, 5, 6, 7],
                                // prevent avatar to be display
                                format: {
                                    body: function (inner, coldex, rowdex) {
                                        if (inner.length <= 0) return inner;
                                        var el = $.parseHTML(inner);
                                        var result = "";
                                        $.each(el, function (index, item) {
                                            if (
                                                item.classList !== undefined &&
                                                item.classList.contains(
                                                    "user-name",
                                                )
                                            ) {
                                                result =
                                                    result +
                                                    item.lastChild.firstChild
                                                        .textContent;
                                            } else if (
                                                item.innerText === undefined
                                            ) {
                                                result =
                                                    result + item.textContent;
                                            } else
                                                result =
                                                    result + item.innerText;
                                        });
                                        return result;
                                    },
                                },
                            },
                        },
                    ],
                },
                {
                    text: '<i class="ti ti-plus me-sm-1"></i> <span class="d-none d-sm-inline-block">Tambah Data Pasien</span>',
                    className:
                        "create-new btn btn-success waves-effect waves-light",
                },
            ],
            responsive: {
                details: {
                    display: $.fn.dataTable.Responsive.display.modal({
                        header: function (row) {
                            var data = row.data();
                            return "Details of " + data["nama_lengkap"];
                        },
                    }),
                    type: "column",
                    renderer: function (api, rowIdx, columns) {
                        var data = $.map(columns, function (col, i) {
                            return col.title !== "" // ? Do not show row in modal popup if title is blank (for check box)
                                ? '<tr data-dt-row="' +
                                      col.rowIndex +
                                      '" data-dt-column="' +
                                      col.columnIndex +
                                      '">' +
                                      "<td>" +
                                      col.title +
                                      ":" +
                                      "</td> " +
                                      "<td>" +
                                      col.data +
                                      "</td>" +
                                      "</tr>"
                                : "";
                        }).join("");

                        return data
                            ? $('<table class="table"/><tbody />').append(data)
                            : false;
                    },
                },
            },
            initComplete: function (settings, json) {
                $(".card-header").after('<hr class="my-0">');
            },
        });
        $("div.head-label").html(
            '<h5 class="card-title mb-0">DataTable with Buttons</h5>',
        );
    }

    $(document).on("click", ".btn-edit", function () {
        let id = $(this).data("id");
        let row = dt_basic.row($(this).closest("tr")).data();

        $("#kategoriId").val(id);
        $(".add-new-record .nama").val(row.nama);
    });

    fv.on("core.form.valid", function () {
        let id = $("#pasienId").val();
        let formElement = document.getElementById("formPasien");
        let formData = new FormData(formElement);
        let ajaxUrl = id ? `/pasien/${id}` : "/pasien";

        if (id) {
            formData.append("_method", "PUT");
        }

        $.ajax({
            url: ajaxUrl,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            success: function (response) {
                dt_basic.ajax.reload(null, false);
                bootstrap.Modal.getInstance(
                    document.getElementById("modalPasien"),
                ).hide();
                $("#formPasien").trigger("reset");
            },
            error: function (xhr) {
                if (xhr.status === 422) {
                    const errors = xhr.responseJSON.errors;

                    $(".invalid-feedback").text("");
                    $(".form-control").removeClass("is-invalid");

                    $.each(errors, function (field, messages) {
                        const input = $(`[name="${field}"]`);
                        const errorElement = $(`#error-${field}`);

                        input.addClass("is-invalid");
                        errorElement.text(messages[0]);
                    });
                } else {
                    console.error(xhr.responseJSON);
                }
            },
        });
    });

    // Filter form control to default size
    // ? setTimeout used for multilingual table initialization
    setTimeout(() => {
        $(".dataTables_filter .form-control").removeClass("form-control-sm");
        $(".dataTables_length .form-select").removeClass("form-select-sm");
    }, 300);
});
