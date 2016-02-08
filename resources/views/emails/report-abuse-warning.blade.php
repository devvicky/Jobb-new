<!DOCTYPE html>
<html>
<head>
	<title>Jobtip</title>
</head>
<body>

<h1>Hi, {{ $fname }}</h1>
 
<p>This is to inform you that your post contains one or more from the following.</p>

<ul>
	<li>Spam</li>
	<li>Abusive Post</li>
	<li>Abusive Profile</li>
</ul>

<p>Please review your post or else it will be removed.</p>

<h3>Post Detail:</h3>

{{$post->post_title}}<br/>
{{$post->unique_id}}


</body>
</html>