function getDate(dateString){
	var date = new Date(dateString);
	var newDate = date.toLocaleTimeString()+" - "+ date.toLocaleDateString();
	return newDate;
}

function post(type,logo, name1, name2, time, text,comment,favorites) {
	var given = '<div class="post"><div class="post-content-container"><div class="post-header"><a class="profile-link" href=""><img class="profile-pic" src="';
	var logoLink = logo + '" alt=""><strong class="fullname">';
	var n1 = name1 + '</strong>@</b>';
	var n2 = name2 + '</a><img class="site-logo" src="'+type+'" alt=""><br></div><div class="post-content">';
	var content = text + '</div></div><div class="post-info">'+favorites+'<small class="time"><time datetime="' + time + '">'+getDate(time)+'</small><br>'+comment+'</div></div>';
	var combine = given + logoLink + n1 + n2 + content;
	return combine;
}

function postWithImg(type,logo, name1, name2, time, text, img,comment,favorites) {
	var given = '<div class="post"><div class="post-content-container"><div class="post-header"><a class="profile-link" href=""><img class="profile-pic" src="';
	var logoLink = logo + '" alt=""><strong class="fullname">';
	var n1 = name1 + '</strong>@</b>';
	var n2 = name2 + '</a><img class="site-logo" src="'+type+'" alt=""><br></div><div class="post-content">';
	var content = text + '</div><div class="preview"><img class="content-img" src="';
	var image = img + '" alt=""></div></div><div class="post-info">'+favorites+'<small class="time"><time datetime="' + time +'">'+getDate(time)+'</small><br>'+comment+'</div></div>';
	var combine = given + logoLink + n1 + n2 + content+image;
	return combine;
}
function postWithVideo(type,logo, name1, name2, time, text, vid,comment) {
	var given = '<div class="post"><div class="post-content-container"><div class="post-header"><a class="profile-link" href=""><img class="profile-pic" src="';
	var logoLink = logo + '" alt=""><strong class="fullname">';
	var n1 = name1 + '</strong>@</b>';
	var n2 = name2 + '</a><img class="site-logo" src="'+type+'" alt=""><br></div><div class="post-content">';
	var content = text + '</div><div class="preview"><video id="video" controls muted><source src="';
	var video = vid + '" type="video/mp4">Your browser does not support the video tag.</video></div></div>';
	var info ='<div class="post-info"><a>Likes</a><small class="time"><time datetime="'+ time +'">' +getDate(time)+'</small><br>'+comment+'</div></div>';
	var combine = given + logoLink + n1 + n2 + content+ video+info;
	return combine;
}
function getComment(comment){
	var comments = "";
	//console.log(comment);
	$.each(comment.data,function(key,val) {
		//console.log(val);
		var a = '<div class="comment" ><a class="profile-link" href=""><img class="profile-pic" src="';
		//console.log(val.from.profile_picture);
		//console.log(val.from.full_name);
		//console.log(val.text);
		var b = val.from.profile_picture+'" alt=""><strong class="fullname">'+val.from.full_name+'</strong></a><span>';
		var c = val.text+'</span></div>';
		var mix = a+b+c;
		//console.log("mix=========");
		//console.log(mix);
		comments+=mix;
	});
	//console.log(comments);
	return comments;
}
var postUrl= "http://ix.cs.uoregon.edu/~kho3/php/twitter/post.php";
//var updateUrl= "http://ix.cs.uoregon.edu/~kho3/php/twitter/update.php";
var instaUrl= "http://ix.cs.uoregon.edu/~kho3/php/instagram/instaPost.php";
var tweetLogo = "img/Twitter_logo_blue.png";
var instaLogo = "img/insta-login.png";

var json=[];
var timer;
function getTweets(url) {
	console.log("getting tweets......................");
	//console.log(url);
		$.getJSON(url, function(data) {
			var output = [];
			//console.log(d);
			$.each(data, function(key, val) {
				console.log(val);
				if($.inArray(val.id, json)>-1){
					//console.log("contain in json array");
					//console.log($.inArray(val.id, json));
					//console.log("contain in json array");
					return;
				}else{
					//console.log("not contain in json array");
					json.push(val.id);
					if (val.entities.hasOwnProperty('media')) {
						output.push(postWithImg(tweetLogo,
							val.user.profile_image_url_https,
							 val.user.name,
							  val.user.screen_name,
							   val.created_at,
							    val.text,
							     val.entities.media[0].media_url,
							     "",
							     '<a>'+val.retweet_count +' RETWEETS  '+val.favorite_count+' FAVORITES</a>'));
						//console.log("$('.status').after(postWithImg(val.user.profile_image_url_https, val.user.name, val.user.screen_name, val.created_at, val.text,val.entities.media.media_url));");
					} else {
						output.push(post(tweetLogo,
							val.user.profile_image_url_https,
							 val.user.name,
							  val.user.screen_name,
							   val.created_at,
							    val.text,
							    "",
							    '<a>'+val.retweet_count +' RETWEETS  '+val.favorite_count+' FAVORITES</a>'));
					}
				}
			});
			console.log(json);
			$("#home").append(output.join('')).slideDown('slow');
		});
	}
	function is_null(str){
		//console.log(str.text)
		return str==null? "" : str.text;
	}

function getInsta(url) {
	console.log("getting instagram......................");
	console.log(url);
		$.getJSON(url, function(data) {
			var output = [];
			$.each(data, function(key, val) {
				console.log(val);
				if (val.hasOwnProperty('videos')) {
					//console.log(val.videos.standard_resolution.url);
					console.log(is_null(val.caption));
					output.push(postWithVideo(
					instaLogo,
					val.user.profile_picture, 
					val.user.full_name, 
					val.user.username, 
					(parseInt(val.created_time)*1000), 
					is_null(val.caption), 
					val.videos.standard_resolution.url,
					getComment(val.comments),
					'<a>'+val.likes.count+' likes</a>'));
				}else{
					output.push(postWithImg(
					instaLogo,
					val.user.profile_picture, 
					val.user.full_name, 
					val.user.username, 
					(parseInt(val.created_time)*1000), 
					is_null(val.caption), 
					val.images.standard_resolution.url,
					getComment(val.comments),
					'<a>'+val.likes.count+' likes</a>'));
				}
				/*if($.inArray(val.id, json)>-1){
					//console.log("contain in json array");
					//console.log($.inArray(val.id, json));
					//console.log("contain in json array");
					return;
				}else{
					//console.log("not contain in json array");
					json.push(val.id);
					if (val.entities.hasOwnProperty('media')) {
						output.push(postWithImg(val.user.profile_image_url_https, val.user.name, val.user.screen_name, val.created_at, val.text, val.entities.media[0].media_url));
						//console.log("$('.status').after(postWithImg(val.user.profile_image_url_https, val.user.name, val.user.screen_name, val.created_at, val.text,val.entities.media.media_url));");
					} else {
						output.push(post(val.user.profile_image_url_https, val.user.name, val.user.screen_name, val.created_at, val.text));
					}
				}*/
			});
			//console.log(json);
			$("#home").append(output.join('')).slideDown('slow');
		});
	}
$(function() {
	console.log("starting timer");
	//set an interval to run the getTweets function (30,000 ms is 5 minutes), you can cancel the interval by calling clearInterval(timer);
	timer = setInterval(function(){getTweets();}, 50000);
	//run the getTweets function on document.ready
	getTweets(postUrl);
	getInsta(instaUrl);
});
function debug() {
	console.log("start function");
  $('#debug').load('php/twitter/debug.php');
}