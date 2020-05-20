=== Espied ===

Contributors: automattic
Requires at least: 4.2
Tested up to: 4.5
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

A portfolio theme for designers and photographers. Great for showing off your image oriented projects to the world.

== Description ==

Espied is a portfolio theme for designers, photographers, and artists. It’s great for showing off your image-oriented projects to the world. The theme’s minimalist design puts the focus on your projects.

* Responsive layout.
* Portfolio Page Template.
* Full-width Page Template.
* Custom Header.
* Jetpack.com compatibility for Infinite Scroll, Portfolio Custom Post Type.
* The GPL v2.0 or later license. :) Use it to make something cool.

== Installation ==

1. In your admin panel, go to Appearance > Themes and click the Add New button.
2. Click Upload and Choose File, then select the theme's .zip file. Click Install Now.
3. Click Activate to use your new theme right away.

== Frequently Asked Questions ==

= I don't see the Portfolio menu in my admin, where can I find it? =

To make the Portfolio menu appear in your admin, you need to install the [Jetpack plugin](http://jetpack.com) because it has the required code needed to make [custom post types](http://codex.wordpress.org/Post_Types#Custom_Post_Types) work for the Espied theme.

Once Jetpack is active, the Portfolio menu will appear in your admin, in addition to standard blog posts. No special Jetpack module is needed and a WordPress.com connection is not required for the Portfolio feature to function. Portfolio will work on a localhost installation of WordPress if you add this line to `wp-config.php`:

`define( 'JETPACK_DEV_DEBUG', TRUE );`

The Portfolio admin: https://cloudup.com/cOznO6emIyD

= How to setup the front page like the demo site? =

The demo site URL: http://espieddemo.wordpress.com/?demo

When you first activate Espied, you’ll see your posts in a traditional blog format. If you’d like to use the portfolio page template as the front page of your site, as the demo site does, it’s simple to configure:

1. Create or edit a page, and assign it to the Portfolio Page Template from the Page Attributes module. https://cloudup.com/ceH0xfFP2tR
2. Go to Settings > Reading and set “Front page displays” to “A static page”.
3. Select the page you just assigned the Portfolio Page Template to as “Front page” and set another page as the “Posts page” to display your blog posts.

By default, page title and content will appear. You can hide them if you prefer by going to Appearance → Customize → Theme Options and check “Hide title and content on Portfolio Page Template” option.

= Where is the page that lists all projects? =

Along with the Portfolio Page Template, your projects will be displayed on portfolio archive pages.

Let's say you have a WordPress.com site at: http://mygroovydomain.com

The URL of the portfolio archive page will be: http://mygroovydomain.com/portfolio/

If your blog’s URL is http://mygroovydomain.com/, you’ll find your portfolio archive page at http://mygroovydomain.com/portfolio/.

You'll need pretty permalinks (any structure) for this URL to work though. If you're stuck with default permalinks - your links have a query string at the end, like ?p=123 - then your portfolio archive can be accessed by adding this immediately after your URL:

`/?post_type=jetpack-portfolio`

The portfolio archive page: https://espieddemo.wordpress.com/portfolio

= How to add large images in projects? =

People love full-size images of your work, so make sure the images you include are at least 1272px wide. Espied displays these images at full width on larger screens.

= How to use Portfolio Shortcodes? =

Once you create a project, you can use the portfolio shortcode to display it anywhere on your site. Adding the [portfolio] shortcode to any post or page will insert your project. More info on the shortcode.

= How to add the social links in the sidebar? =

Espied allows you display links to your social media profiles, like Twitter and Facebook, with icons.

1. Create a new Custom Menu, and assign it to the Social Links Menu location.
2. Add links to each of your social services using the Links panel.
3. Icons for your social links will automatically appear if it’s available.

Available icons:

* Codepen
* Digg
* Dribbble
* Dropbox
* Facebook
* Flickr
* GitHub
* Google+
* Instagram
* LinkedIn
* Email (mailto: links)
* Pinterest
* Pocket
* PollDaddy
* Reddit
* RSS Feed (urls with /feed/)
* StumbleUpon
* Tumblr
* Twitter
* Vimeo
* WordPress
* YouTube

== Quick Espied Specs (all measurements in pixels) ==

1. The main column width is 552.
2. The sidebar width is 552.
3. Featured Images for blog posts are 840 wide by unlimited height
4. Featured Images for portfolio projects are 480 wide by 360 (landscape), 640 (portrait), and 480(square) height
5. Custom header image should be at least 1600 in width.

== Changelog ==

= 2 March 2018 =
* Use wp_kses_post rather than wp_filter_post_kses.

= 18 December 2017 =
* Fix Instagram widget

= 31 August 2017 =
* Remove overflow-y from html when sidebar is open.
* Make sure overflow-y of the menu is always visible so the scroll bar can scrolled without a trackpad.

= 3 May 2017 =
* Check for post parent object before outputting post parent information to prevent fatals.

= 29 March 2017 =
* Check for post parent before outputting next, previous, and image attachment information to prevent fatals.

= 22 March 2017 =
* add Custom Colors annotations directly to the theme
* move fonts annotations directly into the theme

= 6 March 2017 =
* Add Headstart annotation.

= 1 March 2017 =
* Adjusting width of portfolio projects to remove a sliver of background that appears between projects in Chrome on some screen sizes.

= 2 February 2017 =
* remove from CSS in wp-content/themes/pub

= 17 January 2017 =
* Add new grid-layout tag to stylesheet.

= 7 July 2016 =
* Let WordPress manage the document title by adding theme support

= 20 June 2016 =
* Define auto width for body to make sure it's not being resized by extra widgets.

= 16 June 2016 =
* Add a class of .widgets-hidden to the body tag when the sidebar is active; allows the widgets to be targeted by Direct Manipulation.

= 10 June 2016 =
* Move Customizer's theme option to the new Portfolio tab
* Update copyright
* Add support for Portfolio CPT new theme options

= 27 May 2016 =
* fix the behavior of `*_the_attached_image()` for PHP 7 compat

= 25 May 2016 =
* Silence PHP Warning.

= 5 November 2015 =
* Add support for missing Genericons and update to 3.4.1.

= 20 August 2015 =
* Add text domain and/or remove domain path. (E-I)

= 31 July 2015 =
* Remove .`screen-reader-text:hover` and `.screen-reader-text:active` style rules.

= 22 July 2015 =
* Replace toggleClass with addClass/removeClass to avoid bug where a cursor placed over an image as the page is loading will do the opposite of what is expected.

= 16 July 2015 =
* Always use https when loading Google Fonts. See #3221;

= 14 July 2015 =
* Custom Header improvements.

= 2 June 2015 =
* fix `sprintf` placeholder.
* fix `sprintf` placeholder.

= 6 May 2015 =
* Fully remove example.html from Genericons folders.
* Remove index.html file from Genericions.

= 12 September 2014 =
* Add momentum scrolling back on the fixed sidebar for iOS.

= 22 August 2014 =
* Add a changelog in readme.txt
* Apply hover effct for portfolio items that are added by IS.

= 11 August 2014 =
* Add a new, GPL compatible screenshot.
* Fix a bug in moving Sharedaddy after projects on portfolio page template.
* Enqueue a JS check.
* Fix a typo in textdomain.

= 6 August 2014 =
* Add a check so that the portfolio query only on the portfolio page template runs when the CPT is available.

= 4 August 2014 =
* Style adjustment for sharedaddy on search result page
* Make sure core native embed media has bottom margin.
* Sharedaddy tweak on a portfolio page.
* Sharedaddy style tweaks
* Quote style adjustment.

= 23 July 2014 =
* change theme/author URIs and footer links to `wordpress.com/themes`.

= 11 July 2014 =
* Fix the position of sharedaddy.

= 7 July 2014 =
* Ready for enabling IS for all archive pages.
* Fix typo.

= 2 July 2014 =
* No need to remove default gallery style when we declare HTML5 support for galleries. See [wp27396], #themes2480

= 1 June 2014 =
* add/update pot files.

= 30 April 2014 =
* Move the variable declration so that dropdown toggle button will be included in sidbar_tabbable.
* Better keyboard navigation for portfolio items.
* Make sure the color of the site title stays the same.
* A11y fix. Add off-screen project title to the view link.
* Minor style fix.
* A11y fix. Add "continue reading" plus off-screen title link for excerpts.
* Gallery style tweak.
* Minor comment styling edits.

= 29 April 2014 =
* Remove blur that preveted the keyboard navigation flow.
* A11y
* A11y fix. Darken the text that sits on 58c7f4.
* When image link gets focused the hover class shouldn't be added.
* Remove hover style from  portfolio item when it's out of focus but keeping the style stays when anchors in it are focused.
* Make portfolio items focusable and apply the smae effect as hover.
* Remove an extra line.
* A11y fix. Apply focus style to the navigations.
* A11y fix. Add aria-hidden attribute to the sidebar in order to indicate its visibility.
* Change the footer author from Automattic to WordPress.com.
* A11y
* Break lines within words in order to prevent overflow in content areas.
* A11y

= 28 April 2014 =
* More specific selector to handle author names in entry meta because it hides author page entirely.
* a11y fix for sidebar toggle button.

= 23 April 2014 =
* Add spacing to comment moderation awaiting message.

= 16 April 2014 =
* Make sure the input field in Blog Subscription widget look good.
* Less specificity for overriding the style of highlander comment form, minor tweaks on comment reply link.
* Make sure threaded comments to not overflow.

= 14 April 2014 =
* Update Responsive video support

= 13 April 2014 =
* Simplify the gallery style.
* Minor tweak for comment reply link.

= 12 April 2014 =
* Give more specificity to the ad to be center.
* Make sure the ad to be center.
* Change caption style and make sure the width to be the same as the image.
* Make sure the pagination works when the template is set to the front page.

= 11 April 2014 =
* Remove the sass message from css files.
* New screenshot.
* Stop the stats image messing up vertical spacing.

= 10 April 2014 =
* Minor tweaks in the header text.
* Make sure the header dissapears when header text is hidden.
* cleanup RTL stylesheet.
* Add RTL support theme tag.
* RTL for editor style.
* Add RTL style for WP.com specific stuff.
* Add styles for RTL.
* Remove README.md and add readme.txt instead.
* Add license.txt
* Add "-wpcom" to version number.
* Minor tweaks.
* Remove RTL support tag for now and fix the submit button.
* Make sure images are loaded before check its width.
* Add mail link as a socila link.

= 9 April 2014 =
* Chenge the portfolio query on the portfolio page template so that it respects users setting.
* Tweak the transitions.
* Add transitions to links.

= 8 April 2014 =
* Move sharedaddy on portfolio page template.
* Wrap projects with a div.
* Rename pagination label to be not date dependant (e.g. portfolio order)
* Two separate font register functions allowing translaters to add additional subsets. Also in this way we can add easily add each url to editor stylesheet.

= 7 April 2014 =
* New blockquote style.
* Make sure the page content clears floating and stop shifting media treatment for aligned elements in it.
* Fix a typo.
* Don't hide the page content if it has only images.
* More larger image attachment page.
* Rename the page template for an extra clarity.
* Rename page templates for extra clarity.
* Add order and orderby to Portfolio Page Template so it follows the order.
* Style tweak for paging navigation for portfolio archive pages.

= 5 April 2014 =
* Absolute line height for site branding elements so that header height remain the same with font size change.
* Remove sticky footer because it makes portfolio page grid look bad.
* Minor style tweak.

= 4 April 2014 =
* Adjust the content width for the full width page, minor style tweaks.
* Re-format the last commit.
* Touch device friendly hover effect for projects.

= 3 April 2014 =
* Minor responsive pattern fix.
* Tweak the form style a bit.
* Gravatar widgets styling.
* Add a scrrenshot.png
* Minor style and format
* Add $max_pages parameter to the pagination so that it works properly with the loop for the CPT.
* Let users decide letter case.

= 2 April 2014 =
* Minor style tweak.
* Minor style
* Styling adjustment for WP.com and Jetpack specific elements.

= 1 April 2014 =
* Adds a theme description.

= 26 March 2014 =
* Enable Infinite Scroll on archive pages too. Currently IS is enabled only blog index in WP.com.
* Minor style fix.
* Minor style fix.
* Minor color adjustment.
* Only add `has-post-thumbnail` post class below v3.9.
* Fix and imporvements based on peer review.

= 25 March 2014 =
* Minor style bug fix.
* Remove debug log and clean up the format little.
* Hover color change for secondary link color.
* JS cleanup.
* Change the display setting for portfolio page template. Style tweaks for sharedaddy elements.

= 24 March 2014 =
* Minor style adjustments.
* Minor style tweaks.
* Changes in typography.
* Style WP.com widegts.

= 23 March 2014 =
* Big images. Check native image size instead of width attribute because the attribute would be stripped out in here. Also adjust the content width for project and image post format.
* Clean up.
* Convert spaces to tabs.
* Test using Compass in WP.com and convert spaces to tabs.
* Test using Compass in WP.com.
* Add a theme option so that user can choose to display page title and content on the portfolio page template.
* Display page content on portfolio page template.
* Adjust the margin for VideoPress videos.

= 22 March 2014 =
* Adjust content_width value for full width template.
* Add a fallback navigation and style tweaks for sidebar and widgets.
* Initial Import.
