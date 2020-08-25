@php 
$_leftmenu = [1,2];
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
    <script src='/dist/admin/tinymce/tinymce.min.js'></script>
    <script>
        let url = window.location.protocol + '://' + window.location.hostname;
        if(window.location.port != '') {
          url = url + ':' + window.location.port;
        }

        tinymce.init({
            selector: '#tiny',
            language: 'cs',
            height: 500,
            menubar: false,
            relative_urls: false,
            document_base_url: url,
            entity_encoding : "raw",
            content_css: '/dist/admin/css/admin.css',
            plugins: [
            'advlist autolink link image lists charmap print preview hr anchor pagebreak spellchecker',
            'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
            'save table directionality emoticons template paste'
            ],
            toolbar: 'code | undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image | forecolor backcolor emoticons'
        });
    </script>
@endsection

@section ('breadcrumb')
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb justify-content-center bg-transparent">
        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
        <li class="breadcrumb-item"><a href="/admin/content">Seznam textů na webu</a></li>
        <li class="breadcrumb-item active" aria-current="page">@if($content !== null){{ $content->title }}@else Neznámý text @endif</li>
      </ol>
    </nav>
@endsection

@section ('content')
    @if($content === null)
        <h1 class="text-gray-600 text-center pt-5 mt-5">Požadovaný záznam s ID "{{ $id }}" nebyl nalezen!</h1>
        <div class="text-center"><a href="/admin/content">zpět na výpis</a></div>
    @else
        <form method="POST" action="/admin/content/{{ $content->id }}" class="ajaxform" id="form1">
            <input type="hidden" name="_id" value="{{ $content->id }}">
            @csrf
            <div class="row">
                <div class="col-12 col-lg-4">
                    <div class="panel bg-white p-4 mb-4">
                        <div class="panel-header border-0 mb-3 pb-3 d-flex justify-content-between">
                            <h2 class="p-0 m-0">Nastavení textu<small class="d-inline-block ml-2"></small></h2>
                            <div>
                                <button data-toggle="modal" data-target="#modal-right" data-content="/admin/help/2" type="button" class="btn btn-default btn-sm btn-circle materialize waves-circle-light"><i class="icon fas fa-question"></i></button>
                            </div>
                        </div>
                        <div class="panel-content">
                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label col-form-label-sm font-weight-bold">Id</label>
                                <div class="col-sm-10 col-form-label-sm">
                                  {{ $content->id }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label col-form-label-sm font-weight-bold">Vytvořeno</label>
                                <div class="col-sm-10 col-form-label-sm">
                                  {{ $content->created_at->format('d.m.Y H:i:s') }} - {{ $content->adminCreate->name }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label col-form-label-sm font-weight-bold">Změněno</label>
                                <div class="col-sm-10 col-form-label-sm">
                                  {{ $content->updated_at->format('d.m.Y H:i:s') }} - {{ $content->adminUpdate->name }}
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-sm-2 col-form-label col-form-label-sm font-weight-bold">Aktivní</label>
                                    @if($content->system)
                                        <div class="col-sm-10 col-form-label-sm">
                                            <i>nelze měnit</i>
                                        </div>
                                    @else
                                        <div class="col-sm-10">
                                            <input type="hidden" name="active" value="0">
                                            <label class="switch switch-form">
                                                <input type="checkbox" name="active" value="1" @if($content->active === 1) checked="checked" @endif>
                                                <span class="checkmark"></span>
                                            </label>
                                        </div>
                                    @endif
                            </div>

                            <div class="form-group row">
                                <label for="title" class="col-sm-2 col-form-label col-form-label-sm font-weight-bold">Název</label>
                                <div class="col-sm-10">
                                  <input name="title" class="form-control form-control-sm" id="title" value="{{ $content->title }}" @if($content->system) readonly @endif>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="panel bg-white p-4 mb-4">
                        <div class="panel-header border-0 mb-3 pb-3 d-flex justify-content-between">
                            <h2 class="p-0 m-0">Nastavení SEO<small class="d-inline-block ml-2"></small></h2>
                            <div>
                                <button data-toggle="modal" data-target="#modal-right" data-content="/admin/help/2" type="button" class="btn btn-default btn-sm btn-circle materialize waves-circle-light"><i class="icon fas fa-question"></i></button>
                            </div>
                        </div>
                        <div class="panel-content">
                            
                            <div class="form-group row">
                                <label for="seo_title" class="col-sm-2 col-form-label col-form-label-sm font-weight-bold">SEO title</label>
                                <div class="col-sm-10">
                                  <input name="seo_title" class="form-control form-control-sm" id="seo_title" value="{{ $content->seo_title }}">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="seo_description" class="font-weight-bold">SEO Description</label>
                                <textarea name="seo_description" id="seo_title" class="form-control form-control-sm" style="height:140px">{{ $content->seo_description }}</textarea>
                             </div>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-lg-4">
                    <div class="panel bg-white p-4 mb-4">
                        <div class="panel-header border-0 mb-3 pb-3 d-flex justify-content-between">
                            <h2 class="p-0 m-0">Nastavení URL<small class="d-inline-block ml-2"></small></h2>
                            <div>
                                <button data-toggle="modal" data-target="#modal-right" data-content="/admin/help/2" type="button" class="btn btn-default btn-sm btn-circle materialize waves-circle-light"><i class="icon fas fa-question"></i></button>
                            </div>
                        </div>
                        <div class="panel-content">
                            
                            @if($content->system)
                                <div class="form-group size-0-8">
                                    <label class="font-weight-bold">Aktuální</label>
                                    <div>@if($content->activeUrl()) /{{ $content->activeUrl()->slug }} @endif</div>
                                </div>
                            @else
                                <div class="input-group mb-3 input-group-sm">
                                    <input type="text" name="url_slug" class="form-control" value="@if($content->activeUrl()) /{{ $content->activeUrl()->slug }} @endif">
                                    <div class="input-group-append">
                                        <span class="input-group-text">pevná</span>
                                        <div class="input-group-text">
                                            <input type="hidden" name="url_static" value="0">
                                            <input type="checkbox" value="1" name="url_static" @if($content->activeUrl()) @if($content->activeUrl()->is_static) checked="checked" @endif @endif>
                                        </div>
                                    </div>
                                </div>
                            @endif
                            
                            @if($content->historyUrls()->count())
                                <div class="form-group size-0-8">
                                    <label class="font-weight-bold">Historie</label>
                                    @foreach ($content->historyUrls() as $url)
                                        <div>/{{ $url->slug }}</div>
                                    @endforeach
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mb-3">
                <div class="col-12 d-flex">
                    <div class="flex-grow-1">
                        <button type="submit" title="Uložit veškeré změny" class="btn btn-success materialize has-tooltip">Uložit změny</button>
                    </div>
                    <div>
                        <button type="button" title="Vytvořit zálohu z aktuálně uloženého textu" class="btn btn-primary materialize has-tooltip">vytvořit zálohu</button>
                        <button type="button" title="Nahrát poslední zálohu do editoru" class="btn btn-secondary materialize has-tooltip">Načíst zálohu</button>
                    </div>
                </div>
            </div>

            <div class="row mb-5 pb-5">
                <div class="col-12">
                    <textarea id="tiny" name="body" class="w-100">{{ $content->body }}</textarea>
                </div>
            </div>
        </form>
    @endif
@endsection

