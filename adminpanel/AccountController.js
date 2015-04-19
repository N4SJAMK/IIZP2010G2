var app = angular.module('MainApp', ['ngRoute', 'ui.bootstrap']);

app.controller('TicketController', [ '$http', '$scope', function($http, $scope) {
           
		   $scope.GetEvents = [];
		   $scope.GetUser = [];
		   $scope.GetTicket = [];
		   $scope.GetBoard = [];
		   $scope.Delete = [];
		  	$scope.Collapsed = true;
		   $scope.IdSelected = null;
		   $scope.IdSelected2 = null;
		   $scope.IdSelected3 = null;	   
		   
var logResult = function (str, data, status, headers)
    {
      return str + "\n\n" +
        "data: " + data + "\n\n" +
        "status: " + status + "\n\n" +
		"headers: " + headers +  "\n\n ;"
    };
	 $http.get('http://localhost:8001/api/events/').success(function(data) {
		   $scope.GetEvents = data;
		    });
		   
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
	email: $scope.Email,
	password: $scope.Password
	};

$http.post("http://localhost:8001/api/users/", PostParam) //'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'
	.success(function (data, status, headers, config)
	{
	
	PostParam = data;
	$scope.postCallResult = logResult("POST SUCCESS", data, status, headers);
	})
	.error(function (data, status, headers)
	{
	$scope.postCallResult = logResult("POST ERROR", data, status, headers);
	});
	};

	$scope.postdb = function() { 
	
	var PostParam = {
	file: $scope.file
	};

$http.post("http://localhost:8001/api/mongo/", PostParam) //'Content-Type':'application/x-www-form-urlencoded; charset=UTF-8'
	.success(function (data, status, headers, config)
	{
	
	PostParam = data;
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
$scope.UpdateUser = function(IdSelected) {
$http.get('http://localhost:8001/api/users/'+ IdSelected).success(function(data) {
		   $scope.GetPutData = data;
		    });
}
    }]);
	
	     

