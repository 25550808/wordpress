(function () {
	jQuery(document).ready(function($) {  
		 
		$('body').delegate(".input_datetime", 'hover', function(e){
	            e.preventDefault();
	            $(this).datepicker({
		               defaultDate: "",
		               dateFormat: "yy-mm-dd",
		               numberOfMonths: 1,
		               showButtonPanel: true,
	            });
         });

		var hides = ['ovitahealth_audio_link','ovitahealth_link_link','ovitahealth_link_text','ovitahealth_video_link','ovitahealth_gallery_files'];
		var shows = {
			audio:['ovitahealth_audio_link'],
			video:['ovitahealth_video_link','ovitahealth_video_text'],
			link:['ovitahealth_link_link'],
			gallery:['ovitahealth_gallery_files']	
		}
		$( '.post-type-post #post-formats-select input' ).click( function(){
			 $(hides).each( function( i, item ){
			 	$("[name="+item+']').parent().parent().hide();
			 } );
			 var s = $(this).val();
			 if( shows[s] != null ){
			 	$(shows[s]).each( function( i, is ){
			 		$("[name="+is+']').parent().parent().show();
				 } );
			 }
		} );
	});	
} )( jQuery );