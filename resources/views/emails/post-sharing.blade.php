<!DOCTYPE html>
<html>
<head>
	<title>Jobtip</title>
</head>
<body>

<h1>Hi</h1>
 
<p>You are getting this mail because your friend "{{ $from_user }}" has shared the post below from Jobtip.</p>

<h3>Post Detail:</h3>

{{$post->post_title}}<br/>
{{$post->unique_id}}<br/>
{{$post->job_detail}}<br/>
{{$post->city}}


</body>
</html>