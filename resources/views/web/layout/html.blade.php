@inject('office', 'App\Service\OfficeService')
@php 
    $office = $office->getDefault();
@endphp

<!DOCTYPE html>
<html lang="cs">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('seo_title')</title>
        <meta name="description" content="@yield('seo_description')"/>

        <link rel="stylesheet" href="/dist/web/css/vendor.css">
        <link rel="stylesheet" href="/dist/web/css/web.css">
        @include('web.component.gtm')
        @yield('css')
    </head>
    <body class="bg-light d-flex min-vh-100 mh-100">
        
        @include('web.layout.respomenu')

        <div id="page" class="d-flex flex-column min-vh-100 mh-100">
            @include('web.layout.topnav')

            @include('web.layout.header')

            <div id="content" class="flex-grow-1">
                @yield('body')
            </div>

            @include('web.layout.footer')
            @include('web.layout.modal')
        </div>

        <script src="/dist/web/js/vendor.js"></script>
        <script src="/dist/web/js/app.js"></script>

        @yield('javascript')

        <script>
            $(document).on('submit', '.modal-body .ajaxform', function(event) {
                event.preventDefault();
                var element = $(this);

                element.find('.invalid-feedback').detach();
                element.find('.is-invalid').removeClass('is-invalid');
                $.ajax({
                    type: element.attr('method'),
                    url: element.attr('action'),
                    data: element.serialize(),
                    dataType: "json",
                    error: 
                    function(result, status, xhr) {
                        element.find('.clear').val(''); 

                        if(result.status === 422) {
                            $.each(result.responseJSON.errors, function(index, value) {
                                let el = element.find('*[name='+index+']');
                                $.each(el, function(index, object) {
                                    switch($(object).attr('type')) {
                                        case 'hidden':
                                        break;
                                        case 'checkbox':
                                            let formgroup = $(object).parents('.form-group');
                                            $( '<div class="invalid-feedback mb-3">'+ value.join('<br>') +'</div>' ).insertAfter(formgroup);
                                            formgroup.addClass('is-invalid');
                                        break;
                                        default:
                                            $( '<div class="invalid-feedback">'+ value.join('<br>') +'</div>' ).insertAfter($(object));
                                            $(object).addClass('is-invalid'); 
                                    } 
                                })                               
                            });

                            return;
                        }

                        $('.modal-body').prepend('<div class="alert alert-danger text-center" role="alert">Omlouváme se, ale formulář se nepodařilo uložit.</div>'); 
                    },
                    success: 
                    function(result, status, xhr) {
                        $('.modal-body').html(
                            `<div class="d-flex h-100 flex-column mb-3">
                                <div class="text-center my-3"><i class="fas fa-check text-success" style="font-size: 4rem"></i></div>
                                <div class="my-3 text-center">Formulář byl úspěšně odeslán. Pro jistotu jsme jeho kopii poslali na váš email.</div>
                                <div class="my-3 text-center">Budeme vás co nejdříve kontaktovat.</div>
                                <div class="my-3 text-center">Děkujeme</div>
                            </div>`
                        );
                    }
                })
            })
        </script>
    </body>
</html>