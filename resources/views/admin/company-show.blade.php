@php 
$_leftmenu = [5, 6];
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
        <li class="breadcrumb-item active" aria-current="page">Detail firmy</li>
      </ol>
    </nav>
@endsection

@section ('content')
    <form method="POST" action="/admin/company" class="ajaxform" id="form1">
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
                              {{ $company->id }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Vytvořeno</label>
                            <div class="col-sm-9 col-form-label-sm">
                              {{ $company->created_at->format('d.m.Y H:i:s') }}
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Změněno</label>
                            <div class="col-sm-9 col-form-label-sm">
                              {{ $company->updated_at->format('d.m.Y H:i:s') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="panel bg-white p-4 mb-4">
                    <div class="panel-header border-0 mb-3 pb-3 d-flex justify-content-between">
                        <h2 class="p-0 m-0">Kontakty<small class="d-inline-block ml-2"></small></h2>
                        <div>
                            <button data-toggle="modal" data-target="#modal-right" data-content="/admin/help/3" type="button" class="btn btn-default btn-sm btn-circle materialize waves-circle-light"><i class="icon fas fa-question"></i></button>
                        </div>
                    </div>
                    <div class="panel-content">
                        
                        <div class="form-group row">
                            <label for="phone" class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Telefon</label>
                            <div class="col-sm-9">
                              <input name="phone" class="form-control form-control-sm" id="phone" value="{{ $company->phone }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="email" class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Email</label>
                            <div class="col-sm-9">
                              <input name="email" class="form-control form-control-sm" id="email" value="{{ $company->email }}">
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12 col-lg-6">
                <div class="panel bg-white p-4 mb-4">
                    <div class="panel-header border-0 mb-3 pb-3 d-flex justify-content-between">
                        <h2 class="p-0 m-0">Údaje o firmě<small class="d-inline-block ml-2"></small></h2>
                        <div>
                            <button data-toggle="modal" data-target="#modal-right" data-content="/admin/help/3" type="button" class="btn btn-default btn-sm btn-circle materialize waves-circle-light"><i class="icon fas fa-question"></i></button>
                        </div>
                    </div>
                    <div class="panel-content">
                        
                        <div class="form-group row">
                            <label for="name" class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Název</label>
                            <div class="col-sm-9">
                              <input name="name" class="form-control form-control-sm" id="name" value="{{ $company->name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="street" class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Ulice</label>
                            <div class="col-sm-9">
                              <input name="street" class="form-control form-control-sm" id="street" value="{{ $company->street }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city" class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Město</label>
                            <div class="col-sm-9">
                              <input name="city" class="form-control form-control-sm" id="city" value="{{ $company->city }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="zip" class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">PSČ</label>
                            <div class="col-sm-9">
                              <input name="zip" class="form-control form-control-sm" id="zip" value="{{ $company->zip }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="number" class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">IČ</label>
                            <div class="col-sm-9">
                              <input name="number" class="form-control form-control-sm" id="number" value="{{ $company->number }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="vat" class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">DIČ</label>
                            <div class="col-sm-9">
                              <input name="vat" class="form-control form-control-sm" id="vat" value="{{ $company->vat }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="isvat" class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Plátce DPH</label>
                            <div class="col-sm-9">
                              <label class="switch">
                                    <input type="hidden" name="is_vat" value="0">
                                    <input type="checkbox" name="is_vat" value="1" @if($company->is_vat) checked="checked" @endif>
                                    <span class="checkmark"></span>
                                </label>  
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="registration" class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Obchodní rejstřík</label>
                            <div class="col-sm-9">
                              <input name="registration" class="form-control form-control-sm" id="registration" value="{{ $company->registration }}">
                            </div>
                        </div>

                    </div>
                </div>
            </div>

            <div class="col-12 col-lg-6">
                <div class="panel bg-white p-4 mb-4">
                    <div class="panel-header border-0 mb-3 pb-3 d-flex justify-content-between">
                        <h2 class="p-0 m-0">Bankovní spojení<small class="d-inline-block ml-2"></small></h2>
                        <div>
                            <button data-toggle="modal" data-target="#modal-right" data-content="/admin/help/3" type="button" class="btn btn-default btn-sm btn-circle materialize waves-circle-light"><i class="icon fas fa-question"></i></button>
                        </div>
                    </div>
                    <div class="panel-content">
                        
                         <div class="form-group row">
                            <label for="bank_name" class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Název banky</label>
                            <div class="col-sm-9">
                              <input name="bank_name" class="form-control form-control-sm" id="bank_name" value="{{ $company->bank_name }}">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="bank_number" class="col-sm-3 col-form-label col-form-label-sm font-weight-bold">Číslo účtu</label>
                            <div class="col-sm-9">
                              <input name="bank_number" class="form-control form-control-sm" id="bank_number" value="{{ $company->bank_number }}">
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

