@php 
$_leftmenu = [5, 7];
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
        <li class="breadcrumb-item"><a href="/admin/admins">Seznam administrátorů</a></li>
        <li class="breadcrumb-item active" aria-current="page">@if($admin !== null){{ $admin->name }}@else Neznámý administrátor @endif</li>
      </ol>
    </nav>
@endsection

@section ('content')
    @if($admin === null) 
        <h1 class="text-gray-600 text-center pt-5 mt-5">Požadovaný záznam s ID "{{ $id }}" nebyl nalezen!</h1>
        <div class="text-center"><a href="/admin/admins">zpět na výpis</a></div>
    @else
        <form method="POST" action="/admin/admins/{{ $admin->id }}" class="ajaxform" id="form1">
            @csrf
            <div class="row">
                <div class="col-12 col-lg-6">
                    <div class="panel bg-white p-4 mb-4">
                        <div class="panel-header border-0 mb-3 pb-3 d-flex justify-content-between">
                            <h2 class="p-0 m-0">Základní údaje<small class="d-inline-block ml-2"></small></h2>
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
                                <label class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Aktivní</label>
                                <div class="col-sm-9 col-form-label-sm">
                                    <label class="switch">
                                        <input type="hidden" name="active" value="0">
                                        <input type="checkbox" name="active" value="1" @if($admin->active) checked="checked" @endif>
                                        <span class="checkmark"></span>
                                    </label>
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
    @endif
@endsection

