'use strict';


function gradient(config){
	console.log('gradient.js loaded');

	$(document).ready( function() {

		var documentHeight = $(document).height();
		$(config.navSelector).css('height', documentHeight);

		$( window ).resize( function() {
			var documentHeight = $(document).height();
			$(config.navSelector).css('height', documentHeight);
		});	

	});

}


export { gradient };