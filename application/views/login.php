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


post 异步JS提交




mysql curd 常见的查询语句

where 多条件 and or
where in
has
join left/right join
去重查询
count
max min
top
order by
limit offset
group by 分类汇总 sum 加减乘除 平均值
时间戳互转时间
union

SELECT password , count(password) FROM tbl_user GROUP BY password;

select password ,user_id from tbl_user where password='password' limit 1;

select `password` , count(password) as c,any_value(`created_time`) as aaa from tbl_user GROUP BY `password`;

select `password` , count(password) as c,any_value(`user_id`) as user_id from tbl_user GROUP BY `password`;

select tbl_user.username as aaa,tbl_user_info.username as bbb ,tbl_user.password as pwd from tbl_user left join tbl_user_info on tbl_user.username = tbl_user_info.username;

select a.username as aaa,b.username as bbb ,a.password as pwd from tbl_user a right join tbl_user_info b on a.username = b.username;

select a.username as aaa,b.username as bbb ,a.password as pwd from tbl_user a inner join tbl_user_info b on a.username = b.username;

select a.username as aaa,b.username as bbb ,a.password as pwd from tbl_user a join tbl_user_info b on a.username = b.username;

update tbl_user set password='123456' , created_time=current_timestamp where user_id=8;

事务

表的概念
视图概念

锁机制





php基本语法 常用函数 class定义

oob
继承 封装 多态

接口类 抽象类 继承父类




