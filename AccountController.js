var app = angular.module('MainApp', ['ngRoute', 'ui.bootstrap']);

app.controller('TicketController', [ '$http', '$scope', function($http, $scope) {
     
	    
	    $scope.Lista = [];
		$scope.GetUser = [];
		$scope.GetBoard = [];
		$scope.GetTicket = [];
		$scope.GetArticle = [];
		$scope.isCollapsed = false;
		$scope.IdSelected = null;  //ng-model = "id" //ng-model = "tickets"
		$scope.IdSelected2 = null;  
	    $scope.RowClick = null;
		
		
   
           $http.get('http://127.0.0.1:8080/api/queue/5').success(function(data2) {
		   $scope.GetUser= data2;
		   console.log($scope.GetUser);
		 //id = data.id;  //tickets = data.tickets; 
			}); 
 
 $scope.TicketCall = function (index, IdSelected, i, data, RowClick) {
   
    var data = data;
    $scope.IdSelected = IdSelected;
	$scope.RowClick = RowClick;
	$http.get('http://127.0.0.1:8080/api/queue/5').success(function(data2) {
		$scope.GetQueue = data2;  
	
		var url = data2[0].tickets;
		var arrayLength = url.length;
		console.log(url);
		angular.forEach(url, function TicketCall(IdSelected) { //(var i = 0; i < arrayLength; ++i) //  for (i in url) {
		$http.get('http://127.0.0.1:8080'+ IdSelected).success(function (data) {
        
		  $scope.GetBoard.push(data);
		})	
		 });  
		 });	 
	};
	
	$scope.ArticleCall = function (IdSelected2, RowClick) {
	     
		$http.get('http://127.0.0.1:8080/api/ticket/5').success(function(data) {
		
	    $scope.IdSelected2 = IdSelected2;
		var url2 = data[0].articles;
		//var arrayLength = url.length;
		console.log(url2);
		angular.forEach(url2, function ArticleCall(IdSelected2) { 
		 
		$http.get('http://127.0.0.1:8080'+ IdSelected2).success(function (data3) {
         $scope.GetArticle = data3;	
         // $scope.Lista = data;	
		  $scope.GetTicket.push(data3);
		console.log(data3);
	
		})
		 });
		
		 });
	 	};	  		
    }]);
	
	
	
