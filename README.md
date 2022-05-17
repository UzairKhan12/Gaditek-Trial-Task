# Setup The Lumen Framework

After cloning the repository and branch (lumen-blog) install the lumen dependencies using the composer install command and after install all the dependencies, create a file .env in root directory and copy the contents from .env.example to .env file and change the database credentials and database name.

Create a database in MySQL and run a php artisan migrate command to migrate the tables into database

# How To Create Virtual Host

127.0.0.1   blog.api.lan

Add this in your hosts file of the operating system 

<VirtualHost *:80>
DocumentRoot "Path_To_Project"
ServerName blog.api.lan
<Directory "Path_To_Project">
</Directory>
</VirtualHost>

Add this configuration to your apache config into apache/conf/httpd-vhosts.conf file.

