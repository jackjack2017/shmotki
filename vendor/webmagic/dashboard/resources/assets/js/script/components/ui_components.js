/**
 * User interface elements init
 * @type {{data_tables_init: Function, dependent_selects_init: Function, date_picker_init: Function}}
 */
ui = {
    data_tables_init: function(item) {
        $(item).DataTable({
            "language": {
                "lengthMenu": "Показывать по _MENU_",
                "zeroRecords": "Пока ничего нет",
                "info": "Показано _PAGE_ из _PAGES_",
                "infoEmpty": "Ничего не найдено",
                "infoFiltered": "(filtered from _MAX_ total records)",
                "search" : "Поиск",
                paginate: {
                    first: "Первая",
                    previous: "Предыдущая",
                    next: "Следующая",
                    last: "Последняя"
                }
            }
        });
    },

    /**
     * Init select with dependencies possibility
     */
    dependent_selects_init: function() {
        $('body').on('change', '.js_depend_select', function() {

            var depended_select = $($(this).data('depend'));
            $(depended_select).html('');

            var data_src = $(this).data('src') + '/' + $(this).val();

            controls.ajax_action(data_src, 'GET',
                function(data) {
                    var options = $.parseJSON(data);
                    if (options.length > 0) {
                        options.forEach(function(item) {
                            $(depended_select).prepend('<option value="' + item.id + '">' + item.name + '</option>');
                        });
                    }
                },
                function(errors) {
                    console.log(errors);
                }
            )
        });
    },

    
    /*Init editor for textarea*/
    editor_init: function(el) {
        //$(el).wysihtml5();
        // $(el).trumbowyg({
        //     lang: 'ru',
        //     autogrow: true
        // });

        CKEDITOR.basePath = document.location.origin + '/webmagic/dashboard';

        CKEDITOR.replace( el, {
             customConfig:'',
             stylesSet: false,
             title : false,
             language: 'ru',
             contentsCss : CKEDITOR.basePath  + '/css/style.css',
             allowedContent: true,
            toolbar : [
                	{ name: 'document', items : [ 'Source','-','Save','NewPage','DocProps','Preview','Print','-','Templates' ] },
                    { name: 'clipboard', items : [ 'Cut','Copy','Paste','PasteText','PasteFromWord','-','Undo','Redo' ] },
                    { name: 'editing', items : [ 'Find','Replace','-','SelectAll','-','SpellChecker', 'Scayt' ] },
                    { name: 'forms', items : [ 'Form', 'Checkbox', 'Radio', 'TextField', 'Textarea', 'Select', 'Button', 'ImageButton', 
                        'HiddenField' ] },
                    { name: 'basicstyles', items : [ 'Bold','Italic','Underline','Strike','Subscript','Superscript','-','RemoveFormat' ] },
                    { name: 'paragraph', items : [ 'NumberedList','BulletedList','-','-','CreateDiv',
                    '-','JustifyLeft','JustifyCenter','JustifyRight','JustifyBlock','-','BidiLtr','BidiRtl' ] },
                    { name: 'links', items : [ 'Link','Unlink', ] },
                    { name: 'insert', items : [ 'Image','Flash','Table','HorizontalRule','Smiley','SpecialChar','PageBreak','Iframe' ] },
                    { name: 'styles', items : [ 'Format','Font','FontSize' ] },
                    { name: 'colors', items : [ 'TextColor','BGColor' ] },
                    { name: 'tools', items : [ 'Maximize', 'ShowBlocks',] }
            ],
        });
    },

    /*Collapse all box in form edit*/
    box_collapse: function() {
        $('.with-collapse').find('.fa-minus').removeClass('fa-minus').addClass('fa-plus');
        $('.with-collapse').find('.box').addClass('collapsed-box');
    },

    selectEl : function(el){
        $(el).select2();
    },

    switchery : function(elements){
        $.each(elements, function(i,el){
            var sizeEl = $(el).data('size');
            var color = $(el).data('color');
            var secondaryColor = $(el).data('secondary');
            var jackColor = $(el).data('jack');

            var switchery = new Switchery(el,{
                size: sizeEl,
                color : color,
                secondaryColor : secondaryColor,
                jackColor: jackColor
            });
        })
    },
     color_picker: function(el){
        $(el).colorpicker();
    },
};