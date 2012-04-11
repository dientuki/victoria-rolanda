=== IntenseDebate XML Importer (Blogger to Wordpress) ===
Contributors: Swashata, GautamGupta
Donate link: http://www.intechgrity.com/about/buy-us-some-beer/
Tags: intense debate, import, importer, blogger, wordpress
Requires at least: 2.8
Tested up to: 3.0.1
Stable tag: 1.0.5

Import all comments from Blogger Intense Debate account to WordPress.

== Description ==

Have you ever been on Blogger and used Intense Debate as your Blogger Commenting system? Now when you are moving from WordPress to Blogger you might be thinking of losing all your comments, right?

This is where IntenseDebate XML Importer saves you! Although Intense Debate had a plugin to do this they have disabled the plugin due to system maintenance...

My bad luck was that I shifted my Blogger blog to WP at the time when ID disabled their existing plugin! But I did not want to lose my comments...

So I looked into their plugin code and their export XML file and wrote this plugin to import all the comments from the backup XML to my WP Blog! Have a look at the Installation page to get more idea!

### To Do List ###
* Add an option to manually insert post ids for failed imports.
* Still searching the best way to use the Intelligent Title match option. Currently it uses MySQL LIKE Query

== Installation ==

###Uploading The Plugin###

Extract all files from the ZIP file, **making sure to keep the file/folder structure intact**, and then upload it to `/wp-content/plugins/`.

**See Also:** ["Installing Plugins" article on the WP Codex](http://codex.wordpress.org/Managing_Plugins#Installing_Plugins)

*Actually this instruction portion is copied from another WP Plugin :P*

###Plugin Activation###

Go to the admin area of your WordPress install and click on the "Plugins" menu. Click on "Activate" for the "IntenseDebate XML Importer" plugin.

###Plugin Usage###

This is pretty much straight forward...

*   Go to your [Intense Debate](http://www.intensedebate.com) Dashboard and Export the XML file for the blog you want to process
*   Now go to the Plugins Settings page from the *Settings tab* and browse and upload the XML file
*   Select Proper options. You can enable Simulation mode (*Recommended*) to check the result before actually uploading.
*   Wait for sometime until it imports all the comments
*   Once done check your blog... If there remains some error then you have to fix that manually! In future release we may add some automated options
*   Finally disabled the Plugin! Hey... You need it only once ;)

###Upgrading the Plugin###

So far we have released a few versions of this plugin. You can just deactivate and delete old version and install the latest one from here

== Frequently Asked Questions ==

= From where can I download the XML file? =
From [Intense Debate](http://intensedebate.com/userDash) Dashboard navigate to your Site. Then from the sitebar Click on **XML Export**. From there save the generated XML file.

= Can I use Intense Debate as my WP commenting system as well? =
Of course you can! But before installing ID to your WP blog, make sure to run this plugin once! Else the comments for older posts won't appear!

= How can I move my Blogger Blog to WP without changing the Permalink structure? =
Quite offtopic! But still... [here](http://devilsworkshop.org/moving-from-blogger-to-wordpress-maintaining-permalinks-traffic-seo/) is the perfect guide for you! Even I have followed the same.

= So if I maintain the Permalinks, will the existing Intense Debate Account work? =
Quite intelligent question! Even I thought the same. But the reality is it won't work! When you install ID comment system from Blogger to WP then the comments according to the Permalink, remains stored inside ID database, not on WP database. So the comments would come on widgets by Intense Debate. But won't be shown on the actual post pages. So, you should import the comments, then use delete the existing ID site, then reinstall to make it fully compatible!

== Screenshots ==

You can check our Blog... [InTechgrity](http://www.intechgrity.com/?p=267)

== ChangeLog ==
= Version 1.0.5 (13-08-2010) =
* Fixed a big bug which was casuing insertion of comments on previous posts when no posts were found for the title
* Added an Intelligent Search option for better result

= Version 1.0.4 (13-08-2010) =
* Added a simulation mode to test the import result without actually inserting the comments to the database
* Fixed the duplicate comment bug a little more
* Now the plugin will tell you how much memory it has used. Useful for people on shared hosting.
* Set the time limit to 0 (unlimited) to avoid timeout error

= Version 1.0.3 (12-08-2010) =
* It will show the link to the post where the comments have been imported
* Will give a more precise result on how many comments out of the found comments have been imported to a particular post
* Will also showthe total number of posts and comments found on the uplaoded XML file
* Finds duplicated comments on the name, email and content basis. Removes the IP test and URL test. Dont know why, but Intense Debate shows a blank URL. So removed the URL test.
* While finding duplicate Comments instead of perfect match I now use a MySQL Like method. It minimizes the chances of getting duplicate comments

= Version 1.0.2 (11-08-2010) =
* Added the ability to translate the plugin
* Cleanup of code

= Version 1.0.1 (11-08-2010) =
* Initial release!

== Upgrade Notice ==
= 1.0.5 =
Added Intelligent Title Search option and fixed an important bug. Must Upgrade.

= 1.0.4 =
Added simulation mode, would show memory usage and fixed some bug.

= 1.0.3 =
The plugin would show exact results when importing comments.

= 1.0.2 =
Made the plugin at per with Wordpress Coding standard and added internationalization. Thanks to Gautam

= 1.0.1 =
Initial Release