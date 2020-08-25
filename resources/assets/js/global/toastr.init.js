function toastrInit() 
{
    toastr.options = {
        "closeButton": false,
        "debug": false,
        "newestOnTop": true,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "300",
        "hideDuration": "1000",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut",
        "escapeHtml": "true"
    };

    let message = {
        type: null,
        message: null
    };

    message.type = localStorage.getItem('toastr-type');
    message.message = localStorage.getItem('toastr-message');

    if(message.type !== null && message.message !== null) {
        toastr[message.type](message.message);
        localStorage.removeItem("toastr-type");
        localStorage.removeItem("toastr-message");
    }
}

toastrInit();
