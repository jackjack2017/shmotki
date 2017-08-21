/**
 * Use for show alerts
 *
 * @type {{success: Function, error: Function}}
 */
alerts = {
    /**
     * Show success alert
     * @param title
     * @param txt
     */
    success: function(title, txt) {
        var el = $('.alert-section');
        var alertHtml = '<div class="alert alert-success alert-dismissible"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon fa fa-close"></i></button> <h4 class="ttl"><i class="icon fa fa-check"></i>' + title + '</h4> <span class="txt">' + txt + '</span> </div>';
        var alertItem = el.append(alertHtml);
        $('.alert-success').slideDown();
        setTimeout(function() {
            $('.alert-success').first().slideUp(500, function() {
                $(this).remove();
            });
        }, 3000)
    },
    /**
     * Show error alert
     * @param title
     * @param txt
     */
    error: function(title, txt) {
        var el = $('.alert-section');
        var alertHtml = '<div class="alert alert-danger alert-dismissible"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"><i class="icon fa fa-close"></i></button> <h4 class="ttl"><i class="icon fa fa-ban"></i>' + title + '</h4> <span class="txt">' + txt + '</span> </div>';
        var alertItem = el.append(alertHtml);
        $('.alert-danger').slideDown();
    }

    
};