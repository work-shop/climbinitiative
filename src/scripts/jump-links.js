'use strict';


function jumpLinks(config){
	console.log('jump-links.js loaded');

	$(document).ready( function() {

		$(config.selector).click(function(e){

			e.preventDefault();

			var offset = 0;
			var url = $(this).attr('href');
			var stateObj = {}; 

			if( $(window).width() > config.mobileBreakpoint ){
				offset = config.navHeight + config.jumpPadding;	
			} else{
				offset = config.mobileNavHeight + config.jumpPadding;	
			}

			if( config.preventUrlChange === false ){
				history.pushState( stateObj, '', url );
			}

			$('html,body').animate({
				scrollTop: $( url ).offset().top - offset
			}, config.transitionDuration );

		});

	});

}


export { jumpLinks };