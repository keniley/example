$('.modal').on('show.bs.modal', function (event) {
    loadModal($(this), event, null);
});

$('.modal').on('hide.bs.modal', function (event) {
    loadModal($(this), event, '');
});

function loadModal(object, event, content = null)
{
    if(content !== null) {
        object.find('.modal-content').html(content);
        return;
    }

    $.ajax({
        type: 'GET',
        url: $(event.relatedTarget).attr('data-content'),
        data: null,
        dataType: "html",
        beforeSend: function() {
            object.find('.modal-content').html('<div class="d-flex justify-content-center align-items-center m-4"><div class="spinner-border text-primary spinner-size-xl spinner-thin" role="status"><span class="sr-only">Loading...</span></div></div>');
        },
        error: 
        function(result, status, xhr) {
            console.log(result);
            if(result.status === 401) {
                window.location.href = "/admin";
                return;
            }
            
            toastr["error"]("Ajax error: " + result.statusText);
            object.find('.modal-content').html('');
        },
        success: 
        function(result, status, xhr) {
            object.find('.modal-content').html(result);
        }
    })
}