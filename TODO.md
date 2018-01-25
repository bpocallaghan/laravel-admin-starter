##Admin Starter - TODO

- ~~Merge the Page Components into one (no more seperate tables and create pages)~~
- Page Content (media) - add cropper
- Resource with single photo - save image in photos table and not his own table (upload directory and cropper)
- ~~Add cropper for Gallery photos~~
- Add cropper for Images (Banners)
- ~~Update bootstrap 4 to latest beta version~~
- ~~Make Banners Order Dynamic (specify their order)~~
- Move components to seperate packages for more mudular structure
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
- editing the password, by the user itself (now a readonly field)
- resetting the password from admin (send reset mail)
- more modularity regarding installed modules, most functionality isn't needed like Gallery/blog, but can be dropped in later with their own migrations and seeders.
- putting the logo's into the settings table (also, the svg has troubles loading at times; probably some weird cache or bad header)
- move slug generation to a more mature package like cviebrock/eloquent-sluggable - which can handle multiple sources (unless I'm wrong about BP's own package).
