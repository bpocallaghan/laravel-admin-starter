# Laravel CMS Starter Project

Version 2 is under development (alpha version). Please have a look here for [version 1](https://github.com/bpocallaghan/laravel-admin-starter/tree/version_1).
Version 2 is a refactored version of `version 1 (admin starter project)`, meaning that all the files were inside your applications' directory. However now it is all inside a package.
[Link to the repository](https://github.com/bpocallaghan/titan).

A Laravel CMS Starter project with AdminLTE theme and core features.
- [version 1](https://github.com/bpocallaghan/laravel-admin-starter/tree/version_1)
- version 2 (master branch)

[Preview project here](http://bpocallaghan.co.za)
- User: github@bpocallaghan.co.za
- Password: github

### What is New?
- Refactored all files to [titan](https://github.com/bpocallaghan/titan)

## Features / What it includes
- Admin LTE admin theme
- Members (website and admin users)
- Google Analytics Reports (with charts)
- Website Page Builder with 3 components (page content, photos, documents)
- Log Website Activities (if contact us was submitted, etc)
- Notifications (Laravel notifications)
- Log Admin Activities (when admin create,edit,delete a resource)
- Bootstrap Alerts and Form Error messages. [bpocallaghan/alert](https://github.com/bpocallaghan/alert)
- Flash a Notification after a CRUD resource action. [bpocallaghan/notify](https://github.com/bpocallaghan/alert)
- Generate crud resource, individual files. [bpocallaghan/generators](https://github.com/bpocallaghan/alert)
- Impersonate any of your customers. [bpocallaghan/impersonate](https://github.com/bpocallaghan/impersonate)
- Roles, Assign roles to the user and navigation to exlude navigation for a user.
- Manage Blog, Banners, FAQ, Photos.
- Reports with Chartjs

## Setup (Basic)
- ```composer create-project bpocallaghan/laravel-admin-starter:dev-master laravel-admin-starter```
- open .env and set the app info (url, title, description, etc)
- create your database and set db name in .env
- ```php artisan migrate```
- ```php artisan titan:db:seed```

## Setup (Advanced)
- complete 'basic' setup
- config\app.php -> set timezone
- create FB Website App https://developers.facebook.com/
- create a mailgun account and set custom domain
- google captcha https://www.google.com/recaptcha/admin#list
- google analytics account https://analytics.google.com/analytics/web
- google console developer account for google maps and google analytics API
    - https://console.developers.google.com
    - Enable the 'google analytics' API
	- Create api browser key for google maps
	- Get and Setup Laravel Analytics [Laravel Analytics (Spatie)](https://github.com/spatie/laravel-analytics/tree/3.1.0)
        - create NEW service account key
        - any name will work (I use google analytics)
        - key type is JSON
        - download and rename the json to 'service-account-credentials.json'
        - store the file under /storage/app/analytics
        - go to (google analytics)[https://analytics.google.com/analytics/]
        - go to admin - property - user management and add the service account's email as a user
        - go to admin - view - settings and copy the 'site id' to your .env
- get a Google Maps js API key (after you've created the project in google) https://developers.google.com/maps/documentation/javascript/get-api-key 
- have a look at Admin\NavigationController.php on how to use datatables and datatables with ajax if more than 150 entries

## TODO
- finish refactoring files to titan for easier use and more flexibility
- [Upcoming Changes and Features](https://github.com/bpocallaghan/laravel-admin-starter/blob/master/TODO.md)

## Thank you
- [ADMIN LTE](https://github.com/almasaeed2010/AdminLTE).
- Thank you [Taylor Ottwell](https://github.com/taylorotwell) for [Laravel](http://laravel.com/).
- Thank you [Jeffrey Way](https://github.com/JeffreyWay) for the awesome resources at [Laracasts](https://laracasts.com/).

## Note
- I am busy refactoring the project to titan (titan will get some version updates)
- I am starting with a new website where I will put it in use and probably do lots of updates to [titan](https://github.com/bpocallaghan/titan).

This is my starter project for most crud admin portals.
I try to keep it clean, flexibly and friendly to use and to help the community.
Please let me know about any issues or if you have any suggestions.

## Change log
Please see the [CHANGELOG](http://bpocallaghan.co.za/changelog) for more information about changes.

## My Packages Included
- [File Generators](https://github.com/bpocallaghan/generators) Laravel 5 File Generators with config and publishable stubs
- [Notify](https://github.com/bpocallaghan/notify) Laravel 5 Flash Notifications with icons and animations and with a timeout
- [Alert](https://github.com/bpocallaghan/alert) A helper package to flash a bootstrap alert to the browser via a Facade or a helper function.
- [Impersonate User](https://github.com/bpocallaghan/impersonate) This allows you to authenticate as any of your customers.
- [Sluggable](https://github.com/bpocallaghan/sluggable) Provides a HasSlug trait that will generate a unique slug when saving your Laravel Eloquent model.
