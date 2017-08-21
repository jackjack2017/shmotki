var sortable = {
    init: function(){
        $('.js-sortable-with-handler').sortable({
            connectWith: '.js-sortable-i',
            'ui-floating': 'auto',
            axis: 'y',
            key: "sort",
            handle: '.js-sortable-handler',
            deactivate: function( event, ui ) {
                    var parentEl = ui.item[0].offsetParent;
                    var url_route = $(parentEl).data('url');
                    var method = $(parentEl).data('method');

                    if (method == undefined){
                        method = 'POST';
                    }

                    
                    var referense_id = ui.item[0].id;

                    var prevEllength = $('#' +referense_id).prev().length;

                    var referense_entity_id = $('#' +referense_id).prev().attr('id');
                    var elPosition = 'before';

                    if (prevEllength === 0) {
                        elPosition = 'after';
                        referense_entity_id = $('#' + referense_id).next().attr('id');
                    }

                    $.ajax({
                    method: method,
                    url: url_route, 
                    data: { 'entity_id': referense_id ,'reference_entity_id': referense_entity_id, 'reference_type': elPosition, _token: csrf_token },
                    success: function(data) {
                        alerts.success('', 'Данные успешно сохранены.');
                    },
                    error: function(){
                        alerts.error('Ошибка!', 'Возникли проблемы');
                    }
                });
            }
        });


        $('.js-sortable-without-handler').sortable({
            connectWith: '.js-sortable-i',
            'ui-floating': 'auto',
            axis: 'y',
            key: "sort",
            deactivate: function( event, ui ) {
                    var parentEl = ui.item[0].offsetParent;
                    var url_route = $(parentEl).data('url');
                    var method = $(parentEl).data('method');

                    if (method == undefined){
                        method = 'POST';
                    }
                    
                    var referense_id = ui.item[0].id;

                    var prevEllength = $('#' +referense_id).prev().length;

                    var referense_entity_id = $('#' +referense_id).prev().attr('id');
                    var elPosition = 'before';

                    if (prevEllength === 0) {
                        elPosition = 'after';
                        referense_entity_id = $('#' + referense_id).next().attr('id');
                    }

                    $.ajax({
                    method: method,
                    url: url_route, 
                    data: { 'entity_id': referense_id ,'reference_entity_id': referense_entity_id, 'reference_type': elPosition, _token: csrf_token },
                    success: function(data) {
                        alerts.success('', 'Данные успешно сохранены.');
                    },
                    error: function(){
                        alerts.error('Ошибка!', 'Возникли проблемы');
                    }
                });
            }
        });
    }
};