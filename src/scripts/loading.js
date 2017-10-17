"use strict";

module.exports = function( $ ) {
console.log('loading.js');
	function loadPage(){
		setTimeout(function(){
			$('.loading').addClass('loaded');
		},5000);
	}

	function setupLoading( selector ) {

		$( document ).ready( function() {
			loadPage();
		});

	}

	return {
		loadPage: loadPage,
		setupLoading: setupLoading
	};
};