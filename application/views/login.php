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
<span>***************************************</span>
<form method='post' action='/Login/signup_user'>
	<p>username:<input type='email' name='username' required/></p>
	<p>password:<input type='text' name='password' required/></p>
	<p>firstname:<input type='text' name='firstname' required/></p>
	<p>lastname:<input type='text' name='lastname' required/></p>
	<p><input type='submit'/>sing up</p>
</form>
</body>
</html>


post 异步JS提交

php基本语法 常用函数 class定义

oob
继承 封装 多态

接口类 抽象类 继承父类




