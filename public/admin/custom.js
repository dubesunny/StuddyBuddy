$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Response Message
alertify.set('notifier', 'closeButton', true);
alertify.set('notifier', 'position', 'top-right');
function showMessage(type, message) {
    alertify.notify(message, type, 5);
}

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
function refreshTable(){
     $('.dataTable').DataTable().ajax.reload(); 
}