## Importing db
- create a schema in mysql by running `create schema oprp;` in phpmyadmin or in mysql-workbench or through mysql-cli.
- import oprp.sql in mysql db by running: `mysql -uroot -pYOUR-ROOT-PASSWORD oprp < oprp.sql` 
- edit \_php/config.php and change `DB_USER` `DB_PASS` with your db user and password
- change your admin email and password in oprp.user table by running: `update oprp.user set username="admin", email = "abc@xyz.com", password=sha("password") where user_id = 1;`
 

## Running and logging into admin interface
- make sure your apache server is running
- put `oprp` folder into `/var/www/html` (or in htdocs folder for XAMPP users)
- open `http://localhost/oprp/` in your browser and use `admin` and `password` to login in admin panel.

