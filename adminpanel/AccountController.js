var app = angular.module('MainApp', ['ngRoute', 'ui.bootstrap']);

app.controller('TicketController', [ '$http', '$scope', function($http, $scope) {
         
		   $scope.GetUser = [];
		   $scope.GetTicket = [];
		   $scope.GetBoard = [];
		   $scope.Delete = [];
		   $scope.isCollapsed = true;
		   $scope.IdSelected = null;
		   $scope.IdSelected2 = null;
		   $scope.IdSelected3 = null;
		   
var logResult = function (str, data, status)
    {
      return str + "\n\n" +
        "data: " + data + "\n\n" +
        "status: " + status + "\n\n" ;
    };
		   
		 $scope.Update = function() { 
           $http.get('http://localhost:8001/api/users').success(function(data) {
		   $scope.GetUser = data;
		  
		    }); //http://127.0.0.1:8000/json*/
				}
	    $scope.BoardCall = function(IdSelected) {  
		   $http.get('http://localhost:8001/api/users/' + IdSelected).success(function(data) {
		   $scope.GetBoard = data;
		   console.log(data);
		   
		    }); 
			}
		$scope.TicketCall = function(IdSelected2) {
		   $http.get('http://localhost:8001/api/boards/' + IdSelected2).success(function(data) {
		   $scope.GetTicket = data;
		   console.log(IdSelected2);
		   console.log(data);
		    }); 	
			}
	     
		 $scope.postCall = function() { 
			console.log($scope.postParam1);
	
			var PostParam = {
				Username: $scope.postParam1,
			};    
			$scope.msg = {Username: $scope.postParam1};
 
			$http.post("http://localhost:8001/api/users/", $scope.msg)
				.success(function (data, status, headers, config)
				{
				$scope.msg = data;
				$scope.postCallResult = logResult("POST SUCCESS", data, status, headers);
				})
				.error(function (data, status, headers)
				{
				$scope.postCallResult = logResult("POST ERROR", data, status, headers);
				});
		};

$scope.deleteCall = function(IdSelected3) {
    $http.delete('http://localhost:8001/api/users/' + IdSelected3)
        .success(function(data) {
            $scope.Delete = data;
            console.log($scope.Delete);
        })
        .error(function(data) {
            console.log('Error: ' + data);
        });
};	
$scope.deleteBoard = function(IdSelected3) {
    $http.delete('http://localhost:8001/api/boards/' + IdSelected3)
        .success(function(data) {
            $scope.Delete = data;
            console.log($scope.Delete);
        })
        .error(function(data) {
            console.log('Error: ' + data);
        });
};	
$scope.deleteTicket = function(IdSelected3) {
    $http.delete('http://localhost:8001/api/tickets/' + IdSelected3)
        .success(function(data) {
            $scope.Delete = data;
            console.log($scope.Delete);
        })
        .error(function(data) {
            console.log('Error: ' + data);
        });
};	

    }]);
	
