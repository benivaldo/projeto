(function() {
	'use strict';
    var app = angular.module('candidato.controllers', []);
    app.controller('CandidatoListCtrl', function($scope, $rootScope, $http, $location, $sce, $templateRequest, $compile, httpEnv) {
        var load = function() {
            console.log('call load()...CAndidatos');
            $scope.data= {};
            
            httpEnv.send("GET", "/candidatos").then(function(data) {
            	console.log(data);
            	$scope.candidatos = data.resultSet;
            });
 
			$scope.sortType     = 'id'; // set the default sort type
			$scope.sortReverse  = false;  // set the default sort order
			$scope.searchCandidato   = '';     // set the default search/filter term
        }
        load();
 
        $scope.goBack = function() {
            //console.log('call editAlbum/'+index);
            var conteudo = angular.element( document.querySelector( '#aba_candidatos' ) );
            var html = 'partials/candidato/candidato.html';           
      
            var templateUrl = $sce.getTrustedResourceUrl(html);

        	$templateRequest(templateUrl).then(function(template) {
        		$compile(conteudo.html(template).contents())($scope);
            });
        }
        
        $rootScope.edit = function(index) {
            var conteudo = angular.element( document.querySelector( '#aba_candidatos' ) );
            var html = 'partials/candidato/candidato.edit.html';           
            $rootScope.id = index;            
            var templateUrl = $sce.getTrustedResourceUrl(html);

        	$templateRequest(templateUrl).then(function(template) {
  	        		$compile(conteudo.html(template).contents())($scope);
            });
        }
        
        $rootScope.add = function(index) {
            //console.log('call editAlbum/'+index);
            var conteudo = angular.element( document.querySelector( '#aba_candidatos' ) );
            var html = 'partials/candidato/candidato.add.html';           
            $rootScope.id = index;            
            var templateUrl = $sce.getTrustedResourceUrl(html);

        	$templateRequest(templateUrl).then(function(template) {
  	        		$compile(conteudo.html(template).contents())($scope);
            });
        }

        $scope.del = function(index) {
            console.log('call delete');           

            var resp = confirm("Tem certeza que deseja executar essa operação?");
            if (resp == true) {
            	httpEnv.send("DELETE", "/candidatos/" + index).then(function(data) {      
               	 alert(data.errorMessage);
                 load();
               });
            } else {
            	console.log('No cancela a operação');  
            }
        }

    });

    app.controller('EditCandidatoCtrl', function($scope, $rootScope, $http,  httpEnv) {
    	$scope.defaults = {
        	id: '',        	
        	email: '',
        	nome: ''        };
        
    	var load = function(id) {           	
            httpEnv.send("GET", "/candidatos/" + id).then(function(data) {
               	if (data ){
            		//console.log(data);
            		$scope.candidatos = angular.copy(data.resultSet);
            		$scope.header = $scope.candidatos.id;
            	} else {
            		//$scope.chamados = angular.copy($scope.defaults);
            		$scope.header = "Novo candidato";
            		$scope.disableBtn = true;
            	}
       		 	
       		 	$scope.urlInc = "/candidatos/0";
       		 	$scope.urlAlter = "/candidatos/"+$scope.candidatos.id;
       			$scope.urlNext = "/next/"+$scope.candidatos.id;;
       		 	$scope.urlPrev = "/prev/"+$scope.candidatos.id;
       		 	$scope.urlDel = $scope.candidatos.id;
            	//console.log(data);
            });
        };        
        load($rootScope.id);
        
        $scope.goNextPrev = function(link) {
        	httpEnv.send("GET", link).then(function(data) {
        		if (data != undefined){
        			console.log(data.id);
        			$rootScope.id = data.id;
        			load(data.id);
        		}
            });
        }
        
        $scope.submit = function() {
        	console.log($scope.candidatos);
        	httpEnv.send("PUT", "/candidatos/" + $rootScope.id, $scope.candidatos).then(function(data) {      
            	 alert(data.errorMessage);
            	 if (data.id > 0) {
            		 load(data.id);
            	 }            	 
            });
        };
    });
    
    app.controller('AddCandidatoCtrl', function($scope, $rootScope, $http, httpEnv) {
    	$scope.defaults = {
        	id: '',
         	email: '',
        	nome: ''
        };
   	
    	
    	var load = function(id) {           	
      
    
    		$scope.candidatos = angular.copy($scope.defaults);
    		$scope.header = "";
    		$scope.disableBtn = true;
        };        
        load();
        
        $scope.submit = function() {
        	//console.log($scope.chamados);
        	httpEnv.send("POST", "/candidatos", $scope.candidatos).then(function(data) {      
            	 alert(data.errorMessage);
            	 
            	 console.log(data.id);
            	 if (data.id > 0) {
            		 $rootScope.edit(data.id);
            	 }            	 
            });
        };
     });
}());