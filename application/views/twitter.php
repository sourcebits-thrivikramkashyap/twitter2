<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Twitter Client</title>

	<style type="text/css">

	::selection{ background-color: #E13300; color: white; }
	::moz-selection{ background-color: #E13300; color: white; }
	::webkit-selection{ background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body{
		margin: 0 15px 0 15px;
	}
	
	p.footer{
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}
	
	#container{
		margin: 10px;
		border: 1px solid #D0D0D0;
		-webkit-box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
	
	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js">
</script>
<script type="text/javascript">
function connect_to_tw(){alert("here");
var request = $.ajax({
	url:"/twitter/connect", 
	success: function(data){
	alert(data);
	$("#display_information").text(data);
}
});
}	
function post_status(){alert("here"+ $("#tweet_message").val()+"additional text");
var request = $.ajax({
	url:"/twitter/post_status", 
	type:'POST',
	data:({        
        'message':$("#tweet_message").val()
    }),
	success: function(data){
	alert(data);
	$("#display_information").text(data);
}
});
}	
function fetch_friends_list(){alert("here");
var request = $.ajax({
	url:"/twitter/get_friends_list", 
	success: function(data){
	alert(data);

	var obj = jQuery.parseJSON(data);alert(obj.users[0].id);	
	alert(typeof obj.users[0]);

	var html = "<table border=1>";
	html = html+"<th>id</th><th>screen_name</th><th>followers_count</th><th>friends_count</th>";
	html = html+"<th>statuses_count</th>";
				
		for(var i=0;i<obj.users.length;i++)
		{
			var follower = obj.users[i];
			var html= html+"<tr><td>"+follower.id+"</td><td>"+follower.screen_name+"</td>";
			html = html + "<td>"+follower.followers_count+"</td><td>"+follower.friends_count+"</td>";
			html = html + "<td>"+follower.statuses_count+"</td></tr>";		
		}
		var html = html+"</table>";
		$("#display_information").html(html);
}
});
}	
function fetch_followers_list(){alert("here in fetch_followers_list");
var request = $.ajax({
	url:"/twitter/get_followers_list", 
	success: function(data){
	alert(data);	
	var obj = jQuery.parseJSON(data);alert(obj.users[0].id);	
alert(typeof obj.users[0]);

var html = "<table border=1>";
html = html+"<th>id</th><th>screen_name</th><th>followers_count</th><th>friends_count</th>";
html = html+"<th>statuses_count</th>";
			
	for(var i=0;i<obj.users.length;i++)
	{
		var follower = obj.users[i];
		var html= html+"<tr><td>"+follower.id+"</td><td>"+follower.screen_name+"</td>";
		html = html + "<td>"+follower.followers_count+"</td><td>"+follower.friends_count+"</td>";
		html = html + "<td>"+follower.statuses_count+"</td></tr>";		
	}
	var html = html+"</table>";
	$("#display_information").html(html);
	
	
}
});
}	
</script>

<style>
.button {
   border-top: 1px solid #96d1f8;
   background: #65a9d7;
   background: -webkit-gradient(linear, left top, left bottom, from(#3e779d), to(#65a9d7));
   background: -webkit-linear-gradient(top, #3e779d, #65a9d7);
   background: -moz-linear-gradient(top, #3e779d, #65a9d7);
   background: -ms-linear-gradient(top, #3e779d, #65a9d7);
   background: -o-linear-gradient(top, #3e779d, #65a9d7);
   padding: 5px 10px;
   -webkit-border-radius: 8px;
   -moz-border-radius: 8px;
   border-radius: 8px;
   -webkit-box-shadow: rgba(0,0,0,1) 0 1px 0;
   -moz-box-shadow: rgba(0,0,0,1) 0 1px 0;
   box-shadow: rgba(0,0,0,1) 0 1px 0;
   text-shadow: rgba(0,0,0,.4) 0 1px 0;
   color: white;
   font-size: 14px;
   font-family: Georgia, serif;
   text-decoration: none;
   vertical-align: middle;
   }
.button:hover {
   border-top-color: #28597a;
   background: #28597a;
   color: #ccc;
   }
.button:active {
   border-top-color: #1b435e;
   background: #1b435e;
   }
</style>
</head>
<body>

<div id="container">
<?php if ($this->session->userdata('username') != null){ ?>
	<h1>Welcome <?php echo $this->session->userdata('username');?></h1>
<?php }?>

	<div id="body">
	<?php if ($this->session->userdata('username') == null){ ?>
	<form action="/twitter/connect" method="post">
	<input type="submit" value="sign in via twitter" class="sign_in_via_twitter" /><br />	
	</form>
	<?php }?>
	
	<?php if($this->session->userdata('username') != null){?>
	<label>Enter tweet <br />
	<textarea rows="2" cols="70" id="tweet_message" class="tweet_message"></textarea>
	</label>
	
	<div id ="menu" >
	<ul style="list-style-type: none;">
	<li><input type="button" value="post status" class="post_status button" onclick='post_status();'/><br /></li>
	<li><input type="button" value="get friends list" class="friends_list button" onclick='fetch_friends_list();'/><br /></li>
	<li><input type="button" value="get followers list" class="followers_list button" onclick='fetch_followers_list();'/><br /></li>
	</ul>
	</div>
	<?php }?>
	
	</div>

	
	
	<div id="display_information">
</div>
</div>




</body>
</html>
