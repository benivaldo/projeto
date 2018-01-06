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
     
  	 app.constant("config", {
  		 appName: "Candidatos",
	     appVersion: 1.0,
	     apiUrl: "http://localhost:8200"
	 });
  	 
     app.config(function($mdThemingProvider) {
		  var neonRedMap = $mdThemingProvider.extendPalette('red', {
		    '500': 'ffffff',
		    'contrastDefaultColor': 'dark'
		  });
		  $mdThemingProvider.definePalette('neonRed', neonRedMap);
		  //$mdThemingProvider.disableTheming();
		});
		
		/*app.run(['$templateCache', function ( $templateCache ) {
		    $templateCache.removeAll(); 
		 }]);*/
})();