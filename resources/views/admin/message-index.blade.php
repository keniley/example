@php 
$_leftmenu = [1, 10];
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
                        let read = '';
                        
                        if(row.read_at === null) {
                           read = 'class="font-weight-bold"'; 
                        }

                        return '<a ' + read + ' href="#" data-toggle="modal" data-target="#modal-l" data-content="/admin/modal/message/' + row.id + '">' + row.id + '</a>';
                    }
                },
                { 
                    column: 'created_at', 
                    title: 'Datum', 
                    sortable: true, 
                    width: 15, 
                    class: 'text-center',
                    template: function(row) {
                        let read = '';
                        
                        if(row.read_at === null) {
                           read = 'class="font-weight-bold"'; 
                        }

                        return '<a ' + read + ' href="#" data-toggle="modal" data-target="#modal-l" data-content="/admin/modal/message/' + row.id + '">' + row.created_at + '</a>';
                    }
                },
                { 
                    column: 'type', 
                    title: 'Typ', 
                    sortable: true, 
                    width: 15,
                    template: function(row) {
                        let type = 'Dotaz';
                        if(row.type === 'course') {
                            type = 'Poptávka kurzu';
                        }

                        let read = '';
                        
                        if(row.read_at === null) {
                           read = 'class="font-weight-bold"'; 
                        }

                        return '<a ' + read + ' href="#" data-toggle="modal" data-target="#modal-l" data-content="/admin/modal/message/' + row.id + '">' + type + '</a>';
                    }
                },
                { 
                    column: 'name', 
                    title: 'Jméno', 
                    sortable: true, 
                    width: 20, 
                    class: 'text-center',
                    template: function(row) {
                        if(row.name === null) {
                            row.name = '---';
                        }

                        let read = '';
                        
                        if(row.read_at === null) {
                           read = 'class="font-weight-bold"'; 
                        }

                        return '<a ' + read + ' href="#" data-toggle="modal" data-target="#modal-l" data-content="/admin/modal/message/' + row.id + '">' + row.name + '</a>';
                    }
                },
                { 
                    column: 'email', 
                    title: 'Email', 
                    sortable: true, 
                    width: 25,
                    template: function(row) {
                        let read = '';
                        
                        if(row.read_at === null) {
                           read = 'class="font-weight-bold"'; 
                        }

                        return '<a ' + read + ' href="#" data-toggle="modal" data-target="#modal-l" data-content="/admin/modal/message/' + row.id + '">' + row.email + '</a>';
                    } 
                },
                { 
                    column: 'phone', 
                    title: 'Telefon', 
                    sortable: true, 
                    width: 15, 
                    class: 'text-center',
                    template: function(row) {
                        if(row.phone === null) {
                            row.phone = '---';
                        }

                        let read = '';
                        
                        if(row.read_at === null) {
                           read = 'class="font-weight-bold"'; 
                        }

                        return '<a ' + read + ' href="#" data-toggle="modal" data-target="#modal-l" data-content="/admin/modal/message/' + row.id + '">' + row.phone + '</a>';
                    }
                }
                
            ],
            endpoint: {
                url: '/admin/message',
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
        <li class="breadcrumb-item active" aria-current="page">Seznam zpráv z webu</li>
      </ol>
    </nav>
@endsection

@section ('content')
    <div class="row">
    <div class="col col-12">
        <div class="panel bg-white p-4">
            <div class="panel-header border-0 mb-3 pb-3 d-flex justify-content-between">
                <h2 class="p-0 m-0">Zprávy z webu<small class="d-inline-block ml-2"></small></h2>
                <div class="d-flex">
                    <button data-toggle="modal" data-target="#modal-right" data-content="/admin/help/3" type="button" class="btn btn-default btn-sm btn-circle materialize waves-circle-light"><i class="icon fas fa-question"></i></button>
                </div>
            </div>
            <div class="panel-content">
                <form id="datatable1">
                    <div class="row datab-filter">
                        <div class="col col-12 col-sm-6 col-lg-4 col-xl-2">
                            <div class="form-group">
                                <label for="filter-someone2">Typ</label>
                                <select name="filter[type][like]" class="form-control form-control-sm" id="filter-someone2" data-style="btn-select">
                                    <option value="_all">-------</option>
                                    <option value="question">Dotaz</option>
                                    <option value="course">Poptávka kurzu</option>
                                </select>
                            </div>
                        </div>

                        <div class="col col-12 col-sm-6 col-lg-4 col-xl-2">
                            <div class="form-group">
                                <label for="filter-someone2">Přečtené</label>
                                <select name="filter[shown][like]" class="form-control form-control-sm" id="filter-someone2" data-style="btn-select">
                                    <option value="_all">-------</option>
                                    <option value="1">Ano</option>
                                    <option value="0">Ne</option>
                                </select>
                            </div>
                        </div>

                        <div class="col col-12 col-sm-6 col-lg-4 col-xl-3">
                            <div class="form-group">
                                <label for="filter-someone1">Vyhledat</label>
                                <div class="form-search d-flex">
                                    <input name="filter[search][like]" class="form-control form-control-sm">
                                    <select name="filter[search][where]" class="form-control form-control-sm"  data-style="btn-select">
                                        <option value="name">Jméno</option>
                                        <option value="phone">Telefon</option>
                                        <option value="email">Email</option>
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