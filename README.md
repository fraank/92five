## team - project management ##

Additional Features:

* german language
* "allday" Events for the calendar


Bugfixes:

* full migration support (basic run needs no installation)
* replaced hard strings with translated content


Before proceeding to installation please make sure that your server meets the minimum server requirements:


## Minimum Server Requirements ##

* PHP 5.4 or greater
* PDO PHP extension
* MCrypt PHP extension
* GD PHP library
* MySQL Database

If your webserver is running Apache then mod_rewrite should be installed


# Manual Installation #

* git clone the repository
* copy the app/config/database.sample.php to app/config/database.php and modify the db-settings
* Grant writing permission to app/storage, assets/uploads and assets/images/profilepics
* run "php artisan optimize"
* run "php artisan migrate" to setup the full db
* thats it! You can now login with the user "admin@admin.com" and "changeme12345"


team is fork from 92five (https://github.com/chintanbanugaria/92five)
