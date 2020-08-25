$(document).ready(function() {
    if($("#login").length) {
        $("#login input[name=username]").val('').focus();    
    }
});

$(document).on("submit", "#login", function(event) {
    event.preventDefault();
    $.ajax({
        type: 'POST',
        url: $(this).attr('action'),
        data: $(this).serialize(),
        dataType: "json",
        error: 
        function(result, status, xhr) {
            toastr["error"]("Špatné přihlašovací údaje");
            $("#login input[name=username]").val('').focus();
            $("#login input[name=password]").val('');
        },
        success: 
        function(result, status, xhr) {
            if(result.system.code === 200) {
                window.location.href = "/admin";
            }
        }
    })
});