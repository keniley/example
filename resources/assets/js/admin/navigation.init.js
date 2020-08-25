function navigationInit()
{
    // default class
    $( document ).ready(function() {

        if( !$('body').hasClass('navigation-full') && !$('body').hasClass('navigation-small') ) {
            $('body').addClass('navigation-full');
            Cookies.set('admin-navigation', 'navigation-full');
        }
        
    }); 

    // respo hamburger click
    $(document).on("click","#hamburger",function() {
        $('body').toggleClass('navigation-open');
    });

    $(window).on("resize",function() {
        if($(document).width() < 801) {
            if( $('body').hasClass('navigation-small') ) {
                $(".menu-item").each(function() {
                    if( $(this).find('.menu-subitem').length > 0 ) {
                        $(this).find('.text-label').detach().appendTo( $(this).find('.menu-collapse') );
                    }
                });
                $('body').toggleClass('navigation-full navigation-small');
            }
        }
    });

    $(document).on("click","#menu-toggler",function() {

        if( $('body').hasClass('navigation-full') ) {
            $(".menu-item").each(function() {
                if( $(this).find('.menu-subitem').length > 0 ) {
                    $(this).find('.text-label').detach().prependTo( $(this).find('.menu-subitem > ul') );    
                }
            });
            $('.menu-subitem').removeClass('show');
            $('.menu-item').removeClass('show');
        }

        if( $('body').hasClass('navigation-small') ) {
            $(".menu-item").each(function() {
                if( $(this).find('.menu-subitem').length > 0 ) {
                    $(this).find('.text-label').detach().appendTo( $(this).find('.menu-collapse') );
                }
                if($(this).hasClass('active')) {
                    $(this).addClass('show');
                    $(this).find('.menu-subitem').addClass('show');
                }
            });
        }

        $('body').toggleClass('navigation-full navigation-small');
        
        if( $('body').hasClass('navigation-full') ) {
            Cookies.set('admin-navigation', 'navigation-full');
        }
        if( $('body').hasClass('navigation-small') ) {
            Cookies.set('admin-navigation', 'navigation-small');
        }
    });

    $(document).on("click",".navigation-full .menu-item", function() {
        $(this).find(".menu-subitem").collapse('show');           
    });

    $(document).on("click",".navigation-full .menu-item .menu-collapse", function() {
        $(this).closest(".menu-item").find(".menu-subitem").collapse('hide');       
    });

    $(document).on('hide.bs.collapse',".menu-subitem", function () {
        $(this).closest(".menu-item").removeClass('show');
    });

    $(document).on('show.bs.collapse',".menu-subitem", function () {
        $('.menu-subitem').collapse('hide');
        $(this).closest(".menu-item").addClass('show');
    });

    $(document).on('click',".panel-toggler", function () {
        $(this).closest('.panel').toggleClass('closed');
    });
}

navigationInit();