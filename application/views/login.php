<!DOCTYPE html>
<html lang='en'>
<head>
	<meta charset='UTF-8'>
	<title>Title</title>
</head>
<body>
<form method='post' action='/Login/login_input_data'>
	<p>username:<input type='email' name='username' required/></p>
	<p>password:<input type='text' name='password' required/></p>
	<p><input type='submit'/></p>
</form>
<span>***************************************</span>
<form method='post' action='/Login/change_password'>
	<p>username:<input type='email' name='username' required/></p>
	<p>old_password:<input type='text' name='old_password' required/></p>
	<p>new_password:<input type='text' name='new_password' required/></p>
	<p><input type='submit'/></p>
</form>
<span>***************************************</span>
<form method='post' action='/Login/delete_user'>
	<p>username:<input type='email' name='username' required/></p>
	<p><input type='submit'/>delete</p>
</form>
<span>***************************************</span>
<form method='post' action='/Login/search_user_info'>
	<p>username:<input type='email' name='username' required/></p>
	<p><input type='submit'/>search</p>
</form>
</body>
</html>
