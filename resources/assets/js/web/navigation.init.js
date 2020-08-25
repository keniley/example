function navigationInit()
{
    // respo hamburger click
    $(document).on("click","#hamburger",function() {
        $('body').toggleClass('navigation-open');
    });

    $(document).on("click","#menu .menu-item", function() {
        $(this).find(".menu-subitem").collapse('toggle');           
    });
}

navigationInit();