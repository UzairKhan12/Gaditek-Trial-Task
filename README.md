# Setup The Larvel Framework

After cloning the repository and branch (lumen-blog) install the lumen dependencies using the composer install command and after install all the dependencies, create a file .env in root directory and copy the contents from .env.example to .env file and change the database credentials and database name.

Also please copy the LUMEN_BLOG_API_KEY and LUMEN_BLOG_URL (the virtual host url that you created for the lumen application) from .env.example to .env, and you can find the api key in .env.example file to test the application, Api key has been used in the middleware of lumen api application.

Create a database in MySQL and run a php artisan migrate command to migrate the tables into database.

# How To Test

Goto the root directory of this project after setting it up and use the "php artisan blog:api" to run and test the application. 

# How To Create Virtual Host

127.0.0.1   blog.wrapper.lan

Add this in your hosts file of the operating system

<VirtualHost *:80>
DocumentRoot "Path_To_Project"
ServerName blog.wrapper.lan
<Directory "Path_To_Project">
</Directory>
</VirtualHost>

Add this configuration to your apache config into apache/conf/httpd-vhosts.conf file.

