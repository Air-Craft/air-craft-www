/* <![CDATA[ */
(function($){
	
	"use strict";

    $(function () {

        // add demo name to install button
        function addName (str) {
            str = str.toLowerCase().replace(/\b[a-z]/g, function(letter) {
                return letter.toUpperCase();
            });
            var arr = str.split("");
            arr.splice(4, 0, " ");
            str = arr.join("");
            str = 'Install ' + str;
            $("#submit").val(str);
        }
        $( "#coll-demos-form input.coll-choose-demo" ).on( "click", function(){
            addName($(this).val())
        } );
        addName('demo0');


        // alert
		$("#coll-demos-form").submit(function(e){
			
			if ( !confirm("Are you sure? The import will start immediately.\n\nDO NOT navigate away fron this page until you see the SUCCESS MESSAGE") ) {
				e.preventDefault();
				return;
			} 
			
		});
		
	});

})(jQuery);
 /* ]]> */	