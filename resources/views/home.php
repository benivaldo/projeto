<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Consulta de candidatos</title>
        <link href="app/assets/libs/bootstrap/css/bootstrap.css" rel="stylesheet" media="screen">
        <!-- Angular Material style sheet -->
     	<link rel="stylesheet" href="app/assets/libs/angular_material/css/angular-material.min.css">        
        <link rel="stylesheet" href="app/assets/css/app.css"/>
    </head>
    <body ng-app="TabApp" ng-cloak>
        <!-- main app container -->
         <div>
             <ng-view></ng-view>
         </div>
 
        <!-- In production use:
        <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.0.7/angular.min.js"></script>
        -->
       
		<!-- <script src="lib/jquery/jquery.min.js"></script>-->
		<!-- <script src="lib/bootstrap/js/ui-bootstrap-tpls-2.5.0.min"></script> -->
		
        <script type="text/javascript" src="app/assets/libs/angular/angular.js"></script>          
		<script src="app/assets/libs//angular/angular-route.js"></script>        
        <script src="app/assets/libs/angular/angular-animate.min.js"></script>
        <script src="app/assets/libs/angular//angular-touch.min.js"></script>
        <script src="app/assets/libs/angular/angular-aria.min.js"></script>
        <script src="app/assets/libs/angular/angular-messages.min.js"></script>        
        <script src="app/assets/libs/bootstrap/js/ui-bootstrap-tpls-2.5.0.min.js"></script> 
        <!-- Angular Material Library -->
        <script type="text/javascript" src="app/assets/libs/angular_material/angular-material.min.js"></script>
        <script src="app/assets/libs/dirPagination.js"></script>
        <script type="text/javascript" src="app/assets/js/app.js"></script>
        <script type="text/javascript" src="app/assets/js/config.js"></script>
        <script type="text/javascript" src="app/assets/js/directives/directives.js"></script>
        <script type="text/javascript" src="app/assets/js/services/services.js"></script>
        <script type="text/javascript" src="app/assets/js/factories/factories.js"></script>
        <script type="text/javascript" src="app/assets/js/controllers/controllers.js"></script>
        <script type="text/javascript" src="app/assets/js/filters/filters.js"></script>        
        <script type="text/javascript" src="app/assets/js/routes/routes.js"></script> 
                      
		<script type="text/javascript" src="app/partials/candidato/candidato.controller.js"></script>
    </body>
</html>