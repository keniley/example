@php 
$_leftmenu = [5, 11];
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
        <li class="breadcrumb-item"><a href="/admin/office">Seznam poboček</a></li>
        <li class="breadcrumb-item active" aria-current="page">@if($office !== null){{ $office->title }}@else Neznámá pobočka @endif</li>
      </ol>
    </nav>
@endsection

@section ('content')
    @if($office === null) 
        <h1 class="text-gray-600 text-center pt-5 mt-5">Požadovaný záznam s ID "{{ $id }}" nebyl nalezen!</h1>
        <div class="text-center"><a href="/admin/office">zpět na výpis</a></div>
    @else
        <form method="POST" action="/admin/office/{{ $office->id }}" class="ajaxform" id="form1">
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
                                  {{ $office->id }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Vytvořeno</label>
                                <div class="col-sm-9 col-form-label-sm">
                                  {{ $office->created_at->format('d.m.Y H:i:s') }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Změněno</label>
                                <div class="col-sm-9 col-form-label-sm">
                                  {{ $office->updated_at->format('d.m.Y H:i:s') }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Aktivní</label>
                                <div class="col-sm-9 col-form-label-sm">
                                    <label class="switch">
                                        <input type="hidden" name="active" value="0">
                                        <input type="checkbox" name="active" value="1" @if($office->active) checked="checked" @endif>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Výchozí pro web</label>
                                <div class="col-sm-9 col-form-label-sm">
                                    <label class="switch">
                                        <input type="hidden" name="default" value="0">
                                        <input type="checkbox" name="default" value="1" @if($office->default) checked="checked" @endif>
                                        <span class="checkmark"></span>
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-6">
                    <div class="panel bg-white p-4 mb-4">
                        <div class="panel-header border-0 mb-3 pb-3 d-flex justify-content-between">
                            <h2 class="p-0 m-0">Adresa<small class="d-inline-block ml-2"></small></h2>
                            <div>
                                <button data-toggle="modal" data-target="#modal-right" data-content="/admin/help/3" type="button" class="btn btn-default btn-sm btn-circle materialize waves-circle-light"><i class="icon fas fa-question"></i></button>
                            </div>
                        </div>
                        <div class="panel-content">
                            <div class="form-group row">
                                <label for="title" class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Název</label>
                                <div class="col-sm-9">
                                  <input name="title" class="form-control form-control-sm" id="title" value="{{ $office->title }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="street" class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Ulice</label>
                                <div class="col-sm-9">
                                  <input name="street" class="form-control form-control-sm" id="street" value="{{ $office->street }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="city" class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Město</label>
                                <div class="col-sm-9">
                                  <input name="city" class="form-control form-control-sm" id="city" value="{{ $office->city }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="zip" class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">PSČ</label>
                                <div class="col-sm-9">
                                  <input name="zip" class="form-control form-control-sm" id="zip" value="{{ $office->zip }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="map" class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Mapa</label>
                                <div class="col-sm-9">
                                  <input name="map" class="form-control form-control-sm" id="map" value="{{ $office->map }}">
                                </div>
                            </div>

                             <div class="form-group row">
                                <label for="phone" class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Telefon</label>
                                <div class="col-sm-9">
                                  <input name="phone" class="form-control form-control-sm" id="phone" value="{{ $office->phone }}">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Email</label>
                                <div class="col-sm-9">
                                  <input name="email" class="form-control form-control-sm" id="email" value="{{ $office->email }}">
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

