/**
 *  Use for send form data with ajax
 *
 *  Possible to send 1 or more files
 *  For all files attribute name will be added ordinal number
 *
 * @type {{submit_init: Function}}
 */

//todo Move functionality to different functions
ajax_form = {
    submit_init: function(form) {
        $('body').on('submit', form, function(e) {
            e.preventDefault();

            var form = this;
            var method = ($(form).attr('method') == undefined ? "POST" : $(form).attr('method'));
            var action = ($(form).attr('action') == undefined ? "" : $(form).attr('action'));
            var result_block = $(form).data('result') == undefined ? '' : $(form).data('result');

            var success = function(data) {
                alerts.success('', 'Данные успешно сохранены.');
                $('.form-group').removeClass('has-error');
                $('.help-block').html('');
                if(result_block !== ''){
                    $(result_block).html(data);
                }

            };
            var error = function(data) {
                $('.form-group').removeClass('has-error');
                $('.help-block').html('');
                var error_msg = [];

                $.each(data.responseJSON, function(i, el) {
                    error_msg.push(el[0]+'</br>');
                    validation_input(i, el);
                });
                alerts.error('Ошибка!', error_msg);
                if(result_block !== ''){
                    $(result_block).html(data);
                }
            };

            var validation_input = function(el, txt){
                $('[name=' + el +']').closest('.form-group').addClass('has-error');
                $('[name=' + el +']').after('<p class="help-block">'+txt+'</p>');
            };

            var files = $(form).find('input[type="file"]');

            //Use simple sending method when not using files
            if(files.length < 0){
                var data = $(form).serialize();
                controls.ajax_action(action, method, succees, error, data);
                return;
            }

            //Use when need send files
            var data = new FormData();
            $.each(files, function(i, input){
                if(input.files.length > 0){
                    $.each(input.files, function(i, file){
                        data.append(input.name + i, file);
                        $('[name=' + input.name + '_update]').val('true');
                    })
                }
            });

            $.each($(form).find('input:not([type=checkbox]), select, textarea'), function(i, el) {
                var id = $(el).attr('name');
                var value = $(el).val();
                data.append(id, value);
            });

            $.each($(form).find('input[type=checkbox]'), function(i, el){
            	var id = $(el).attr('name');            	
                var value = $(el).prop("checked") ? 1 : 0;
            	data.append(id, value);
            });
            $.ajax({
                url: action,
                method: method,
                data: data,
                cache: false,
                contentType: false,
                processData: false,
                success: function(data) {
                    success(data);
                },
                error: function(data) {
                    error(data);
                }
            })
        })
    }
};

Submit_transfer = function(classForClick, classForChange){
    this.eventClick = classForClick;
    this.eventChange = classForChange;

    this.init = function(){
        var clickSel = this.eventClick ;
        var changeSEl = this.eventChange ;

        $('body').on('click', clickSel, function(){
                var form = $(this).data('form');
                $(form).submit();
        });
        $('body').on('change', changeSEl, function(){
                var form = $(this).data('form');
                 $(form).submit();
        });
    }

    this.init()
};