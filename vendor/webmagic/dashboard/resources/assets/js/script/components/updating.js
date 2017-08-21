function Updating(el){

   // Class of elements where will updates
   var label = $(el).data('class');

    this.success = function(data){
        $(label).html(data);
    }

    this.error = function(data){
        console.log('error update'); 
    }

     this.update = function() {

        if($(el).length > 0){

            // Doing the variables will submitig
            var error = this.error;
            var success = this.success; 
            // Url of route
            var url = $(el).data('url');
            var urlEL = url != undefined ? url : '/' ;
            // Method (post or get)
            var method = $(el).data('method');
            var methodEl =  method != undefined ? method : 'POST' ;
            // How often function will update
            var timeout = $(el).data('timeout'); 
            timeout = timeout != undefined ? timeout : 5000;

            var that = this;

            // Ajax submiting
            $.ajax({
                url: urlEL,
                method: methodEl,
                data : {_token: csrf_token },
                success: function(data){
                    that.success(data);
                },
                error : function(data){
                    that.error(data);
                }
            })
            // Function for call again 
            setTimeout(function() {
                that.update();
            }, timeout);    
        }
    }

    this.update();
}