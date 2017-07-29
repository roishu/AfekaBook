var app = angular.module('home',[]);
	  
	app.controller('homeCtrl',function($scope, $http, $window ){

		$scope.feelings=['happy', 'sad', 'tired' , 'great', 'wonderful', 'excited', 'sorry', 'loved'];
		$scope.celebrating=['a birthday', 'father\'s day', 'success', 'big day', 'victory'];
		$scope.eating=['pizza', 'humburger', 'salad', 'eggs', 'pasta', 'sushi', 'steak']; 
		
		//to load "about" details and profile pic
		  $scope.loadUserDetails = function() {
			  $http.post("server/getUser.php")
			  .success(function(data,status,headers,config){
				 $scope.firstName = data.firstName;
				 $scope.lastName = data.lastName;
				 $scope.myEmail=data.email;
				 $scope.dob = data.dob;
				 $scope.gender = data.gender;
				 if (data.profilePic != null)
					 $scope.profilePic = data.profilePic;
				 else
					 $scope.profilePic = "images/defaultProfile.png";
					
			  });
		  };
		   
		// get suggested friends names from server and store the dada in firendsList and displays it via ng-repeat directive;
	    // show/hide 'no suggestions' message accordingly via ng-hide directive
  		$scope.showFriendsSuggestions = function() {
  			var str =$scope.findFriends;
  			if(str.length == 0){
  				$scope.suggestedFirends='';	
  				$scope.hideNoSuggestions=1;
  			}
  			else{
  				$http.get("server/gethint.php?q=" + str).success(function(data){
  					if(data.length>0){
  						$scope.suggestedFirends=data;
  						$scope.hideNoSuggestions=1;  						
  					}
  					else{
  						$scope.suggestedFirends='';
  						$scope.hideNoSuggestions=0; //show 'no suggestions' message
  					}
    	        });
  			}
		};	
		
		// add friend to DB by sending the email of the clicked friend and calls showMyFriends() to show the updates friends list
		$scope.addFriend = function (email){
			$http.get("server/addFriend.php?q="+email).success(function(data){
				$scope.modalBody = "Friend added successfully";
				$scope.suggestedFirends='';
				$scope.findFriends='';
				$scope.showMyFriends();
	        });
		};
		
		// show friends list in "myFriends"
		$scope.showMyFriends = function(){
			$http.get("server/getMyFriends.php").success(function(data){
				if(data.length==0){
					$scope.hideNoFriends=0;
					$scope.myFriends=data;
					$scope.showAllPosts();
				}
				else{
					$scope.hideNoFriends=1;
					$scope.myFriends=data;
					$scope.showAllPosts();
				}
	        });
		};
		
		//saevs the post in the db 
		$scope.post = function(){
			if($scope.whoCanSee!='Who can see this?' && $scope.whatsOnYourMind.length>0){
				if(emotionToPrint!=''){
					$scope.whatsOnYourMind+="\n\n"+emotionToPrint;
					emotionToPrint='';
				}
				$http.post("server/post.php", {'post':$scope.whatsOnYourMind, 'privacy' : $scope.whoCanSee}).success(function(postId){
					$scope.whatsOnYourMind = "";
					$scope.whoCanSee='Who can see this?'
					$scope.aletSomethingMissing=0;
					
					if($scope.myFile!=undefined){
						$scope.uploadToGalleryFromPost(postId);
					}
					$scope.showAllPosts();
		        });
			}
			else if($scope.whatsOnYourMind.length>0 && $scope.whoCanSee=='Who can see this?' ){
				$scope.aletSomethingMissing=1;
				$scope.postAlert="Please select privacy";
			}
			else{
				$scope.aletSomethingMissing=1;
				$scope.postAlert="Sorry can\'t post an empty post";
			}
		};
	
		//set the privacy text in the privacy drop-menu
		$scope.setPrivacy = function(privacy){
			$scope.whoCanSee = privacy;
		}
		
		//shows all public and user's posts
		$scope.showAllPosts = function(){
			$http.post("server/getAllPublicPosts.php").success(function(data){
				$scope.allPosts=data;
				$scope.getAllComments();
	        });
		}
		
		//add like to a post
		$scope.addLike = function(post, publisher){
			$http.post("server/addLike.php", {'postId':post.Id, 'publisher':publisher}).success(function(data){
				if(data!=0)
					post.Likes=data.numOfLikes;
				else
					post.Likes=(data);
			});
		}
			
		//change the privacy of the selected post 
		$scope.changePrivacy = function(postId, selectedPrivacy){
		$http.post("server/changePrivacy.php", {'postId':postId, 'privacy':selectedPrivacy}).success(function(data){
				$scope.showAllPosts();
	        });
		}
	
		//post new comment 
		$scope.postComment = function(postId, publisher, comment){
			$http.post("server/postComment.php", {'postId':postId, 'publisher':publisher, 'comment':comment})
			.success(function(data){
				$scope.showAllPosts()
	        });
		}
		
		//gets all comments from db
		$scope.getAllComments = function(){
			$http.post("server/getAllComments.php").success(function(data){
				$scope.allComments = data;
	        });
		}
		
		// remove a friend from db and refresh the friends list
		$scope.removeFriend = function(friend){
			$http.get("server/removeFriend.php?q="+friend.Email).success(function(data){
				$scope.showMyFriends();
			});
		}

		// upload gallery photos to the server and add src link in the db
		$scope.uploadToGallery = function(){
			var file = $scope.myFile;
            var uploadUrl = "server/uploadToGallery.php";
            $scope.uploadFileToUrl(file, uploadUrl); 
		};
		
		$scope.myGallery =[];
		
		//gets all gallery photos links from db
		$scope.getGallery = function(){
			$http.post("server/getGallery.php")
			.success(function(data){
				$scope.myGallery = data;
	        })
		};
		
		// executes when file is selected in the profile pic change
		$scope.fileSelected = function(file) {
			  var uploadUrl = "server/uploadProfile.php";
			  $scope.uploadFileToUrl(file, uploadUrl);
			}
		
		$scope.uploadFileToUrl = function(files, uploadUrl){
	    	  angular.forEach(files, function(file, key) {
	    		  var fd = new FormData();
	    		  fd.append('file', file);
	    		  $http.post(uploadUrl, fd, {
	    			  transformRequest: angular.identity,
	    			  headers: {'Content-Type': undefined}
	    		  })
	    		  .success(function(data){
	    			  $scope.loadUserDetails();
	    			  $scope.getGallery();
	    			  $scope.myFile = undefined;
	    		  })
	    	  });
	      };  
		
	      $scope.uploadToGalleryFromPost = function(postId){
				var file = $scope.myFile;
	            var uploadUrl = "server/uploadToGalleryFromPost.php";
	            $scope.uploadFileToUrl2(file, uploadUrl); 
			};
			
			
		$scope.uploadFileToUrl2 = function(files, uploadUrl){
	    	  angular.forEach(files, function(file, key) {
	    		  var fd = new FormData();
	    		  fd.append('file', file);
	    		  $http.post(uploadUrl, fd,  {
	    			  transformRequest: angular.identity,
	    			  headers: {'Content-Type': undefined}
	    		  })
	    		  .success(function(data){
	    			  $scope.getGallery();
	    			  $scope.showAllPosts();
	    			  
	    		  })
	    	  });
	      };  
	      
	      var emotionToPrint='';
	      $scope.addEmotion = function(state,emotion){
	    	  emotionToPrint="* "+ state+"- "+ emotion +" *";
	      }
	      
	      $scope.logOut = function(){
	    	  $http.post("server/logOut.php").success(function(){
	    		  $window.location.href = 'index.html';
		        });
	      }
		      
		      
	  }); // end controller
	  	  
     app.directive('fileModel', ['$parse', function ($parse) {
         return {
            restrict: 'A',
            link: function(scope, element, attrs) {
               var model = $parse(attrs.fileModel);
               var modelSetter = model.assign;
               
               element.bind('change', function(){
                  scope.$apply(function(){
                     modelSetter(scope, element[0].files);
                  });
               });
            }
         };
      }]);
     
     app.directive('gallery', function() {
    	  return {
    	    templateUrl: 'imageGallery.html', 
    	    replace: true,
    	    scope: { images: '=' },
    	    restrict: 'E',
    	    controller: function($scope) {
    	      $scope.selectedImage = $scope.images[0];
    	      $scope.setImage = function(image) {
    	      $scope.selectedImage = image;
    	      }
    	    }
    	  };
     	});
     
     $(document).ready(function(){
    	    $('[data-toggle="tooltip"]').tooltip();
    	});
     
     $(document).ready(function(){
    	  $('.dropdown-submenu a.test').on("click", function(e){
    	    $(this).next('ul').toggle();
    	    e.stopPropagation();
    	    e.preventDefault();
    
    	  });
    	});