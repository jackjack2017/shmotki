document.addEventListener("DOMContentLoaded", function(event) {

    var popup = '<div id="popup_bg" style="width:100%; height: 100%; position: absolute;background: rgba(0,0,0,0.5); top:0; left: 0; z-index: 9999;"> <div style="position: relative; display: table; margin: 0 auto; width: 600px; height: 300px; margin-top: 150px;"><span id="popup_close" style="position: absolute; right: 2px; top: 2px; font-family: sans-serif; padding: 0px 5px; border-radius: 10px; background: #aeaeae; cursor: pointer; color: #fff;">x</span> <iframe src="http://way/remote_script_with_unique_id_form.js" frameborder="0" style="width: 600px; height: 300px;"></iframe> </div> </div>';


    var openPopup = function() {
        var btn = document.getElementById('remote-test-button');
        btn.addEventListener('click', function() {
            console.log(popup);
            document.body.innerHTML += popup;
            closePopup();
        })
    }

    var closePopup = function() {
        var close_btn = document.getElementById('popup_close');
        close_btn.addEventListener('click', function() {
            document.getElementById("popup_bg").remove();
            openPopup();
        })
    }
    openPopup();

});