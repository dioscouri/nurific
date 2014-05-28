nurific
=======
Fastest way to get started:

* Clone this repo to a server. /public is your site's document root.
* Create a composer.json (take a look at some of the samples) then run 'php composer.phar install'
* Edit the /config/common.config.ini, providing at least a Mongo connection string and database name
* Enable safemode in you common.config.ini and generate a password for the safemode user
* Browse to your new site's admin at yoursite.com/admin and login with the safemode credentials
* Start coding your front-end Theme in /apps/Theme :-)
