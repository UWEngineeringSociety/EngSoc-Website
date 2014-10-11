=== Tribulant Slideshow Gallery ===
Contributors: contrid
Donate link: http://tribulant.com/
Tags: wordpress plugins, wordpress slideshow gallery, slides, slideshow, image gallery, images, gallery, featured content, content gallery, javascript, javascript slideshow, slideshow gallery
Requires at least: 3.1
Tested up to: 4.0
Stable tag: 1.4.9.1

Feature content in a JavaScript powered slideshow gallery showcase on your WordPress website

== Description ==

Feature content in beatiful and fast JavaScript powered slideshow gallery showcases on your WordPress website.

You can easily display multiple galleries throughout your WordPress website displaying your custom added slides, slide galleries or showing slides from WordPress posts/pages.

The slideshow is flexible, all aspects can easily be configured and embedding/hardcoding the slideshow gallery is a breeze. 

See the <a href="http://tribulant.net/slideshowgallery/">online demonstration</a>.

Here are several ways to display a slideshow: 

= Shortcode for all slides =

To embed a slideshow with all slides under **Slideshow > Manage Slides** in the plugin, simply insert the shortcode below into the content of a post/page.

`[tribulant_slideshow]`

= Shortcode for featured posts =

You can create a slideshow from featured posts, each post being a slide and it's featured image used as the slide image. The link of the slide will be the link of the post so clicking on the slide will take users to that post.

Here is a sample shortcode that you can use for this:

`[tribulant_slideshow featured="true" featurednumber="10" featuredtype="post"]`

= Shortcode for a gallery's slides =

To embed a slideshow with slides from a specific gallery under **Slideshow > Manage Galleries** in the plugin, simply insert the shortcode below (where X is the ID value of the gallery) into the content of a post/page.

`[tribulant_slideshow gallery_id="X"]`

= Shortcode for the images of a WordPress post/page =

To embed a slideshow with the images uploaded to a WordPress post/page through it's media gallery, simply insert the shortcode below (where X is the ID value of the post). Whether you want to display the images from a post or a page, the parameter remains `post_id`.

`[tribulant_slideshow post_id="X"]`

= Shortcode for latest/featured products =

In order to display latest or featured products in a slideshow, you need the <a href="http://tribulant.com/plugins/view/10/wordpress-shopping-cart-plugin" title="WordPress Shopping Cart">Shopping Cart plugin</a> from Tribulant Software. Once you have this installed and activated, you can easily display recent or featured products. To display recent products use the shortcode below. 

`[tribulant_slideshow products="latest"]`

And to display featured products, use the one below. 

`[tribulant_slideshow products="featured"]`

For both, you can use the `productsnumber` parameter to limit the number of products eg. 

`[tribulant_slideshow products="latest" productsnumber="5"]`

= Hardcode into any plugin/theme with PHP =

To hardcode into any PHP file of your WordPress theme, simply use 

`<?php if (function_exists('slideshow')) { slideshow($output = true, $gallery_id = false, $post_id = false, $params = array()); } ?>`.

= Parameters for shortcode/hardcode to customize each slideshow =

You can use any of the following parameters with both the hardcoding and shortcode to customize each slideshow gallery:

Shortcode Ex 1: 

`[tribulant_slideshow layout="responsive" gallery_id="3" auto="true" navopacity="0" showthumbs="true"]`

Shortcode Ex 2: 

`[tribulant_slideshow layout="specific" post_id="379" width="600" height="300" auto="false" showinfo="false"]`

Hardcode Ex 1: 

`<?php slideshow(true, 3, false, array('layout' => "responsive", 'auto' => "true", 'navopacity' => "0", 'showthumbs' => "true")); ?>`

Hardcode Ex 2: 

`<?php slideshow(true, false, 379, array('layout' => "specific", 'width' => "600", 'height' => "300", 'auto' => "false", 'showinfo' => "false")); ?>`

This way you can customize each slideshow you embed or hardcode, despite the settings you saved under **Slideshow > Configuration**.

* `products` [ latest | featured ] = String "latest" or "featured" to display products from the <a href="http://tribulant.com/plugins/view/10/wordpress-shopping-cart-plugin">Checkout plugin</a>.
* `productsnumber` [ productsnumber ] = Numeric/integer to limit the number of products to display.
* `featured` [ true | false ] = Show posts with their featured images 
* `featurednumber` [ number ] = A numeric/integer value. The default is 10
* `featuredtype` [ post_type ] = A post type slug like 'post', 'page', etc. The default is 'post'
* `gallery_id` [ gallery_id ] = Numeric/integer ID of a gallery to display images from.
* `post_id` [ post_id ] = Numeric/integer ID of a post to take images from it, uploaded through it's "Add Media" button.
* `numberposts` [ numberposts ] = Numeric value of the number of images to take from the post/page. "-1" for unlimited/all
* `layout` [ responsive | specific ] = Set to 'responsive' for mobile/tablet compatible theme and 'specific' for fixed width/height.
* `resizeimages` [ true | false ] = Set to 'true' to resize images to fit the slideshow dimensions.
* `imagesoverlay` [ true | false ] (default: setting) = Set to 'true' to display links of slides that are images in a Colorbox overlay on the page.
* `orderby` [ random ] = Set to 'random' to randomly order the slides. Leave this shortcode parameter to order by the order set on the slides.
* `width` [ width | auto ] = (only with layout="specific") Width of the slideshow in pixels. Don't specify 'px' part, just the numeric value for the height.
* `resheight` [ resheight ] = (only with layout="responsive") Numeric/integer value such as "30" to be used with 'resheighttype' below
* `resheighttype [ resheighttype ] = (only with layout="responsive") "px" (pixels) or "%" (percent) as the value eg. resheighttype="%"
* `height` [ height ] (only with layout="specific"; default: setting) = Height of the slideshow in pixels. Don't specify the 'px' part, just the numeric value for the height.
* `autoheight` [ true | false ] = Should the gallery adjust it's height for each slide?
* `auto` [ true | false ] (default: setting) = Set this to 'true' to automatically slide the slides in the slideshow.
* `autospeed` [ speed ] (default: setting) = Speed of the auto sliding. 10 is normal. Lower number is faster. Between 5 and 15 is recommended.
* `fadespeed` [ speed ] (default: setting) = Speed of the fading of images. 10 is normal. Lower number is faster. Between 1 and 20 is recommended.
* `shownav` [ true | false ] (default: setting) = Set to 'true' to show the next/previous image navigation buttons.
* `navopacity` [ opacity ] (default: setting) = The opacity of the next/previous buttons. Between 0 and 100 with 0 being transparent and 100 being fully opaque.
* `navhoveropacity` [ opacity ] (default: setting) = The opacity of the next/previous buttons on hovering. Between 0 and 100 with 0 being transparent and 100 being fully opaque.
* `showinfo` [ true | false ] (default: setting) = Set to 'true' to show the information bar for each slide.
* `infospeed` [ speed ] (default: setting) = Speed at which the information bar will slide up. Between 5 and 15 is recommended.
* `showthumbs` [ true | false ] (default: setting) = Set to 'true' to show the thumbnails for the slides.
* `thumbsposition` [ top | bottom ] (default: setting) = Set to "top" to show above the slideshow.
* `thumbsborder` [ hexidecimal color ] (default: setting) = Hex color of the active thumb border. For example #333333.
* `thumbsspeed` [ speed> ] (default: setting) = Speed of the thumbnail bar scrolling. Lower is slower. Between 1 and 20 is recommended.
* `thumbsspacing` [ spacing ] (default: setting) = An integer value in pixels to space the thumbnails apart. Don’t include the 'px' part, just the number. Between 0 and 10 is recommended.

== Installation ==

Installing the WordPress slideshow gallery plugin is very easy. Simply follow the steps below.

1. Extract the package to obtain the `slideshow-gallery` folder
1. Upload the `slideshow-gallery` folder to the `/wp-content/plugins/` directory
1. Activate the plugin through the 'Plugins' menu in WordPress
1. Configure the settings according to your needs through the **Slideshow > Configuration** menu
1. Add and manage your slides in the 'Slideshow' section
1. Put `[tribulant_slideshow post_id="X"]` to embed a slideshow with the images of a post into your posts/pages or use `[tribulant_slideshow gallery_id="X"]` to display the slides of a specific gallery by ID or use `[tribulant_slideshow]` to embed a slideshow with your custom added slides under **Slideshow > Manage Slides** or `<?php if (function_exists('slideshow')) { slideshow($output = true, $gallery_id = false, $post_id = false, $params = array()); } ?>` into your WordPress theme using PHP code.

== Frequently Asked Questions ==

= Can I display/embed multiple instances of the slideshow gallery? =

Yes, you can and you can put multiple slideshows on the same page as well.

= How can I display specific slides in a slideshow gallery instance? =

You can organize slides either into multiple galleries according to your needs or you can upload images to WordPress posts and display the images uploaded to a post.

= How do I display the images uploaded to a post? =

You can embed a slideshow and show the images uploaded to a post with the `post_id` parameter. Like this `[tribulant_slideshow post_id="123"]`.

= Can I exclude certain images from a post in the slideshow? =

Yes, you can use the `exclude` parameter to exclude post images by their order in the gallery (comma separated) like this `[tribulant_slideshow post_id="123" exclude="2,4,8"]`.

= How can I fix slide images or thumbnails not displaying? =

There is an "Images Tester" utility under Slideshow > Configuration on the right-hand side. Use that to determine the problem.

== Screenshots ==

1. Slideshow gallery with thumbnails at the bottom.
2. Slideshow gallery with thumbnails turned OFF.
3. Slideshow gallery with thumbnails at the top.
4. Different styles/colors.
5. TinyMCE editor button to insert shortcodes.
6. Turn on Thickbox to show enlarged images in an overlay.

== Changelog ==

= 1.4.9 =
* ADD: 'numberposts' shortcode attribute for post/page images as slides
* ADD: Notice to rate/review the plugin
* IMPROVE: Moved some files from plugin core to /assets/ folder
* FIX: Post/page images gallery only shows 10 slides, no more
* FIX: Extra space after thumbnails in thumbnail strip

= 1.4.8 =
* ADD: WordPress 4.0 compatibility
* FIX: Post/page images slideshow order broken
* FIX: Hide information bar on mobile checkbox resets to on

= 1.4.7 =
* ADD: Recommended plugin under configuration
* IMPROVE: TimThumb absolute URLs to prevent permission problems
* IMPROVE: Allow long filenames for custom slides
* IMPROVE: Replace direct Ajax calls with wp_ajax_
* IMPROVE: Prefill the post ID in the TinyMCE dialog with ID of current post
* FIX: Spaces in filenames uploaded to post/page breaks images
* FIX: Remove all wp-config.php and wp-load.php references
* FIX: Possible shell exploit by uploading PHP file as slide
* FIX: Colorbox script should only load with this featured turned on
* FIX: Thumbnails On/Off setting doesn't work

= 1.4.6 =
* ADD: Featured content. Display a slide for each post with it's featured image
* ADD: Auto height setting to adjust height for each slide
* IMPROVE: (m)qTranslate compatibility for post images and featured posts
* IMPROVE: Change direct Ajax calls to wp_ajax_ hooks
* FIX: Slideshow inside float:left; element breaks height
* FIX: Information bar not showing on post/pages images slides

= 1.4.5 =
* ADD: Welcome/about screen on update
* ADD: Child theme folder support
* ADD: Multilingual with (m)qTranslate
* IMPROVE: New style for sliders in configuration
* IMPROVE: Deprecated: Function split() is deprecated
* IMPROVE: Deprecated: Function eregi() is deprecated
* FIX: Uppercase file extensions
* FIX: Image overlay/enlargement only works with no thumbnails
* FIX: Image overlay/enlargement URL wrong
* FIX: Space in file name
* FIX: Information bar is overlapped by prev/next

= 1.4.4.3 =
* FIX: TypeError: 'null' is not an object (evaluating 'e.offsetHeight')

= 1.4.4.2 =
* IMPROVE: Replaced eregi() with preg_match()
* IMPROVE: Replaced ereg_replace() with preg_replace()
* FIX: Multiple rows of thumbnails issue
* FIX: Info bar delay on hide
* FIX: console.log() call left behind
* FIX: Current image not showing when saving slide and it doesn't save

= 1.4.4.1 =
* IMPROVE: Change admin-functions.php to includes/admin.php
* FIX: Cannot order slides of a gallery "No slides available"

= 1.4.4 =
* FIX: Galleries not showing when saving a slide

= 1.4.3 =
* ADD: WordPress Object Cache API for performance
* FIX: Post/page images slideshow not showing images with resize turned on
* FIX: Featured/latest product images not showing with resizing

= 1.4.2 =
* ADD: More flexible settings for information bar per slide
* ADD: Switch from TimThumb to BFI Thumb
* FIX: Change mysql_real_escape_string() to esc_sql()
* REMOVE: Images tester is no longer needed

= 1.4.1 =
* ADD: Set opacity for information bar per slide
* ADD: Setting per slide to show title/description or not
* IMPROVE: Updated TimThumb script
* IMPROVE: Updated WordPress plugin file header
* IMPROVE: Function call_user_method() is deprecated
* IMPROVE: New spinner/loading image
* FIX: More PHP warnings/notices
* FIX: 404 Not Found on spinner/loading image

= 1.4 =
* ADD: WordPress 3.9 compatibility
* ADD: New shortcode `[tribulant_slideshow]` to prevent conflicts
* IMPROVE: Reduced/hidden information bar on mobile
* IMPROVE: More CSS selectors on elements
* IMPROVE: New dashicon for help instead of CSS
* IMPROVE: File and folder permissions incorrect on some servers
* FIX: TinyMCE editor button/icon not inserting shortcodes
* FIX: PHP strict standards warnings
* FIX: NextGen Conflict
* FIX: Slideshow not showing with 1 slide
* FIX: TinyMCE editor icon/button since WordPress 3.9 missing

= 1.3.1.3 =
* FIX: Image could not be moved from TMP error in some cases
* FIX: PHP Strict, Notice and Warning messages

= 1.3.1.2 =
* FIX: Not all configuration settings loading

= 1.3.1 =

* ADD: Images tester utility under Configuration to fix broken images
* FIX: Issue with turning off navigation images
* FIX: Issue with new slider settings if empty or set to zero (0)

= 1.3 =

* ADD: Show latest/featured products from Shopping Cart plugin
* ADD: Plugin "Settings" link on the "Plugins" page in WordPress
* ADD: TimThumb crop position setting 
* ADD: WordPress multi-site compatibility
* ADD: Sortable columns in all admin sections 
* ADD: Help tooltips in admin 
* ADD: Sliders for speed settings 
* ADD: Color picker for color settings
* ADD: Delete image upon deletion of locally created slide 
* ADD: WordPress 3.8+ design and compatibility
* ADD: Multiple slideshows on a single page 
* ADD: Responsive design for mobiles and tablets 
* ADD: Debugging setting in configuration 
* IMPROVE: Colorbox upgrade/fix
* IMPROVE: Use wp_upload_dir() for dynamic paths 
* IMPROVE: Better thumbnail slider using CSS calc 
* IMPROVE: Move images to default theme folder 
* IMPROVE: New TinyMCE icon/button
* IMPROVE: New dashicons menu icon 
* IMPROVE: When the nav arrows are turned off, the link click area should be full 
* IMPROVE: Automatically center align images in the slideshow
* FIX: Empty/zero thumbs spacing causes JS error
* FIX: Deleting a slide leaves empty reference in gallery 
* FIX: Information overlaps arrows when long 
* FIX: Permissions settings not working
* FIX: Turning off autoslide setting doesn't stop autoslide 
* FIX: Javascript error due to tooltip() call 
* FIX: Width/height of slideshow is less than the settings

= 1.2.3.2 =
* ADD: List/grid switching for ordering of slides
* ADD: Permission/role settings for sections
* ADD: 'imagesoverlay' parameter to turn On/Off the Colorbox overlay per slideshow
* ADD: "Resize Images" setting TimThumb test case for debugging
* ADD: Order slides per gallery
* ADD: Order slides randomly
* IMPROVE: Change WP_PLUGIN_DIR to plugins_url() for styles/scripts
* IMPROVE: Change mysql_list_fields() to a compatible function
* IMPROVE: Remove previous image to prevent overlapping
* IMPROVE: Max width/height for Colorbox overlay for images
* FIX: Null ID value on insert of slide
* FIX: Validation errors
* FIX: Slide current/new window problem

= 1.2.2.1 =
* IMPROVE: Upgrade of TimThumb from 2.8.9 to 2.8.10 to fix broken images.

= 1.2.2 =
* FIX: Slides paging numbers didn't show up
* REMOVE: 'Description' not mandatory/required for each slide.
* FIX: Slashes caused by single/double quotes in titles/descriptions
* ADD: Hardcode for each gallery in 'Manage Galleries' section
* ADD: Shortcode in the 'Manage Galleries' section for each gallery
* ADD: Gallery ID to the 'Manage Galleries' section
* FIX: the 100% width issue on the 'img' tag if resizeimages = false
* IMPROVE: Change cache directory to "wp-content/uploads/slideshow-gallery/cache" for TimThumb

= 1.2.1 = 
* FIX: Thumbnails On/Off setting doesn't work
* IMPROVE: TimThumb absolute URLs to prevent permission problems
* FIX: Colorbox script should only load with this featured turned on

= 1.2 =
* ADD: 'About Us' box in the Configuration section
* IMPROVE: Better, more usable hardcoding procedure
* FIX: Slideshow goes left
* IMPROVE: auto width property
* ADD: Banner image for WordPress.org directory
* IMPROVE: Use load_plugin_textdomain instead for language file
* ADD: Order slides by random?
* FIX: Enqueue scripts/styles at the right time
* ADD: Link target (current/new window) setting on each slide for link
* IMPROVE: Hide next/previous navigation when there is only one slide
* ADD: TimThumb integration for cropping images
* CHANGE: Colorbox for popup images
* ADD: 'Open' link to test slide links
* ADD: Icon in each section of the plugin
* CHANGE: Author name on WordPress.org to link appropriately
* ADD: Dimensions for thumbnail images
* CHANGE: New icon image for the admin menu
* IMPROVE: Change 1=1 for the CSS
* FIX: Code showing in the RSS feed.
* ADD: Shortcode parameters
* ADD: Setting to turn off the next/previous navigation
* IMPROVE: "Previous Image" and "Next Image" in language file
* FIX: Not all thumbnails load the first time
* IMPROVE: Remove black borders left and right of the image
* IMPROVE: Removed link overlay which displayed white in IE6

= 1.1 =
* ADDED: "THIS POST" added to the TinyMCE dialog to insert a shortcode for a slideshow of the current post
* IMPROVED: Some CSS improvements to the slideshow
* ADDED: Thickbox to show images in overlay. Can be turned On/Off
* FIXED: Fixed all thumbnails not preloading on first load
* FIXED: Slide HREF in IE
* ADDED: Spinner loading indicator to show the slideshow is loading up
* ADDED: "Link" column in the "Manage Slides" section
* FIXED: Load Thickbox on the 'Manage Slides' page for the enlargements
* ADDED: Ability to upload an image when saving a slide rather than specifying a URL
* ADDED: Row actions in the 'Manage Slides' section

= 1.0.4 =
* IMPROVED: WordPress 2.9 sortable meta boxes.
* FIXED: `wp_redirect()` fatal error in dashboard.
* ADDED: TinyMCE editor button to quickly insert slideshows into posts/pages.
* ADDED: `exclude` parameter to use in conjunction with the `post_id` parameter to exclude attachments by order.
* CHANGED: Changed `#wrapper` in the HTML markup to `#slideshow-wrapper` due to some theme conflicts.

= 1.0.4 =
* COMPATIBILITY: WordPress 2.9
* FIXED: #fullsize z-index to keep below other elements such as drop down menus.

= 1.0.3 =
* ADDED: Default, English language file in the `languages` folder.
* ADDED: Configuration setting to turn On/Off resizing of images via CSS.
* ADDED: Webkit border radius in CSS for thumbnail images.
* ADDED: `post_id` parameter for the `[tribulant_slideshow]` shortcode to display images from a post/page.
* IMPROVED: Plugin doesn't utilize PHP short open tags anymore.
* COMPATIBILITY: Removed `autoLoad` (introduced in PHP 5) parameter from `class_exists` function for PHP 4 compatibility.
* IMPROVED: Directory separator constant DS from DIRECTORY_SEPARATOR.

= 1.0 =
* Initial release of the WordPress Slideshow Gallery plugin