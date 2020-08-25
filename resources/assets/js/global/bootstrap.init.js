function tooltipInit() {
    $(function () {
        $('.has-tooltip').tooltip({
            html:true
        })
    })
}

function dropdownInit() {
    $('.dropdown').on('show.bs.dropdown', function () {
        $(this).find('.dropdown-menu').toggleClass('fadeIn');
    })
    $('.dropdown').on('hide.bs.dropdown', function () {
        $(this).find('.dropdown-menu').toggleClass('fadeIn');
    })
}

function buttonInit() {
$(document).on("click",".btn",function() {
    $(this).removeClass(['animated', 'pulse']);
    $(this).addClass(['animated', 'pulse']);
    setTimeout(function(btn) {
        btn.removeClass(['animated', 'pulse']);
    }, 1000, $(this));
});
}

tooltipInit();
dropdownInit();
buttonInit();

