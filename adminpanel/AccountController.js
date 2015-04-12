var app = angular.module('MainApp', ['ngRoute', 'ui.bootstrap']);

/*app.directive('myDialog', function() {
  
  return {
    restrict: 'E',
    transclude: true, 
	template: 'Collapse.html'
	};
	});*/
	
app.controller('TicketController', [ '$http', '$scope', function($http, $scope) {
         
		   $scope.GetUser = [];
		   $scope.GetTicket = [];
		   $scope.GetBoard = [];
		   $scope.Delete = [];
		  	$scope.Collapsed = true;
		   $scope.IdSelected = null;
		   $scope.IdSelected2 = null;
		   $scope.IdSelected3 = null;
		 //  $scope.Limit = 5;
		  
		/*  $scope.loadMore = function () {
      $scope.totalDisplayed += 5;  
    };*/
		   
var logResult = function (str, data, status, headers)
    {
      return str + "\n\n" +
        "data: " + data + "\n\n" +
        "status: " + status + "\n\n" +
		"headers: " + headers +  "\n\n ;"
    };
		   
		 $scope.Update = function() { 
           $http.get('http://localhost:8001/api/users').success(function(data) {
		   $scope.GetUser = data;
		  console.log($scope.GetUser);
		    }); //http://127.0.0.1:8000/json*/
				}
	    $scope.BoardCall = function(IdSelected) { 
		
		  $http.get('http://localhost:8001/api/users/' + IdSelected).success(function(data) {
		   $scope.GetBoard = data;
		   console.log(data);
		   });
		   
	$scope.GetBoard.length = 0;
			}
		$scope.TicketCall = function(IdSelected2) {
				   $http.get('http://localhost:8001/api/boards/' + IdSelected2).success(function(data) {
		   $scope.GetTicket = data;
		   console.log(IdSelected2);
		   console.log(data);
		    }); 	
			$scope.GetTicket.length = 0;
			}
	     
$scope.postCall = function() { 
	
	var PostParam = {
	Email: $scope.Email,
	Password: $scope.Password
	};
	//$scope.msg = {Email: $scope.Email,  password: $scope.Password};
	$scope.msg = JSON.stringify({Email: $scope.Email, Password: $scope.Password});
	//console.log(PostParam);
$http.post("http://localhost:8001/api/users/",{Email: $scope.Email, Password: $scope.Password}, PostParam,
{"headers" : { 'Content-Type': 'application/json;charset=utf-8', }}) //'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'
	.success(function (data, status, headers, config)
	{
	console.log($scope.msg);
	
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
	
