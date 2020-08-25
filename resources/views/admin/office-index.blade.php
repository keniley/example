@php 
$_leftmenu = [5, 11];
@endphp

@extends ('admin.layout.html')

@section ('javascript')
    <script>
        $('#datatable1').datab({
            table: {
                class: 'table'
            },
            columns: [
                { 
                    column: 'id', 
                    title: 'id', 
                    sortable: true, 
                    width: 10,
                    template: function(row) {
                        return '<a href="/admin/office/' + row.id + '">' + row.id + '</a>';
                    }
                },
                { 
                    column: 'active', 
                    title: 'Aktivní', 
                    sortable: true, 
                    width: 15, 
                    class: 'text-center',
                    template: function(row) {
                        if(row.active) {
                            return '<a href="/admin/office/' + row.id + '"><i class="fas fa-check text-success"></i></a>';
                        }
                        return '<a href="/admin/office/' + row.id + '"><i class="fas fa-times text-danger"></i></a>';
                    }
                },
                { 
                    column: 'title', 
                    title: 'Název', 
                    sortable: true, 
                    width: 45,
                    template: function(row) {
                        return '<a href="/admin/office/' + row.id + '">'+row.title+'</a>';
                    } 
                },
                { 
                    column: 'default', 
                    title: 'Výchozí', 
                    sortable: true, 
                    width: 15, 
                    class: 'text-center',
                    template: function(row) {
                        if(row.default) {
                            return '<a href="/admin/office/' + row.id + '"><i class="fas fa-check text-success"></i></a>';
                        }
                        return '<a href="/admin/office/' + row.id + '"><i class="fas fa-times text-danger"></i></a>';
                    }
                }
            ],
            endpoint: {
                url: '/admin/office',
                method: 'GET',
                header: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            }
        });
    </script>
@endsection

@section ('css')
@endsection

@section ('breadcrumb')
    <nav aria-label="breadcrumb">
      <ol class="breadcrumb justify-content-center bg-transparent">
        <li class="breadcrumb-item"><a href="/admin">Home</a></li>
        <li class="breadcrumb-item active" aria-current="page">Seznam poboček</li>
      </ol>
    </nav>
@endsection

@section ('content')
    <div class="row">
    <div class="col col-12">
        <div class="panel bg-white p-4">
            <div class="panel-header border-0 mb-3 pb-3 d-flex justify-content-between">
                <h2 class="p-0 m-0">Pobočky<small class="d-inline-block ml-2"></small></h2>
                <div class="d-flex">
                    <button data-toggle="modal" data-target="#modal-l" data-content="/admin/modal/new/office" type="button" class="btn btn-success btn-sm btn-circle materialize waves-circle-light"><i class="icon fas fa-plus"></i></button>
                    <button data-toggle="modal" data-target="#modal-right" data-content="/admin/help/3" type="button" class="btn btn-default btn-sm btn-circle materialize waves-circle-light"><i class="icon fas fa-question"></i></button>
                </div>
            </div>
            <div class="panel-content">
                <form id="datatable1">
                    <div class="row datab-filter">
                        <div class="col col-12 col-sm-6 col-lg-4 col-xl-2">
                            <div class="form-group">
                                <label for="filter-someone2">Aktivní</label>
                                <select name="filter[active][like]" class="form-control form-control-sm" id="filter-someone2" data-style="btn-select">
                                    <option value="_all">-------</option>
                                    <option value="1">ANO</option>
                                    <option value="0">NE</option>
                                </select>
                            </div>
                        </div>
                        <div class="col col-12 col-sm-6 col-lg-4 col-xl-2">
                            <div class="form-group">
                                <label for="filter-someone3">Výchozí</label>
                                <select name="filter[default][like]" class="form-control form-control-sm" id="filter-someone3" data-style="btn-select">
                                    <option value="_all">-------</option>
                                    <option value="1">ANO</option>
                                    <option value="0">NE</option>
                                </select>
                            </div>
                        </div>
                        <div class="col col-12 col-sm-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="filter-someone1">Vyhledat</label>
                                <div class="form-search d-flex">
                                    <input name="filter[search][like]" class="form-control form-control-sm">
                                    <select name="filter[search][where]" class="form-control form-control-sm"  data-style="btn-select">
                                        <option value="name">Název</option>
                                        <option value="street">Ulice</option>
                                        <option value="city">Město</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="datab">
                        <div class="datab-inner table-responsive mt-4"></div>
                    </div>
                </form> 
            </div>
        </div>
    </div>
</div>

@endsection