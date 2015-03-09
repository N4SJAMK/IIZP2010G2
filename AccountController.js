var app = angular.module('MainApp', ['ngRoute', 'ui.bootstrap']);

app.controller('TicketController', [ '$http', '$scope', function($http, $scope) {
         
		   $scope.GetQueue = [];
		   $scope.GetTicket = [];
		   $scope.GetArticle = [];
		   $scope.isCollapsed = false;
		   $scope.IdSelected = null;
		   
		   
		   $scope.QueueCall = function() { 
           $http.get('http://www.w3schools.com/website/Customers_JSON.php').success(function(data) {
		   $scope.GetQueue= data;
		    }); //http://127.0.0.1:8000/json*/
			}
			
		  // $scope.TicketCall = function() { 
		   $http.get('http://www.w3schools.com/website/Customers_JSON.php').success(function(data) {
		   $scope.GetArticle= data;
		    }); 
			
		   $http.get('http://www.w3schools.com/website/Customers_JSON.php').success(function(data) {
		   $scope.GetTicket= data;
		    }); 	
			//}
 $scope.deleteCall = function(IdSelected) {
    $http.delete('http://127.0.0.1:8080/api/queue/' + IdSelected)
        .success(function(data) {
            $scope.GetQueue = data;
            console.log(data);
        })
        .error(function(data) {
            console.log('Error: ' + data);
        });
};	

    }]);
	
	
	