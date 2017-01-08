##################################################################################################################
This webapp developed for the use of   Rule Engine for Building Information Systems  in its office.
The overall system is developed using the MVC approach with the Codeigniter Framework. 
The complete source code and the data associated is the property of  XYZ.
##################################################################################################################

Steps to configure this webbapp on linux based server.

1. Place the extracted contents in a folder that is linked to domain name of the website.

2. Import the provided .sql file in your MYSQL server. 

3. Navigate to the folder application\config\database.php and edit the parameters of database confuration array "$db['default']" according to your server. Enter the name of database you just imported the data in MySQL, and the username, password of the user that has access to the database.

4. Now navigate the domain name / address in your browser and the website should work. 


###################################################################################
								TROUBLESHOOTING 
###################################################################################

- Usually on a default linux based server, the webapp should be working with the default configuration. However, you should check on your server if the RewriteEngine is turned ON, as that is responsible for the user friendly URL routing in Codigniter. 

- Another thing to check is the .htaccess file in the root folder of the webapp. Look for the last line defining the ReWrite Rule. This rule works fine on most Server OS'es but some require the rule to be,

RewriteRule ^(.*)$ index.php?/$1 [L,QSA]

instead of 

RewriteRule ^(.*)$ index.php/$1 [L,QSA]

Notice the added question mark (?) here. 