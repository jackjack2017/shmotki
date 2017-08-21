/**
 * Use for modals control
 *
 * Realized few type of modals
 *
 * @type {{base: Function, withFrom: Function, set_content: Function}}
 */
modals = {
    /**
     * Open modal for action that need confirmation
     *
     * @param confirm_function Would be call after confirm
     * @param title
     * @param content
     * @param btn_name
     */
    base: function(confirm_function, title, content, btn_name) {
        var modal_blk = $('.js_base_modal');
        this.set_content(modal_blk, title, content, btn_name);

        $(modal_blk).on('click', '.js_confirm_btn', function() {
            confirm_function();
            $(modal_blk).modal('hide');
            $(modal_blk).off('click', '.js_confirm_btn');
        });

        $(modal_blk).modal();
    },

    /**
     * Open modal with form
     *
     * @param confirm_function
     * @param content
     */
    withFrom: function(confirm_function, content) {
        var modal_blk = $('.js_empty_modal');
        $(modal_blk).html(content);
        //ui.date_picker_init();

        var success_function = function(data) {
            confirm_function(data);
            $(modal_blk).modal('hide');
        };

        var error_function = function(errors) {
            errors = $.parseJSON(errors);
            var errors_string = '';
            $.map(errors, function(val, name) {
                errors_string += name + ': ' + val + '<br>';
                $(modal_blk).find('.status').html('<div class="alert alert-danger alert-dismissible"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">?</button><h4><i class="icon fa fa-ban"></i> Возникли ошибки</h4>' + errors_string + '</div>');
            });
        };

        var action = $(modal_blk).find('form').attr('action');
        var method = $(modal_blk).find('form').attr('method');

        $(modal_blk).on('submit', 'form', function(event) {
            event.preventDefault();
            var data = $(this).serialize();
            controls.ajax_action(action, method, success_function, error_function, data);
        });

        $(modal_blk).on('hidden.bs.modal', function() {
            $(modal_blk).off('submit', 'form');
        });

        $(modal_blk).modal();
    },


    /**
     * Set modal content
     *
     * @param modal_blk
     * @param title
     * @param content
     * @param btn_name
     */
    set_content: function(modal_blk, title, content, btn_name) {
        $(modal_blk).find('.modal-title').html(title);
        $(modal_blk).find('.modal-body').find('p').html(content);
        $(modal_blk).find('.js_confirm_btn').html(btn_name);
    }

};