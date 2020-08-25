@php 
$_leftmenu = [5, 9];
@endphp

@extends ('admin.layout.html')

@section ('javascript')
    <script>
        $('.ajaxform').ajaxform({
            onSuccess: function() { location.reload(); }, 
            onError: function() { toastr["error"]('Formulář se nepodařilo uložit'); }
        });
    </script>
@endsection

@section ('css')

@endsection

@section ('breadcrumb')
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb justify-content-center bg-transparent">
        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Nastavení</li>
      </ol>
    </nav>
@endsection

@section ('content')
    <form method="POST" action="/admin/settings" class="ajaxform" id="form1">
        @csrf
        <div class="row">
            <div class="col-12 col-lg-4">
                <div class="panel bg-white p-4 mb-4">
                    <div class="panel-header border-0 mb-3 pb-3 d-flex justify-content-between">
                        <h2 class="p-0 m-0"><small class="d-inline-block ml-0">Google Tag Manager</small></h2>
                        <div>
                            <button data-toggle="modal" data-target="#modal-right" data-content="/admin/help/3" type="button" class="btn btn-default btn-sm btn-circle materialize waves-circle-light"><i class="icon fas fa-question"></i></button>
                        </div>
                    </div>
                    <div class="panel-content">

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Kód</label>
                            <div class="col-sm-9 col-form-label-sm">
                                <input name="options[gtm]" class="form-control form-control-sm" id="gtm" value="{{ config('options.gtm') }}">
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
       
        <div class="row">
            <div class="col-12">
                <button class="btn btn-success materialize">Uložit</button>  
            </div>
        </div>
    </form>
@endsection

