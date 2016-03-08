###Importing db:
- create a schema in mysql by running `create schema oprp;` in phpmyadmin or in mysql-workbench or through mysql-cli.
- import oprp.sql in mysql db by running: `mysql -uroot -pYOUR-ROOT-PASSWORD oprp < oprp.sql` 
- edit \_php/config.php and change `DB_USER` `DB_PASS` with your db user and password
- change your admin email and password in oprp.user table by running: `update oprp.user set username="admin", email = "abc@xyz.com", password=sha("password") where user_id = 1;`
 

###Running and logging into admin interface:
- make sure your apache server is running
- put `oprp` folder into `/var/www/html` (or in htdocs folder for XAMPP users)
- open `http://localhost/oprp/` in your browser and use `admin` and `password` to login in admin panel.


###Creating student accounts:
- Go to Student tab (or open http://localhost/oprp/rm_admin/student_detail.php)
- click on `+` sign
- put the prefix, give the roll no range, select the course, year_of_passing and branch. eg (2k8, 101-105, BE, CO: the generated usernames will be like: 2K8CO101, 2K8CO102,...)
- click on Add
- The username and password will be same, which can be distributed to students and they can edit it while updating their profile 
- try to login with username:password = 2K8CO101:2K8101 after creating the account to see the student console


###Setting Online Compiler
- install the compilers on your machine for which you want to enable your online compiler
- you can install on linux using apt-get (sudo apt-get install gcc etc)
- edit oprp/online_compiler/_php/info.php and change the paths of compilers (in case of linus os, you won't be needing it to be changed)
- Now click on compiler (or open http://localhost/oprp/online_compiler/index.php) to acccess online compiler
- to test online compiler, try hello worlc of C (list is given at top of the compiler)
