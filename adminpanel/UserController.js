var app = angular.module('AppGet', ['ngRoute', 'ngResource']);

app.controller('UserController', [ '$http', '$scope', '$resource', function($http, $scope, $resource) {

           var GetData = this;
		   $scope.GetData = [];
		   $scope.IdSelected = null;
		   
  $http.get('http://localhost:8001/api/users/').success(function(data) {
		   $scope.GetData = data;
		    }); //http://127.0.0.1:8000/json*/
  
  var logResult = function (str, data, status)
    {
      return str + "\n\n" +
        "data: " + data + "\n\n" +
        "status: " + status + "\n\n" ;
    };
  
 $scope.postCall = function() { 
      console.log($scope.postParam1, $scope.postParam2, $scope.postParam3);
	
   var PostParam = {
        Username: $scope.postParam1,
        Password: $scope.postParam2,
		Adminlevel: $scope.postParam3
	  };    
    $scope.msg = {Username: $scope.postParam1, Password: $scope.postParam2, Adminlevel: $scope.postParam3};
 
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
	
 $scope.putCall = function() { 
    //  console.log($scope.putParam1, $scope.putParam2, $scope.putParam3);
	
   var putParam = {
        Username: $scope.putParam1,
        Password: $scope.putParam2,
		Adminlevel: $scope.putParam3
	  };    
    $scope.msg = {Username: $scope.putParam1, Password: $scope.putParam2, Adminlevel: $scope.putParam3};
 
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
	
	
 $scope.deleteCall = function(IdSelected) {
     $scope.IdSelected = IdSelected;

    $http.delete('http://localhost:8001/api/users/' + IdSelected)
        .success(function(data) {
            $scope.GetData = data;
            console.log(data);
				 console.log(IdSelected);
        })
        .error(function(data) {
            console.log('Error: ' + data);
        });
};
$scope.update = function() {
  $http.get('http://localhost:8001/api/users/').success(function(data) {
		   $scope.GetData= data;
		   console.table(data);
		    }); //http://127.0.0.1:8000/json*/
}

  /*$scope.deleteCall = function($resource) {
 
	    $scope.id = '@id';
		var DeleteParam = {
		id: $scope.id
  		 }
     	$scope.msg = {id: $Scope.id};
	
	return  $resource('http://127.0.0.1:8000/json/users/:id', {id: $scope.id},
		{'Delete': {method: 'DELETE', params: {id: $scope.msg}} //{Id: '@Id'}
		});
		}
		*/			
 }]);
