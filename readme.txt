=== Bake Posts ===
Contributors: wpnaga
Tags: recent post,category post,tag post,slug,id,limit,content,excerpt,title,thumbnail
Requires at least: 3.0.1
Tested up to: 5.2.1
Stable tag: 4.7
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Bake Post can be used to display recent posts and posts from particular category and tags. (Not compatible for Multisites)

== Description ==

Bake post is developed in order to display posts in pages or in widget areas just by pasting the respective shortcodes. Individual shortcodes are available for displaying recent posts, posts on categories and tags. It has a feature to display featured image as a thumbnail. Shortcode generator is also available to generate shortcodes according to requirement.

Shortcodes for displaying Recent Posts are

1.[bake-post-recent limit=5 excerpt="no" featured_image="yes"]

2.[bake-post-recent limit=5 excerpt="yes"]

These two short codes can be used to display recent posts. Excerpt option can be used to display description as excerpt or full content. Featured Image can also be displayed by setting featured_image="yes" in the shortcode.

Shortcodes for displaying Posts on category are

3.[bake-post-category term='slug' category='all' limit=5 excerpt="no" featured_image="yes"]

4.[bake-post-category term='slug' category='all,stories' limit=5 excerpt="yes"]

5.[bake-post-category term='id' category='1' limit=5 excerpt="yes" featured_image="no"]

6.[bake-post-category term='id' category='1,2,3' limit=5 excerpt="no"]

Term values differs from "id" or "slug". If Slug is used, category value should be category slug values. For example, if your category name is short stories, Slug will be short-stories. We can use multiple slug values seperated by commas. If id is used, category value should be category id values. For example, We can use multiple id values seperated by commas.Featured Image can also be displayed by setting featured_image="yes" in the shortcode.

Shortcodes for displaying Posts on Tags are

7.[bake-post-tags term='slug' tag='tag1' limit=5 excerpt="yes"]

8.[bake-post-tags term='id' tag_id='1,2,3' limit=5 excerpt="no"]

Featured Image can also be displayed by setting featured_image="yes" in the shortcode.

== Installation ==

1.Upload the bake-post directory to the /wp-content/plugins/ Directory (if not exists please create) or install using wordpress plugin installer

2.Activate the plugin through the 'Plugins' menu in WordPress


== Frequently Asked Questions ==

= Is it possible to use two shortcodes in a single page? =

Yes. You can use any number of shortcodes.

= Where can I use these shortcodes? =

You can use in your page,post and widget areas.

= Is it possible to display post published date?

Yes. Generate shortcodes using shortcode generator where you can hide and show published dates.

= Is it possible to display author and category of posts?

Yes.

= How to change number of characters to be displayed in description?

We can specify the character limit easily in the shortcode builder. 

== Screenshots ==
1. Screenshot of shortcode generator page.

2. Screenshot of pasting the generated shortcode in add new post page.

3. Showing the post page displaying recent posts.

== Changelog ==

= 2.2 =
* Included Author,Category and published date
* Included Character limit for excerpts
* Bug fixes

= 2.1 =
* Shortcode generator is included.
* Displays Featured Image also.
* Recent posts 
* Posts based on category
* Posts based on tags
* Title only, Excerpt, Content can be displayed
