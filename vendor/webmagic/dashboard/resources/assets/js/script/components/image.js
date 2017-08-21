/**
 * Use for preview images before sending
 *
 * @type {{uploadPreview: Function}}
 */

//todo Try use third part plugin for this functionality
image = {
    /** Upload new images **/
    uploadPreview: function (el) {
        $(el).change(function () {
            var files = this.files;
            var container = $($(this).data('preview'));
            container.html('');
            $.each(files, function (index, val) {
                var image = new FileReader();
                image.onload = function (e) {
                    container.append('<div class="img-blk"><img class="img-responsive" src="' + e.target.result + '" alt=""></div>')
                };
                image.readAsDataURL(val);
            });
        });
    }
}