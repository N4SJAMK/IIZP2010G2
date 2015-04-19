var app = angular.module('AppGet', ['ngRoute', 'ngResource']);

app.controller('UserController', [ '$http', '$scope', '$resource', function($http, $scope, $resource) {
       
		  $scope.GetPutData = [];
		  $scope.GetUsers = [];
		   $scope.IdSelected = null;
		   
  $http.get('http://localhost:8001/api/users/').success(function(data) {
		   $scope.GetUsers = data;
		    });
  $http.get('http://localhost:8001/api/boards/').success(function(data) {
		   $scope.GetPutData = data;
		    });
  
  var logResult = function (str, data, status)
    {
      return str + "\n\n" +
        "data: " + data + "\n\n" +
        "status: " + status + "\n\n" ;
    };

	
 $scope.putCall = function() { 
  
	
   var putParam = {
        email: $scope.putParam1,
        password: $scope.putParam2,
	  };    
    console.log($scope.putParam1, $scope.putParam2, $scope.BoardFilter);
 
    $http.put("http://localhost:8001/api/users/"+ $scope.BoardFilter, putParam)
        .success(function (data, status, headers, config)
        {
		 putParam = data;
         $scope.postCallResult = logResult("PUT SUCCESS", data, status, headers);
        })
        .error(function (data, status, headers)
        {
          $scope.postCallResult = logResult("PUT ERROR", data, status, headers);
        });
    };
	
	
 $scope.deleteCall = function(IdSelected) {
     $scope.IdSelected = IdSelected;

    $http.delete('http://localhost:8001/api/boards/' + IdSelected)
        .success(function(data) {
            $scope.GetData = data;
            console.log(data);
				 console.log(IdSelected);
        })
        .error(function(data) {
            console.log('Error: ' + data);
        });
};
		
 }]);
