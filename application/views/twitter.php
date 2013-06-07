<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

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
	$("#display_information").text(data);
}
});
}	
function fetch_followers_list(){alert("here");
var request = $.ajax({
	url:"/twitter/get_followers_list", 
	success: function(data){
	alert(data);
	$("#display_information").text(data);
}
});
}	
</script>

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
	
	<input type="button" value="post status" class="post_status" onclick='post_status();'/><br />
	<input type="button" value="get friends list" class="friends_list" onclick='fetch_friends_list();'/><br />
	<input type="button" value="get followers list" class="followers_list" onclick='fetch_followers_list();'/><br />
	<?php }?>
	</div>

	
	
	<div id="display_information">
</div>
</div>




</body>
</html>
