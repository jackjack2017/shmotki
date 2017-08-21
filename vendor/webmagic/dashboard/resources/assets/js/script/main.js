//= components/image.js
//= components/ajax_form.js
//= components/ui_components.js
//= components/data_range.js
//= components/modals.js
//= components/alerts.js
//= components/requests.js
//= components/sortable.js
//= components/updating.js



$(document).ready(function() {
    app.init();  
});

/**
 * Base app object
 * @type {{init: Function}}
 */
app = {
    init: function() {
        item.create_btn_init('.js_create');
        item.delete_btn_init('.js_delete');
        ui.data_tables_init('.js_data_table');
        ui.dependent_selects_init();
        ui.selectEl('.js-select2');

       ui.switchery($('.js-switch'));
           $('*').tooltip({
                track: true
            });
    
    $('#menu *[title]').tooltip('disable');
       $('[data-toggle="tooltip"]').tooltip("destroy");
        
        ui.box_collapse();

        // CK editor init
        if($('.js-editor').length > 0){
            $('.js-editor').each(function(index, el) {
                var name = $(this).attr('name');
                ui.editor_init(name);
            });
        }

        ui.color_picker('.js-color-pick');
        // ui.date_picker_init();
        // ui.checkbox_init();
        // ui.editor_init('.js-editor');

        // Sortable init, for now bower
        // can't load librirary, and i comment it
        sortable.init('.js-sortable');

        // datatime_picker.init();
        // datatime_picker.end();
        datatime_picker.settings();

        // date_picker.init();
        // date_picker.end();

        /**
         * Initialize ajax sending form
         */
        //todo Rename class from js-submit -> js-form
        ajax_form.submit_init('.js-submit');
        //forms.submit_file_init('.js-file-init');

        // Function auto-updating 
        $.each($('.js-update'), function(i, el){
            var my = new Updating(el);
        });

        media.select('.js-media-select');
        media.uploadPreview('.js-input-preview');
        media.checkAllBtnInit('.js-media-checkAll');

        image.uploadPreview('.js_image-preview');

        var submit_transfer1 = new Submit_transfer('.js-send-click', '.js-send-change');
        /**
         * Init multi fields
         */
        fields.init({
            src: '.js-src',
            dest: '.js-copy-dest',
            item: '.js-copy-item',
            add_btn:  '.js-add',
            remove_btn: '.js-remove'
        });
    }
};     

/**
 * Simple action for creating
 * @type {{create_item_btns_init: Function, add_item: Function}}
 */

item = {
    create: function() {
        location.reload();
    },

    delete: function(item_tag) {
        $(item_tag).remove();
    },

    create_btn_init: function(btn) {
        $('body').on('click', btn, function(e) {
            e.preventDefault();
            var action = $(this).data('action');

            var show_modal = function(content) {
                modals.withFrom(item.create, content);
            };

            controls.ajax_action(action, 'GET', show_modal);
        })
    },

    delete_btn_init: function(btn) {
        $('body').on('click', btn, function(event) {
            event.preventDefault();
            var action = $(this).data('request');
            var removing_item_tag = $(this).data('item');
            var method = $(this).data('method');

            method = typeof method !== 'undefined' ? method : 'POST';

            var remove_item = function() {
                item.delete(removing_item_tag);
            };

            var show_error = function() {
                $('.status').html(data.responseText);
            };

            var action_function = function() {
                controls.ajax_action(action, method, remove_item, show_error);
            };

            modals.base(action_function, 'Подтвердите удаление', 'Объект будет удален', 'Удалить');
        })
    }
};


controls = {
    //Send simple AJAX request
    ajax_action: function(action, method, success_function, error_function, data) {
        data += '&_token=' + csrf_token;

        if(method.toUpperCase() !== 'GET' && method.toUpperCase() != 'POST'){
            data += '&_method=' + method;
            method = 'POST';
        }

        $.ajax({
            url: action,
            method: method,
            data: data,
            success: function(data) {
                success_function(data);
            },
            error: function(data) {
                error_function(data.responseText);
            }
        })
    }
};



/*
Media library functions
 */

media = {
    /**
     * Select image for removing
     * @param btn
     */
    select: function(btn) {
        $('body').on('click', btn, function(event) {
            event.preventDefault();
            $(this).parent().parent().parent().toggleClass('__active');
            media.showDeleteSelected();
        });
    },
    /*
    Send request on server to delete image
     */
    delete: function(){
        var itemForDelete = [];
        $('body').find('.media-item.__acitve').each(function(i,el){
            itemForDelete.push($(this).data('id'));
        })
    },
    /*
     Init btn for 1 image delete
     */
    deleteBtnInit: function(btn){
        $('body').on('click', btn, function(e){
            e.preventDefault();
            var id = $(this).data('id');
            media.delete(id);
        })
    },
    /*
    Init button to delete all selected imges
     */
    deleteSelectedInit: function(btn){
        $('body').on('click', btn, function(e){
            e.preventDefault();
            var itemForDelete = [];
            $('body').find('.media-item.__acitve').each(function(i,el){
                itemForDelete.push($(this).data('id'));
            });
            media.delete(itemForDelete);
        })
    },
    /*
    Upload new images
    */
    uploadPreview: function(el) {
        $(el).change(function(event) {
            var files = this.files;
            var container = $(this).parent().find('.media-preview-l');
            container.html('');
            $.each(files, function(index, val) {
                var image = new FileReader();
                image.onload = function(e) {
                   container.append('<li class="media-preview-i"><img src="'+e.target.result+'" alt=""></li>')
                };
                image.readAsDataURL(val);
            });
        });
    },
    checkAllBtnInit: function(btn){
        $('body').on('click', btn, function(e){
            e.preventDefault();
            console.log('click');
            $('body').find('.media-item').addClass('__active');
            media.showDeleteSelected();
        })
    },
    showDeleteSelected: function(){
        if ($('.media-item.__active').length > 0) {
            $('.js-delete-selected').slideDown();
        } else {
            $('.js-delete-selected').slideUp();
        }
    }
};

