(function() {

  'use strict';

  angular
    .module('myapp.config', [])
    .config(appConfig);

  function appConfig($routeProvider) {
    $routeProvider
      .when('/', {
        templateUrl: 'app/partials/home/home.view.html',
        controller: 'mainController',
        restrictions: {
          ensureAuthenticated: false,
          loginRedirect: false
        }
      })
      .when('/auth', {
        templateUrl: 'app/partials/auth/auth.login.view.html',
        controller: 'authLoginController',
        controllerAs: 'authLoginCtrl',
        restrictions: {
          ensureAuthenticated: false,
          loginRedirect: true
        }
      })
      .when('/register', {
        templateUrl: 'app/partials/auth/auth.register.view.html',
        controller: 'authRegisterController',
        controllerAs: 'authRegisterCtrl',
        restrictions: {
          ensureAuthenticated: false,
          loginRedirect: true
        }
      })
      .when('/status', {
        templateUrl: 'app/partials/auth/auth.status.view.html',
        controller: 'authStatusController',
        controllerAs: 'authStatusCtrl',
        restrictions: {
          ensureAuthenticated: true,
          loginRedirect: false
        }
      })
      .otherwise({
        redirectTo: '/auth'
      });
  }

 

})();
