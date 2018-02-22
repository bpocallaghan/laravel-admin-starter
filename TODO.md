##Admin Starter - TODO

- ~~Merge the Page Components into one (no more seperate tables and create pages)~~
- Page Content (media) - add cropper
- Resource with single photo - save image in photos table and not his own table (upload directory and cropper)
- ~~Add cropper for Gallery photos~~
- ~~Add cropper for Images (Banners)~~
- ~~Update bootstrap 4 to latest beta version~~
- ~~Make Banners Order Dynamic (specify their order)~~
- Move components to seperate packages for more mudular structure:
    - ~~[Locations](https://github.com/bpocallaghan/locations)~~
    - ~~[Subscriptions](https://github.com/bpocallaghan/subscriptions)~~
    - ~~[Testimonials](https://github.com/bpocallaghan/testimonials)~~
    - ~~[FAQ](https://github.com/bpocallaghan/faq)~~
    - ~~[Corporate](https://github.com/bpocallaghan/corporate)~~
    - ~~[Changelogs](https://github.com/bpocallaghan/changelogs)~~
    - Roles and Permissions (https://github.com/spatie/laravel-permission ?)
    - Titan (The core required modules pages, banners, gallery, etc) 
- Unit Testing
- Vuejs

Reference: https://github.com/bpocallaghan/laravel-admin-starter/issues/17

https://github.com/greenlevel
- Loading time. Overall the site loads pretty fast, also admin. But sometimes it takes a bit when clicking on specific category or page. Is this normal and just the way laravel based sites loads? Or can it be made that it loads really fast. like click and 'bam' it's there (assuming that the content size is just normal of course).
- I like it that you have integrated a gallery system in the admin, however i miss the option that you can reorder the images after uploading. I like the function that you can just reorder the images by moving them around with your mouse.
- By the admin blog section. You have the gallery function on a different page. I prefer having everything on 1 page, so its faster to fill everything in and upload the images you want with the specific blog. Same as what you would have with a page when you add a gallery component it shows on the main edit page.
- When adding images on a blog gallery. Instead having to refresh yourself, it's maybe nice that it refreshes automatic so you can see the results immediately. (when i uploaded the images, i overread your description, and was confused first what to do as i didn't see a 'save' button only a go back button.)
- Your overall site is pretty complete already. Both admin / front. The only main thing i miss is a search function in the front.

https://github.com/xewl
- ~~editing the password, by the user itself (now a readonly field)~~
- ~~resetting the password from admin (send reset mail)~~
- more modularity regarding installed modules, most functionality isn't needed like Gallery/blog, but can be dropped in later with their own migrations and seeders.
- putting the logo's into the settings table (also, the svg has troubles loading at times; probably some weird cache or bad header)
- move slug generation to a more mature package like cviebrock/eloquent-sluggable - which can handle multiple sources (unless I'm wrong about BP's own package).

https://github.com/jasonmccuen
- I couldn't delete any pages under ID=30. I understand why you did this, to keep the home page intact (footer nav primarily) but maybe a better way is to have an extra DB column called 'Protected' with a tick box on the edit page for 'Posts'?
- Summernote WYSIWYG: I couldn't see where, but I was trying to build links using relative paths, ( i.e. '/foo/bar/') but the 'http://' was being added in, so it was saving 'http:///foo/bar/' instead of the relative path. This isn't the end of the world, but it would be nice to be able to do, especially when developing locally. I'm not sure where the 'http://' is being added, but I have a feeling it is Summernote. I noticed they had made mention of it on their git and marked it as resolved, so I'm not sure if it is fixed in a newer version. I'm happy to take a look into it further.
- JSON+LD and expanded OpenGraph: On-page SEO is getting more and more important, especially with Schema. Again, I'd be happy to try my hand at implementing a Schema module like I did for my RoR app.
- Speed: Coming from RoR, One of the cool speed tools we have out of the box is TurboLinks. TurboLinks is basically a JS package that turns your app into a single-page app. When you are clicking through the navigation, only the is swapped out, cutting out a lot of time on page-reloads. I noticed that there is a port for Laravel: https://github.com/frenzyapp/turbolinks - I don't know if this would help with speed issues.
- Search: I do a lot with search, and will be incorporating some sort of fuzzy search and geo-location calculations on my sites. I maintain a separate ELK stack for this, but again, I'm happy to contribute a module for ELK integration once I figure out what I'm doing. I have a feeling that I am approaching ELK completely backwards, but it seems to get me the results I need, and I don't have to burn through Google API requests to do it.