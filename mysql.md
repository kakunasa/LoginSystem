### mysql事务
*开启事务 start transaction*  
*设置保存点 savepoint point_name*  
*回滚到保存点 rollback to point_name*  
*提交 永久修改 无法回滚 commit*  
```sql
start transaction;
savepoint p01;
insert into tbl_user (username,password) values ("kaku@dmail.com","passpass");
savepoint p02;
insert into tbl_user (username,password) values ("kakunasa@dmail.com","passpassword");
savepoint p03;
insert into tbl_user (username,password) values ("kakugwc@dmail.com","12481632");
savepoint p04;
commit;
```

### mysql事务隔离级别

### 视图
*过滤好的复合条件的结果集*  
```sql
create view view_user3 (v_pwd,v_name) as select password,username from tbl_user where password="password";
insert into `view_user3` (v_pwd,v_name) values ("123456","kakakaka");   //满足基本表的规则时,可以通过视图对基本表增删改
```
### 锁机制

### 修改
```sql
update tbl_user set password="123456" where user_id=21;
```

### 查询
```sql
select * from tbl_user where password='password';
select * from tbl_user where password='password' and id=10;
select * from tbl_user where password='password' or name="kaku";
```
```sql
select * from tbl_user where username in('kakunasa','ccc','ddd','eee');
```
```sql
select `password` , count(password) as c,any_value(`created_time`) as a from tbl_user GROUP BY `password`;
```
```sql
select password ,user_id from tbl_user where password='password' limit 0,2;   //从索引为1的数据开始取2条数据
```
#### 时间戳转换
```sql
select current_timestamp();   //获得当前时间 2022-08-30 14:48:59
select unix_timestamp();   //1661838108
select from_unixtime(1661838108,"%Y %D %M %H:%I:%S");   //2022 30th August 14:02:48
```
#### 联合查询
```sql
select username from tbl_user union select username from tbl_user_info;   //union联合查询默认去重
```
#### 去重
```sql
select distinct username from tbl_user;
```
#### join拼接表
```sql
select a.username as aaa,b.username as bbb ,a.password as pwd from tbl_user a right join tbl_user_info b on a.username = b.username;

select a.username as aaa,b.username as bbb ,a.password as pwd from tbl_user a inner join tbl_user_info b on a.username = b.username;

select a.username as aaa,b.username as bbb ,a.password as pwd from tbl_user a join tbl_user_info b on a.username = b.username;   //join默认为inner join
```
#### group by
```sql
select max(id) as a from tbl_user group by risk_rank having a>1020 order by a;   //group by配合聚合函数(max min sum avg)利用分组信息进行统计，使用聚合函数后用having过滤
```
### 添加
```sql
insert into `tbl_user` (password,username) values ("123456","kakakakaka2"),("123456","kakakakaka1");   //一次插入多条
```
### mysql关键字执行顺序
```sql
select -> from -> where -> group by -> having -> order by
from -> where -> group by -> having -> select -> order by
```
