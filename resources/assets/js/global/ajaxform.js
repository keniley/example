(function($) {
    $.fn.ajaxform = function(options) {
        
        var settings = $.extend(
        {
            onSuccess: function() {}, 
            onError: function() {},
            clearClass: 'clear',
            clearOnSuccess: true,
            clearOnError: true,
        }, options);

        this.each(function() {

            var el = this;

            this.sendform = {

                element: null,
                method: null,
                url: null,

                init: function() {
                    this.element = $(el);
                    this.method = this.element.attr('method');
                    this.url = this.element.attr('action');
                    this.events();
                },

                events: function() {
                    $(document).on("submit", "#"+this.element[0].id, this, function(event) {
                        event.preventDefault();
                        event.data.query();
                    });
                },

                query: function() {
                    this.element.find('.invalid-feedback').detach();
                    this.element.find('.is-invalid').removeClass('is-invalid');
                    let instance = this;
                    $.ajax({
                        type: instance.method,
                        url: instance.url,
                        data: instance.element.serialize(),
                        dataType: "json",
                        error: 
                        function(result, status, xhr) {
                            if(settings.clearOnError === true) {
                               instance.element.find('.' + settings.clearClass).val(''); 
                            }

                            if(result.status === 422) {
                                return instance.invalidData(result.responseJSON.errors);
                            }

                            settings.onError(result);
                            
                        },
                        success: 
                        function(result, status, xhr) {
                            if(settings.clearOnSuccess === true) {
                               instance.element.find('.' + settings.clearClass).val(''); 
                            }
                            
                            settings.onSuccess(result);
                        }
                    })
                },

                invalidData: function(json) {
                    let instance = this;

                    $.each(json, function(index, value) {
                        let el = instance.element.find('*[name='+index+']');
                        $( '<div class="invalid-feedback">'+ value.join('<br>') +'</div>' ).insertAfter(el);
                        el.addClass('is-invalid');
                    });

                    return true;
                }
            }

            this.sendform.init();
        });
    }
}(jQuery));