@php 
$_leftmenu = [0,0];
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
        <li class="breadcrumb-item active" aria-current="page">Můj účet</li>
      </ol>
    </nav>
@endsection

@section ('content')
    <form method="POST" action="/admin/me" class="ajaxform" id="form1">
            @csrf
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="panel bg-white p-4 mb-4">
                        <div class="panel-header border-0 mb-3 pb-3 d-flex justify-content-between">
                            <h2 class="p-0 m-0">Můj účet<small class="d-inline-block ml-2"></small></h2>
                            <div>
                                <button data-toggle="modal" data-target="#modal-right" data-content="/admin/help/3" type="button" class="btn btn-default btn-sm btn-circle materialize waves-circle-light"><i class="icon fas fa-question"></i></button>
                            </div>
                        </div>
                        <div class="panel-content">
                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Id</label>
                                <div class="col-sm-9 col-form-label-sm">
                                  {{ $admin->id }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Vytvořeno</label>
                                <div class="col-sm-9 col-form-label-sm">
                                  {{ $admin->created_at->format('d.m.Y H:i:s') }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Změněno</label>
                                <div class="col-sm-9 col-form-label-sm">
                                  {{ $admin->updated_at->format('d.m.Y H:i:s') }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Jméno</label>
                                <div class="col-sm-9 col-form-label-sm">
                                    <input name="name" class="form-control form-control-sm" id="name" value="{{ $admin->name }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Email</label>
                                <div class="col-sm-9 col-form-label-sm">
                                    <input name="email" class="form-control form-control-sm" id="email" value="{{ $admin->email }}" disabled>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="panel bg-white p-4 mb-4">
                        <div class="panel-header border-0 mb-3 pb-3 d-flex justify-content-between">
                            <h2 class="p-0 m-0">Změna hesla<small class="d-inline-block ml-2"></small></h2>
                            <div>
                                <button data-toggle="modal" data-target="#modal-right" data-content="/admin/help/3" type="button" class="btn btn-default btn-sm btn-circle materialize waves-circle-light"><i class="icon fas fa-question"></i></button>
                            </div>
                        </div>
                        <div class="panel-content">
                            <div class="form-group row">
                                <label for="password" class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Nové heslo</label>
                                <div class="col-sm-9">
                                  <input type="password" name="password" class="form-control form-control-sm" id="password" value="">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password2" class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Kontrola nového hesla</label>
                                <div class="col-sm-9">
                                  <input name="password2" type="password" class="form-control form-control-sm" id="password2" value="">
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