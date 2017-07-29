var app = angular.module('startPage',[]);
	  
	  app.controller('signupCtrl',function($scope, $http,$window){
		  $scope.insertdata=function(){
			  $http.post("server/insert.php", {'fname':$scope.fname, 'lname':$scope.lname, 'dob':$scope.dob, 'email':$scope.email, 'pwd':$scope.pwd, 'gender':$scope.gender})
			  .success(function(data,status,headers,config){
				  if(data==1){ //registretion complete
						 $window.location.href = 'home.php';
				  }
					 else {
						 $scope.signUpStatus="Email alredy in use! please try another one";
					 }
			  });
	  	  }
		  
		  $scope.names = ["Male", "Female"];
		  
	  });   

  	app.controller('loginCtrl',function($scope, $http, $window){
	  $scope.login=function(){
		  $http.post("server/login.php", {'lemail':$scope.lemail, 'lpwd':$scope.lpwd})
		  .success(function(data,status,headers,config){
			 if(data==1) //user found
				 $window.location.href = 'home.php';
			 else
				 $scope.logInStatus="user not found";
		  });
  	  }
  	});
  	
  	