egg淘理财是一个理财产品查询网站，使用laravel开发。

项目名称：egg
使用组件：wnmp(windows nginx mysql php) composer 
使用框架：laravel

项目启动
将egg.sql导入egg数据库，windows环境下可以将wnmp.7z解压至c盘可免去此步骤
安装composer后，egg上运行命令：
php artisan key:generate 
php artisan config:cache

启动wnmp，浏览器访问
前台：http://localhost/  
后台：http://localhost/admin


