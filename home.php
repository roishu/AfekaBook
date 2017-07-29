<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link rel="stylesheet" href="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
  <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
  <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.4.8/angular.min.js"></script>
  <script src="js/home.js"></script>
  <script src="js/bootstrap-filestyle.min.js"></script>
</head>

<body ng-app="home" ng-controller="homeCtrl"  ng-init="loadUserDetails(); getGallery(); showMyFriends(); showAllPosts();" style ='background-color: #36465d;'>
	<!-- Modal - pop up with info -->
	<div class="modal fade"  id="infoAlert" role="dialog">
	    <div class="modal-dialog modal-sm">
	      <!-- Modal content-->
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Info</h4>
	        </div>
	        <div class="modal-body">
	          <p ng-model="modalBody" >{{modalBody}}</p>
	        </div>
	        <div class="modal-footer">
	          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        </div>
	      </div>
	    </div>
 	 </div>

	<div class='container'  id="coverProfile">	
	 
		<label>
		<img data-toggle="tooltip" id="profileCover" data-placement="bottom" title="Change cover picture" src="{{profilePic!=null && profilePic || 'images/defaultProfile.png'}}" 
		width='100%' height='250px' style="object-fit: cover;z-index: 0;position: absolute;">
		<img data-toggle="tooltip" id="profilePic" data-placement="bottom" title="Click to change profile picture" src="{{profilePic!=null && profilePic || 'images/defaultProfile.png'}}" 
		width='250' height='250px' style="object-fit: cover; border-radius: 50%;border: 5px solid white;z-index: 3;position: relative;">
			<input  onchange="angular.element(this).scope().fileSelected(this.files)" type="file" file-model="myFile" data-input="false" accept="image/*" style="display: none;">
		</label>
			<h1 style ='z-index: 1;position: absolute;display: inline-block; padding-left: 20px'><font color='white' > {{ firstName +" "+ lastName }}</font> </h1>
			<div class="topcorner"><a href="#" style="color: white;z-index: 2;" ng-click="logOut()" >Log out</a></div>
		</div>	
	
	<div class='container' >
		    <ul class='nav nav-tabs'>
		      <li class='active' target="content"><a data-toggle="tab" href='#timeLine'>Timeline</a></li>
		      <li><a data-toggle="tab" href='#friends'>Friends</a></li>
		      <li><a data-toggle="tab" href='#pictures'>Pictures</a></li>
			  <li><a data-toggle="tab" href='#about'>About</a></li>
		    </ul>
		    
		<div class="tab-content">
		
		    <div id="timeLine" class="tab-pane fade in active">
		      <br>
		      <div class="alert alert-info" >
			      <form role="form">
			      <div style="padding-bottom: 2px;">
			      	<textarea ng-init='whatsOnYourMind=""' ng-model="whatsOnYourMind" style="resize: none;" class="form-control" placeholder="What is on your mind?"></textarea>
			      </div>
			      
			      	<label  class="btn btn-primary btn-file">
					    <span data-toggle="tooltip" data-placement="top" title="Attach pictures" class="glyphicon glyphicon-paperclip"></span>
						<input data-toggle="tooltip" data-placement="bottom" title="Attach pictures" type="file" file-model="myFile"  data-input="false" accept="image/*" style="display: none;" multiple>
					</label>
					
					
			      	<button  ng-click="post()" class="btn btn-primary" type="file" file-model="myFile">Post</button>
			      	
					<div style="float:left; padding-right: 8px;" class="dropdown">
					  <button style="width: 150px;" ng-init="whoCanSee='Who can see this?'" class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">{{whoCanSee}}
					  <span class="caret"></span></button>
					  <ul class="dropdown-menu">
					    <li><a ng-init="publicPrivacy='Public'"ng-click="setPrivacy(publicPrivacy)" >{{publicPrivacy}}</a></li>
					    <li><a ng-init="onlyMePrivacy='Only me'"ng-click="setPrivacy(onlyMePrivacy)" >{{onlyMePrivacy}}</a></li>
					  </ul>
					</div>
					
					  <div style="float:left; padding-right: 4px; " class="dropdown">
					    <span data-toggle="tooltip" data-placement="top" title="Feelings"> <button  style="padding-bottom: 5px; " class="btn btn-primary dropdown-toggle glyphicon glyphicon-heart" data-toggle="dropdown"></button>
					   	
					   		<ul class="dropdown-menu multi-level" role="menu" aria-labelledby="dropdownMenu">
				              <li class="dropdown-submenu">
				                <a tabindex="-1" href="#">Feeling</a>
				                <ul class="dropdown-menu">
									<li><a href="#" ng-repeat="feel in feelings" ng-click="addEmotion('Feeling',feel)">{{feel}}</a></li>
				                </ul>
				              </li>
				              
				              <li class="dropdown-submenu">
				                <a tabindex="-1" href="#">Celebrating</a>
				                <ul class="dropdown-menu">
								  <li><a href="#" ng-repeat="celeb in celebrating" ng-click="addEmotion('Celebrating', celeb)">{{celeb}}</a></li>
				                </ul>
				              </li>
				              
				              <li class="dropdown-submenu">
				                <a tabindex="-1" href="#">Eating</a>
				                <ul class="dropdown-menu">
				                  <li><a href="#" ng-repeat="eat in eating" ng-click="addEmotion('Eating', eat)">{{eat}}</a></li>
				                </ul>
				              </li>
				              
				            </ul>			   
					  </div>
					  
			      </form>
		      </div>
		      
			<div style="padding-bottom: 20px;" ng-show="aletSomethingMissing">
				<p ng-model="postAlert" class="list-group-item list-group-item-danger">{{postAlert}}</p>
			</div>
			
		      
		      
		      <div ng-if="allPosts==''"><p class="list-group-item list-group-item-danger">Nothing to show here.. add some friends and/or post something</p></div>
		      
		      <div ng-repeat="post in allPosts" class="alert alert-success">
		      	<p ><strong>{{post.firstName +" "+ post.lastName}}</strong></p>
		      	<div ng-show="post.thePost.Publisher==myEmail">
			      	<li style="display: inline;" class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Privacy<span class="caret"></span></a>
					        <ul class="dropdown-menu">
					        <li><a ng-style="post.thePost.Privacy=='{{publicPrivacy}}' ?  { 'font-weight':'bold' } : { 'font-weight':'normal' }" ng-click="changePrivacy(post.thePost.Id, publicPrivacy)" href="#">{{publicPrivacy}}</a></li>
					        <li><a ng-style="post.thePost.Privacy=='{{onlyMePrivacy}}' ? { 'font-weight':'bold' } : { 'font-weight':'normal' }" ng-click="changePrivacy(post.thePost.Id, onlyMePrivacy)" href="#">{{onlyMePrivacy}}</a></li>
					</ul>
				</div>
		      	<br>
				<form style="padding-bottom: 5px;" role="form"> 
					<div style="padding-bottom: 2px;">
			      		<textarea rows="3" style="resize: none;" class="form-control" readonly>{{post.thePost.ThePost}}</textarea>
			      		<br>
			      		<gallery ng-show="post.photos!=''" style="margin:0px auto;" images=post.photos></gallery>
			      	</div>
					<a href='#' ng-click="addLike(post.thePost, myEmail)"><strong>Like</strong> <span class="badge">{{post.thePost.Likes}}</span></a>
				</form>
				
				<div ng-show="comment.theComment.PostId==post.thePost.Id" ng-repeat="comment in allComments" style="width: 90%; margin:5px auto;" class="alert alert-warning">
					<div >
						<p><strong>{{comment.firstName +" "+ comment.lastName}}</strong></p>
			      		<textarea style="resize: none;" class="form-control" readonly>{{comment.theComment.Comment}}</textarea>
			      	</div>
				</div>
				
				<div>
				<form role="form">
			      <div style="padding-bottom: 2px;">
			      	<textarea ng-init='comment=""' ng-model="comment" style="resize: none;" class="form-control" placeholder="Write a comment.."></textarea>
			      </div>
			      	<button ng-click="postComment(post.thePost.Id, myEmail, comment)" class="btn btn-info">Add comment</button>
			      </form>
				</div>
		      </div>
		    </div>
		    
		    <div  id="friends" class="tab-pane fade">
		    	<br>
				<div class="container-fluid">
				  <div class="row">
				    <div style="padding-bottom: 31px;" class="col-sm-4 alert alert-warning">
				    	<h3 style="color:black;" align="center">Add Friends</h3>
					    <input ng-model="findFriends" type="text" ng-keyup="showFriendsSuggestions()" placeholder="Search Friends" style="width:100%;">
						<a data-toggle="modal" data-target="#infoAlert" ng-repeat="friend in suggestedFirends" class="list-group-item list-group-item-success" ng-click="addFriend(friend.email)"> {{friend.firstName +" "+ friend.lastName}}</a>
						<p ng-hide="hideNoSuggestions" ng-init="hideNoSuggestions=1" class="list-group-item list-group-item-danger"> no suggestions</p>
					</div>
				    <div class="col-sm-8 alert alert-success">
				    	<h3 style="color:black;" align="center">My Friends</h3>
						<p ng-repeat="friend in myFriends" class="list-group-item list-group-item-info"><span class="glyphicon glyphicon-remove" aria-hidden="true" ng-click="removeFriend(friend)" style="cursor:pointer; float: right;" ></span><strong>{{friend.FirstName +" "+ friend.LastName}}</strong> </p>
						<p ng-hide="hideNoFriends" class="list-group-item list-group-item-danger">You don't have friends here.. Try to add some</p>
					</div>
				  </div>
				</div>
		    </div>
		    
		    <div id="pictures" class="tab-pane fade" >
		    	<br>
		    	<div class="bootstrap-filestyle input-group" style="margin:0px auto;">
 		    		<label stlye="display: inline;">
							<input type="file" file-model="myFile" class="filestyle" data-buttonName="btn-default" accept="image/*" multiple></label>
		    		<button style="float:right; width:115px;" class="btn btn-default" ng-click="uploadToGallery()">Upload</button>
		    	</div>
		    	<br>
				<gallery ng-show="myGallery!=''" ng-model="myGallery" style="margin:0px auto;" images=myGallery></gallery>	
		    </div>
		     
		    <div id="about" class="tab-pane fade">
		      <br>
		      <div class="alert alert-info">
			      <h3 style="color:black;">About</h3>
			      <table class="table ">
				  	<tbody>
	
				      <tr>
				        <td>First Name: </td>
				        <td>{{firstName}}</td>
				      </tr>
				      
				      <tr>
				        <td>Last Name:</td>
				        <td>{{lastName}}</td>
				      </tr>
				      
				      <tr>
				        <td>Birthday:</td>
				        <td>{{dob}}</td>
				      </tr>
				      
				      <tr>
				        <td>Gender:</td>
				        <td>{{gender}}</td>
				      </tr>
				      
				      <tr>
				        <td>Email:</td>
				        <td>{{myEmail}}</td>
				      </tr>
				      
				    </tbody>
				  </table>
			  </div>
		    </div>
	    </div>
	</div>
</body>
</html>




