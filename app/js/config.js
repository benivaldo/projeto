(function() {

  'use strict';

  angular
    .module('myapp.config', [])
    .config(appConfig);

  function appConfig($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'partials/home/home.view.html',
        controller: 'mainController',
        restrictions: {
          ensureAuthenticated: false,
          loginRedirect: false
        }
      })
      .otherwise({
        redirectTo: '/'
      });
  }

 

})();
