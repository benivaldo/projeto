(function () {
	 'use strict';
  	 var httpHeaders, message, 
  	
  	 app = angular.module('TabApp', [
  	                                 'ui.bootstrap', 
  	                                 "ngRoute", 
  	                                 'ngMaterial', 
  	                                 'myApp.directives',  
  	                                 'myApp.filters', 
  	                                 'myApp.services', 
  	                                 'myApp.factories', 
  	                                 'myApp.controllers', 
  	                                 'candidato.controllers', 
  	                                 'myApp.routes', 
  	                                 'angularUtils.directives.dirPagination',
  	                                 'ngMessages', 
  	                                 'myapp.config'
  	                                
  	                                 ])
     
     app.config(function($mdThemingProvider) {

		  // Extend the red theme with a different color and make the contrast color black instead of white.
		  // For example: raised button text will be black instead of white.
		  var neonRedMap = $mdThemingProvider.extendPalette('red', {
		    '500': 'ffffff',
		    'contrastDefaultColor': 'dark'
		  });
		
		  // Register the new color palette map with the name <code>neonRed</code>
		  $mdThemingProvider.definePalette('neonRed', neonRedMap);

		  
		  //$mdThemingProvider.disableTheming();
		});
		
		/*app.run(['$templateCache', function ( $templateCache ) {
		    $templateCache.removeAll(); 
		 }]);*/
})();