(function($) {

    $.fn.datab = function(options) {

        var settings = $.extend(
        {
            table: {
                class: 'table',
                footer: {}
            },
            columns: [],
            endpoint: {
                url: null,
                method: 'GET',
                header: {}
            },
            onRender: function() { }
        }, options);

        this.each(function() {

            var el = this;

            this.datatable = {
                element: null,
                data: null,
                metadata: null,
                instanceID: null,
                canStorage: true,
                sorted: {
                    column: 'id',
                    type: 'asc'
                },
                page: 1,
                limit: 25,
                loadingDelay: 1000,
                error: '',
                inputTimeOutID: null,
                timeout: 800,
                pages: [5,25,50,100],


                init: function() {

                    // initialize object
                    this.element = $(el);
                    delete this.element[0]["datatable"];
   
                    // zjistit, zda je local storage dostupne
                    this.canSave();

                    // vygeneruji unikatni id pro url
                    this.instanceID = window.location.pathname.replace(/[\/\.]/g, '-').substring(1) + '-' + this.element[0].id;
                    
                    this.loadLocal();

                    // pripravim table <thead> a vlozim do ni data
                    let head = $('<thead />')
                        .append(this.renderTableHead());
                    
                    // pripravim table <tbody>
                    let body = $('<tbody />');

                    // zkompletuji cely table
                    let table = $("<table />")
                        .addClass(settings.table.class)
                        .append([head, body]);
                    
                    // vyrendruji tabulku (v tuto chvili jen s hlavickou <thead>)
                    this.element.find('.datab .datab-inner').html(table);

                    // supustim query, ktere rendruje obsah tabulky i footer
                    this.query();

                    // spustim eventy
                    this.events();
                },

                events: function() {

                    $(document).on("click","#"+this.element[0].id+" .datab-sortable", this, function(event) {
                        event.data.sort(this);
                    });

                    $(document).on("click","#"+this.element[0].id+" .datab-action", this, function(event) {
                        event.preventDefault();
                        event.data.action(this);
                    });

                    $(document).on("change","#"+this.element[0].id+" .datab-limit select", this, function(event) {
                        event.data.setLimit(this);
                    });

                    $(document).on("change","#"+this.element[0].id+" .checkall input", this, function(event) {
                        let checkboxes = event.data.element.find('.datab table tbody :checkbox');
                        let checked = this.checked;
                        $.each(checkboxes, function() {
                            this.checked = checked; 
                        });
                    });

                    $(document).on("click","#"+this.element[0].id+" .datab-page", this, function(event) {
                        event.data.pagging(this);
                    });

                    $(document).on("submit", this.element[0].id, this, function(event) {
                        event.preventDefault();
                        event.data.query();
                    });

                    $(document).on("change", "#"+this.element[0].id+" .datab-filter select", this, function(event) {
                        event.preventDefault();
                        event.data.query();
                    });

                    $(document).on("keydown", "#"+this.element[0].id+" input", this, function(event) {
                        if(event.data.inputTimeOutID !== null) {
                           clearTimeout(event.data.inputTimeOutID); 
                        }
                    });

                    $(document).on("keyup", "#"+this.element[0].id+" input", this, function(event) {

                        if(event.data.inputTimeOutID !== null) {
                           clearTimeout(event.data.inputTimeOutID); 
                        }

                        event.data.inputTimeOutID = setTimeout(function (object) {
                            object.query();
                        }, event.data.timeout, event.data);
             
                    });
                },

                prepareFooter: function() {
                    let limit = $('<div />')
                        .addClass(['datab-limit','d-flex', 'align-items-center', 'justify-content-end', 'w-100']);

                    let pagination = $('<div />')
                        .addClass(['datab-pagination','d-flex']);

                    let footer = $('<div />')
                        .addClass(['datab-footer','d-flex', 'justify-content-between', 'align-items-center' ,'pb-3'])
                        .append( $('<div />').addClass('datab-footer-button') )
                        .append( $('<div />').addClass('datab-footer-paging').html(pagination) )
                        .append( $('<div />').addClass('datab-footer-limit').html(limit) )

                    if(this.isDefined(settings.table, 'footer')) {
                        let btnclass = 'btn-success';
                        let isDropup = true;
                        let dropup = { btn1: '', btn2: '' };
                        let btn = '';
                        let wrap = '';
                        let items = '';

                        if(this.isDefined(settings.table.footer, 'class')) {
                            btnclass = settings.table.footer.class;
                        }

                        if(this.isDefined(settings.table.footer, 'action')) {
                            isDropup = false;
                        }

                        if(isDropup === true) {
                            dropup.btn1 = 'dropdown-toggle';
                            dropup.btn2 = 'data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"';
                        }

                        btn = '<button type="button" class="materialize waves-button-light btn btn-sm ' + btnclass + ' ' + dropup.btn1 + '" ' + dropup.btn2 + '>' + settings.table.footer.label + '</button>';
                        wrap = btn;

                        if(isDropup === true) {
                            if(this.isDefined(settings.table.footer, 'items')) {
                                $.each(settings.table.footer.items, function(key,value) {
                                    items = items + '<a class="dropdown-item datab-action" data-id="'+ value.id +'" href="' + value.action + '">' + value.title + '</a>';
                                });
                            }

                            wrap = $('<div />')
                                .addClass(['btn-group', 'dropup'])
                                .html(btn)
                                .append( $('<div />').addClass(['dropdown-menu', 'w-100']).html(items));
                        }

                        footer.find('.datab-footer-button').html(wrap);
                    }

                    return footer;
                },

                sort: function(element) {
                    let sorted_column = $(element).attr('data-column');
                    let sorted_type = $(element).attr('data-type');

                    if (typeof sorted_column !== typeof undefined && sorted_column !== false) {
                        this.sorted.column = sorted_column;
                        this.sorted.type = 'asc';
                        if (typeof sorted_type !== typeof undefined && sorted_type !== false && sorted_type == 'asc') {
                            this.sorted.type = 'desc';
                        }
                        this.resetSortable();
                        $(element).attr('data-type',this.sorted.type);
                        $(element).addClass(this.sorted.type);
                        this.page = 1;
                        this.query();
                    }
                },

                pagging: function(element) {
                    let page = $(element).text();
                    this.page = page;
                    this.query();
                },

                setLimit: function(element) {
                    let limit = $(element).val();
                    this.limit = limit;
                    this.page = 1;
                    this.query();
                },

                resetSortable: function() {
                    this.element.find(".datab-sortable").each(function() {
                        $(this).attr('data-type', null);
                        $(this).removeClass('asc');
                        $(this).removeClass('desc');
                    });
                },

                query: function() {
                    let dateStart, delay;
                    let q = '';

                    // odstranim stary footer se strankovanim
                    this.element.find('.datab-footer').detach();

                    // start timing
                    dateStart = new Date().valueOf();

                    // pridam spinner do tabulky
                    this.addSpinner();

                    // serializuji formular
                    if(this.element.serializeArray().length > 0) {
                        q = this.element.serialize() + '&';
                    }

                    // pridam strankovani, razeni, stranu a limit
                    q = q + 'order[column]=' + this.sorted.column + '&order[type]=' + this.sorted.type + '&page=' + this.page + '&limit=' + this.limit;

                    // ulozim query do localu
                    this.setStorage(q);

                    // posilam ajaxem query na server
                    this.getData(q);

                    // mame odpoved, stopujeme cas odpovedi
                    delay = new Date().valueOf() - dateStart;

                    // odpoved prisla moc rychle, zdrzime rendrovani
                    if(delay < this.loadingDelay) {
                        setTimeout(this.render, this.loadingDelay - delay, this); 
                        return;
                    } 

                    // odpoved prisla o neco pozdeji, rendrujeme ihned
                    this.render(this); 
                },

                action: function(element) {
                    let fid = $(element).attr('data-id');
                    let action = settings.table.footer.items.find(x => x.id === fid);
                    
                    let check = [];
                    
                    this.element.find(".datab-check").each(function() {
                        if ($(this).is(':checked')) {
                            check.push($(this).attr('data-id'));
                        }
                    });

                    if(check.length === 0) {
                        toastr["warning"]("Nevybrali jste žádné položky!");
                        return;
                    }
                    
                    this.runAction(action, check);
                },
                /** TODO NON AJAX POST|GET REQUEST */
                runAction: function(action, data) {
                    let instance = this;
                    let available = {
                        method: ['POST', 'GET', 'PATCH', 'PUT', 'DELETE'],
                        format: ['string', 'json']
                    };
                    let method = 'GET';
                    let refresh = false;
                    let format = 'string';
                    let ajax = true;
                    let content = 'application/x-www-form-urlencoded; charset=UTF-8';
                    data = { ids: data };

                    if(this.isDefined(action,'method')) {
                        if(available.method.includes(action.method) === false) {
                            console.warn('Nepodporovaná metoda akce! Podporované metody jsou:');
                            console.log(available.method);
                            toastr["error"]("Chyba definice akce!");
                            return;
                        }
                        method = action.method;
                    }

                    if(this.isDefined(action,'refresh')) {
                        if(action.refresh !== true && action.refresh !== false) {
                            console.warn('Nepodporovaný refresh akce! Podporované jsou pouze hodnoty true nebo false');
                            toastr["error"]("Chyba definice akce!");
                            return;
                        }
                        refresh = action.refresh;
                    }

                    if(this.isDefined(action,'format')) {
                        if(available.format.includes(action.format) === false) {
                            console.warn('Nepodporovaný formát akce! Podporované formáty jsou:');
                            console.log(available.format);
                            toastr["error"]("Chyba definice akce!");
                            return;
                        }
                        format = action.format;
                        if(format === 'json') {
                            content = 'application/json; charset=UTF-8';
                            data = JSON.stringify(data);
                        }
                    }

                    if(this.isDefined(action,'ajax')) {
                        if(action.ajax !== true && action.ajax !== false) {
                            console.warn('Nepodporovaný ajax akce! Podporované jsou pouze hodnoty true nebo false');
                            toastr["error"]("Chyba definice akce!");
                            return;
                        }
                        ajax = action.ajax;
                    }

                    if(this.notDefined(action, 'action')) {
                        console.warn('Akce není definována!');
                        toastr["error"]("Chyba definice akce!");
                        return;
                    }

                    if(ajax === true) {
                        $.ajax({
                            contentType: content,
                            type: method,
                            url: action.action,
                            data: data,
                            dataType: "json",
                            error: 
                            function(result, status, xhr) {
                                toastr["error"]("Ajax error: " + result.statusText);
                            },
                            success: 
                            function(result, status, xhr) {
                                if(instance.isDefined(result,'system')) {
                                    if(instance.isDefined(result.system,'message')) {
                                        toastr['success'](result.system.message);
                                    }
                                }
                                if(refresh === true) {
                                   instance.query(); 
                                }
                            },
                            complete: 
                            function() {
                                // todo if you need
                            }
                        })
                        return;
                    }
                },

                render: function(instance) {

                    // odstranim spinner
                    instance.removeSpinner();

                    // rendruji vnitrek <tbody>
                    instance.renderBody();

                    // pripravim strukturu footeru
                    let footer = instance.prepareFooter();

                    // pripravim strankovani
                    let pagination = instance.preparePagination();

                    // pripravim limit
                    let limit = instance.prepareLimit();

                    // zkompletuji footer
                    footer.find('.datab-pagination').html(pagination);
                    footer.find('.datab-limit').html(limit);

                    // vykreslim footer pod tabulku
                    instance.element.find('.datab').append(footer);
                    
                    // tady resime zavislosti jako je nova inicializace selectpickeru
                    settings.onRender();
                },

                canSave: function() {
                    if (typeof(Storage) === "undefined") {
                        console.warn('No local storage enabled. Form not saved!');
                        this.canStorage = false;
                        return false;
                    } 

                    this.canStorage = true;
                    return true;
                },

                decodeStorage: function(string) {
                    string = decodeURIComponent(string);
                    let arr = [];

                    string.split("&").forEach(function(part) {
                        let item = part.split("=");
                        arr[item[0]] = item[1]; 
                    });

                    return arr;
                },

                loadLocal: function() {
                    let storage = this.getStorage();

                    if(storage !== null) {
                        let array = this.decodeStorage(storage);
                        let instance = this.element;

                        this.limit = array['limit'];
                        this.page = array['page'];
                        this.sorted.column = array['order[column]'];
                        this.sorted.type = array['order[type]'];

                        delete array["limit"];
                        delete array["page"];
                        delete array["order[column]"];
                        delete array["order[type]"];

                        Object.keys(array).forEach(function(key) {
                            let selector = "[name='"+ key +"']";
                            instance.find(selector).val(array[key]);
                        });    
                    }
                },

                setStorage: function(data) {
                    if(this.canStorage) {
                        localStorage.setItem(this.instanceID, data);    
                    } 
                },

                getStorage: function() {
                    if(this.canStorage) {
                        return localStorage.getItem(this.instanceID);    
                    } 
                },

                renderTableHead: function() {
                    var row = $("<tr />");
                    let storage = this.sorted;
                    let instance = this;

                    $.each(settings.columns, function(i, item) {
                        let th = $("<th />")
                            .addClass(['border-0','bg-gray-200', 'font-weight-600']);
                        let inner = $('<div />').html(item.title).addClass(['d-inline-block']);

                        if(instance.isDefined(item, 'class')) {
                            th.addClass(item.class);   
                        }

                        if(instance.isDefined(item, 'width')) {
                            th.css('width', item.width + '%');    
                        }

                        if(instance.isDefined(item, 'sortable')) {
                            if(item.sortable) {
                                inner.addClass(['datab-sortable','position-relative']);
                                inner.attr('data-column', item.column);
                                if(storage.column === item.column) {
                                    inner.addClass(storage.type);
                                    inner.attr('data-type', storage.type);
                                }
                            }  
                        }

                        th.html(inner);

                        th.css('width', item.width + '%');    

                        row.append(th);
                    });

                    return row;
                },

                setElement: function(el) {
                    this.element = $(el);
                    delete this.element[0]["datatable"];
                    return this;
                },

                getData: function(q) {
                    let endpoint = settings.endpoint.url
                    let method = 'GET';
                    let header = {};
                    let instance = this;

                    if(this.isDefined(settings.endpoint, 'method')) {
                        method = settings.endpoint.method;
                    }

                    if(this.isDefined(settings.endpoint, 'header')) {
                        header = settings.endpoint.header;
                    }

                    if(endpoint === null) {
                        return;
                    }

                    $.ajax({
                        type: method,
                        url: endpoint,
                        data: q,
                        dataType: "json",
                        beforeSend: 
                        function(xhr) {
                            Object.keys(header).forEach(function(key) {
                                xhr.setRequestHeader(key, header[key]);
                            });
                        },
                        error: 
                        function (result,status,xhr) {
                            if(result.status === 411) {
                                instance.validationError(result.responseJSON);
                            } else {
                                instance.generalError(result, 'Ajax error');
                            }
                            instance.data = {};
                            instance.metadata = {};
                        },
                        success:
                        function (result,status,xhr) {
                            if(instance.isDefined(result, 'metadata') && instance.isDefined(result, 'data')) {
                                instance.metadata = result.metadata;
                                instance.data = result.data;
                                instance.error = '';
                            } else {
                                instance.generalError(result, 'Wrong json format. Data or metadata not found!');
                                instance.data = {};
                                instance.metadata = {};
                            }
                        },
                        complete:
                        function () {

                        }
                    });
                },

                validationError: function(json) {
                    console.warn('Form error:');
                    this.error = 'Chyba dotazu';
                },

                generalError: function(result = null, msg = '') {
                    console.warn('General error: ' + msg);
                    this.error = msg;
                },

                addSpinner: function() {
                    let colspan = settings.columns.length;
                    this.element.find('tbody').html('<tr class="datab-spinner"><td colspan=' + colspan +' style="text-align: center"><div class="spinner-border text-primary spinner-size-xl spinner-thin" role="status"><span class="sr-only">Loading...</span></div></td></tr>');
                },

                removeSpinner: function() {

                    this.element.find('.datab-spinner').detach();
                },

                prepareLimit: function() {
                    let limit = '';

                    if(this.isDefined(this.metadata, 'count')) {
                        limit = limit + this.metadata.selected + '&nbsp;/&nbsp;' + this.metadata.count;
                        limit = limit + '<select class="form-control form-control-sm ml-2" data-style="btn-select">';
                        let storage = this.limit;
                        $.each(this.pages, function(key, value) {
                            let selected = '';
                            if(value == storage) {
                                selected = ' SELECTED';
                            }
                            limit = limit + '<option value="' + value + '"' + selected + '>' + value + '</option>';
                        });
                        limit = limit + '</select>';
                    }

                    return limit;
                },

                preparePagination: function() {
                    let page = 1;
                    let pages = 1;
                    let template = '';
                    let limit = '';

                    if(this.isDefined(this.metadata, 'page')) {
                        page = this.metadata.page;
                    }

                    if(this.isDefined(this.metadata, 'pages')) {
                        pages = this.metadata.pages;
                    }

                    if(pages < 7) {
                        template = this.renderPages1(pages, page);
                    } else if(page < 4) {
                        template = this.renderPages2(pages, page);
                    } else if (page > (pages - 3)) {
                        template = this.renderPages3(pages, page);
                    } else {
                       template = this.renderPages4(pages, page);
                    }

                    if(this.isDefined(this.metadata, 'count')) {
                        limit = limit + this.metadata.count;
                        limit = limit + '<select class="form-control form-control-sm" data-style="btn-select">';
                        let storage = this.limit;
                        $.each(this.pages, function(key, value) {
                            let selected = '';
                            if(value == storage) {
                                selected = ' SELECTED';
                            }
                            limit = limit + '<option value="' + value + '"' + selected + '>' + value + '</option>';
                        });
                        limit = limit + '</select>';
                        this.element.find('.datab-limit').html(limit);
                    }

                    return template;
                },

                renderPages1: function(pages, page) {
                    let i, add;
                    let template = '';

                    for (i = 1; i <= pages; i++) {
                        add = '';
                        if(page == i) {
                            add = 'active';
                        }
                        template = template + '<span class="materialize waves-circle-light datab-page ' + add + '">' + i + '</span>';
                    }

                    return template;
                },

                renderPages2: function(pages, page) {
                    let i, add;
                    let template = '';

                    for (i = 1; i <= 4; i++) {
                        add = '';
                        if(page == i) {
                            add = 'active';
                        }
                        template = template + '<span class="materialize waves-circle-light datab-page ' + add + '">' + i + '</span>';
                    }
                    template = template + '<span class="datab-separator">...</span>';
                    template = template + '<span class="materialize waves-circle-light datab-page">' + pages + '</span>';

                    return template;
                },

                renderPages3: function(pages, page) {
                    let i, add;
                    let template = '';

                    template = template + '<span class="materialize waves-circle-light datab-page">1</span>';
                    template = template + '<span class="datab-separator">...</span>';
                    for (i = pages - 3; i <= pages; i++) {
                        add = '';
                        if(page == i) {
                            add = 'active';
                        }
                        template = template + '<span class="materialize waves-circle-light datab-page ' + add + '">' + i + '</span>';
                    }

                    return template;
                },

                renderPages4: function(pages, page) {
                    let template = '';
                    let prev = page - 1;
                    let next = page + 1;
                    template = template + '<span class="materialize waves-circle-light datab-page">1</span>';
                    template = template + '<span class="datab-separator">...</span>';
                    template = template + '<span class="materialize waves-circle-light datab-page">' + prev + '</span>';
                    template = template + '<span class="materialize waves-circle-light datab-page active">' + page + '</span>';
                    template = template + '<span class="materialize waves-circle-light datab-page">' + next + '</span>';
                    template = template + '<span class="datab-separator">...</span>';
                    template = template + '<span class="materialize waves-circle-light datab-page">' + pages + '</span>';
                    return template;
                },

                renderBody: function() {
                    let ok = true;
                    let instance = this;
                    let colspan = settings.columns.length;

                    if(this.data === null) {
                        this.element.find('.datab table tbody').html('<tr><td colspan=' + colspan +'><div class="alert alert-warning my-3 mx-2 text-center" role="alert">Nic nenalezeno</div></td></tr>');
                        ok = false;
                    } else {
                        if(this.data.length === 0) {
                            this.element.find('.datab table tbody').html('<tr><td colspan=' + colspan +'><div class="alert alert-warning my-3 mx-2 text-center" role="alert">Nic nenalezeno</div></td></tr>');
                            ok = false;
                        }

                        if(this.error !== '') {
                            this.element.find('.datab table tbody').html('<tr><td colspan=' + colspan +'><div class="alert alert-warning my-3 mx-2 text-center" role="alert">' + this.error + '</div></td></tr>');
                            ok = false;
                        }
                    }
                    
                    if(ok) {
                        $.each(this.data, function(i, item) {
                            instance.element.find('.datab table tbody').append('<tr>'+ instance.renderRow(item) +'</tr>');
                        });
                    }
                    
                },

                renderRow: function(row) {
                    var htmlRow = '';
                    let instance = this;
                    $.each(settings.columns, function(i, item) {
                        htmlRow = htmlRow + instance.renderColumn(row, item);
                    })
                    return htmlRow;
                },

                notDefined: function(object, property) {
                    if(object === null) {
                        return true;
                    }

                    if(typeof object[property] === 'undefined') {
                        return true;
                    }

                    return false;
                },

                isDefined: function(object, property) {
                    if(object === null) {
                        return false;
                    }

                    if(typeof object[property] === 'undefined') {
                        return false;
                    }

                    return true;
                },

                isFunction: function(object, property) {
                    if(typeof object[property] === 'function') {
                        return true;
                    }

                    return false;
                },

                renderColumn(row, item) {
                    let cl = '';
                    
                    if(this.isDefined(item, 'class')) {
                        cl = item.class;   
                    }

                    if(this.isFunction(item, 'template')) {
                        return '<td class="'+cl+'">'+ item.template(row) +'</td>';    
                    }

                    if(this.notDefined(item, 'template')) {
                        return '<td class="'+cl+'">'+ row[item.column] +'</td>';      
                    }

                    return '<td class="'+cl+'">'+ item.template +'</td>';  
                }
            }
            
            this.datatable.init();
        });

    }
}(jQuery));