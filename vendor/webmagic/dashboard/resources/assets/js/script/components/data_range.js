/**
 * Range data picker init
 */
date_picker = {
    init: function() {
        $('.js_date_range_picker').daterangepicker({
            "singleDatePicker": true,
            "timePicker": true,
            "timePicker12Hour": false,
            "minDate": '2014-03-05',
            "startDate": '2014-03-05'
        },function(start, end, label) {
            $('.js_date_range_picker').val(start.format('YYYY/MM/DD/ HH:mm'))
            var End_date = start.format('MM/DD/YYYY');
            date_picker.end(End_date)
        });
    },

    end:function(End_date){
        if(End_date != undefined){
                    $('.js_date_range_picker-end').daterangepicker({
                        singleDatePicker: true, 
                        timePicker: true, 
                        "timePicker12Hour": false,
                        minDate: End_date,
                        startDate: End_date,
            },function(start, end, label) {
                $('.js_date_range_picker-end').val(start.format('YYYY/MM/DD/ HH:mm'))
            });
        }
    }
};

datatime_picker = {
        settings: function(){
          var dataTime = $('.js_date_range_picker').data('time');
          var dataDate = $('.js_date_range_picker').data('date');
          var dataFormat = $('.js_date_range_picker').data('format');
          datatime_picker.init(dataTime, dataDate, dataFormat);
        },
        init: function(timepick, datepick, dataFormat){
            $.datetimepicker.setLocale('ru');
            $('.js_date_range_picker').datetimepicker({
                dayOfWeekStart: 1,
                timepicker:timepick,
                datepicker:datepick,
                format: dataFormat,
                formatDate:dataFormat,
                onChangeDateTime: function(){
                    var dataTime = $('.js_date_range_picker-end').data('time');
                    var dataDate = $('.js_date_range_picker-end').data('date');
                    var format = $('.js_date_range_picker-end').data('format');
                    var dataformat= $('.js_date_range_picker').data('format');
                    var minDate = $('.js_date_range_picker').val();
                    datatime_picker.end(dataTime, dataDate, format, dataformat, minDate);
                    console.log(timepick, datepick, format, dataformat, minDate);
                }
            });
        },
        end:function(timepick, datepick, format, dataFormat, minDate){
       $('.js_date_range_picker-end').datetimepicker({
            timepicker:timepick,
            datepicker:datepick,
            format: format,
            formatDate:dataFormat,
            dayOfWeekStart: 1,
            minDate: minDate
        })
    },
}