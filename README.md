# Laravel CMS Starter Project

A Laravel CMS Starter project with AdminLTE theme and core features.
- Laravel 5.4
- Laravel 5.2 (Branch Laravel 5.2)

[Preview project here](http://bpocallaghan.co.za/admin)
- User: github@bpocallaghan.co.za
- Password: Github

## Features / What it includes
- Admin LTE admin theme
- Authorization
	- login / forgot password
	- register via authorization (admin invite user)
- Dashboard
	- google analytics
	- list activities
- Admin Navigation
- Website Navigation
- Tag resource
- Log Activities (user, resource, before, after)
- Bootstrap Alerts and Form Error messages. package; bpocallaghan/alert
- Flash a Notification after a CRUD resource action. package; bpocallaghan/notify
- Generate crud resource, individual files. package; bpocallaghan/generators
- Useful laravel helper classes / traits. package; bpocallaghan/titan

## Setup (Basic)
- download zip
- ```composer install```
- rename .env.example - .env
- ```php artisan key:generate```
- open .env and set the app info (url, title, description, etc)
- create your database and set db name in .env
- ```php artisan migrate```
- ```php artisan db:seed```
	- open database\seeds\UserTableSeeder.php to create a different admin
- open your browser (http://laravel-admin.dev/)
	- the home, about, contact us gets generated + the breadcrumb
- log into the admin (http://laravel-admin.dev/admin)
	- admin@laravel-admin.com
	- admin

## Setup (Advanced)
- complete 'basic' setup
- config\app.php -> set timezone
- create FB Website App https://developers.facebook.com/
- create a mailgun account and set custom domain
- google captcha https://www.google.com/recaptcha/admin#list
- google analytics account https://analytics.google.com/analytics/web
- google console developer account for google maps and google analytics API
	- Create api browser key for google maps
	- Create service account key for google analytics
		- add the email to the 'accounts' under google analytics
 		- download and store the p12
 		- go to google analytics under the admin - view settings - for the 'site id'
 	- more info https://github.com/spatie/laravel-analytics
 	- run the below to edit the config (set the name of the .p12)
 	- ```php artisan vendor:publish --provider="Spatie\LaravelAnalytics\LaravelAnalyticsServiceProvider"```
- have a look at Admin\NavigationController.php on how to use datatables and datatables with ajax if more than 150 entries

## TODO

- Documentation (more user friendly)
- Make project more 'open source' (currently heavily focused for me only)
- Add more features (Roles, Permissions, Queue, Backup, etc)
- Learn Testing
- Learn Vue.js

## Thank you

- [ADMIN LTE](https://github.com/almasaeed2010/AdminLTE).
- Thank you [Taylor Ottwell](https://github.com/taylorotwell) for [Laravel](http://laravel.com/).
- Thank you [Jeffrey Way](https://github.com/JeffreyWay) for the awesome resources at [Laracasts](https://laracasts.com/).

## Note

Please keep in mind this is for my personal workflow and might not fit your need.
This is my starter project for most small crud admin portals.
I try to keep it clean, flexibly and friendly to use. This is not a complete project or best practises, just trying to help the community :).
Please let me know about any issues or if you have any suggestions.

## My Packages being used

- [Laravel 5 Flash a bootstrap alert](https://github.com/bpocallaghan/alert) When login failes
- [Laravel 5 Flash Notifications with icons and animations and with a timeout](https://github.com/bpocallaghan/notify) When you login or create / delete / edit any resource
- [Laravel custom Generate Files with a config file and publishable stubs](https://github.com/bpocallaghan/generators)
