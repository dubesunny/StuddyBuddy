$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Open Canvas
function showCanvas(title, body) {
    $('.offcanvas-title').text(title);
    $('.offcanvas-body').html(body);
}

// Hide Canvas
function closeCanvas() {
    let canvasEl = document.querySelector('.offcanvas.show');
    if (canvasEl) {
        let bsCanvas = bootstrap.Offcanvas.getInstance(canvasEl);
        if (bsCanvas) {
            bsCanvas.hide();
        }
    }
}


// Refresh Table
function refreshTable() {
    $('.dataTable').DataTable().ajax.reload();
}

$(document).on('hidden.bs.offcanvas', function () {
    $('.offcanvas-backdrop').remove();
    $('body')
        .removeClass('offcanvas-backdrop show')
        .css('overflow', '');
});
/**
 * Toastr Helper (Default Toastr Features Only)
 * @param {Object} options
 */
function showToast(options = {}) {
    const {
        type = 'success',   
        title = '',
        message = '',
        timeOut = 3000,
        position = 'toast-top-right',
        closeButton = true,
        progressBar = true
    } = options;

    if (!toastr[type]) {
        console.warn('Invalid toastr type:', type);
        return;
    }

    toastr.options = {
        closeButton: closeButton,
        progressBar: progressBar,
        positionClass: position,
        timeOut: timeOut,
        extendedTimeOut: 1000,
        showDuration: 300,
        hideDuration: 300,
        newestOnTop: true,
        preventDuplicates: true
    };

    toastr[type](message, title);
}

window.Parsley.on('field:init', function () {
    const fieldName = this.$element.attr('name');

    if (fieldName) {
        const cleanName = fieldName.replace(/\./g, '');
        this.options.errorsContainer = function () {
            return $('#err-' + cleanName);
        };
    }
});

const swalConfirm = (swalOption, confirmedCallback) => {
    Swal.fire({
        title: swalOption.title ?? "Are you sure?",
        text: swalOption.text ?? "You won't be able to revert this!",
        icon: swalOption.icon ?? "warning",
        cancelButtonText: swalOption.cancelButtonText ?? "Cancel",
        showCancelButton: swalOption.showCancelButton ?? true,
        confirmButtonColor: swalOption.confirmButtonColor ?? "#5951ed",
        cancelButtonColor: swalOption.cancelButtonColor ?? "#fa6a55",
        confirmButtonText: swalOption.confirmButtonText ?? "Yes, approve it!",
    }).then((result) => {
        if (result.isConfirmed) {
            confirmedCallback();
        }
    });
};


$(document).ready(function () {
    $(".datatable-filter").on("change", function () {
        const table = $("#data-table");
        table.on("preXhr.dt", function (e, settings, data) {
            $(".datatable-filter").each(function (index, item) {
                if ($(this).attr("name") && $(this).attr("name") != "") {
                    let name = $(this).attr("name");
                    data[name] = $(this).val();
                }
            });
        });
        table.DataTable().ajax.reload();
        $("#clear").removeClass("d-none");
    });
});

$(document).on('click', '#clear', function () {
    const table = $("#data-table");
    table.on("preXhr.dt", function (e, settings, data) {
        $(".datatable-filter").each(function (index, item) {
            if ($(this).attr("name") && $(this).attr("name") != "") {
                let name = $(this).attr("name");
                data[name] = null;
            }
        });
    });
    $(".datatable-filter").val(null).trigger("change");
    table.DataTable().ajax.reload();
    $(this).addClass("d-none");
})
