<!DOCTYPE html>
<html>
<head>
	<title>Jobtip</title>
</head>
<body>

<h1>Hi, {{ $fname }}</h1>

<h2>Your profile has been created.</h2>
<p>
To reset your password <a href="{{ URL::to('reset/password/profile', array($token)) }}">click here</a>.
</p>
</body>
</html>