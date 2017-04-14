=== Plugin Name ===
Contributors: webheadllc
Tags: contact form 7, multistep form, form, multiple pages, store form
Requires at least: 3.4.1
Tested up to: 4.1
Stable tag: 1.4.3
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Enables the Contact Form 7 plugin to create multi-page, multi-step forms.

== Description ==

Note: If you have a caching plugin or on a host with aggressive caching (i.e. WPEngine), this plugin may not work for you.  See FAQs for more details.

I needed a contact form that spanned across multiple pages and in the end would send an email with all the info collected.  This plugin does just that.  This plugin requires the Contact Form 7 Wordpress plugin.

Sample of this working is at [http://webheadcoder.com/contact-form-7-multi-step-form/](http://webheadcoder.com/contact-form-7-multi-step-form/)

**Usage**

I write horrible instructions, but luckily Michael at RoseAppleMedia understood it and created a great tutorial!

[youtube https://www.youtube.com/watch?v=jlMQpwD5l1Q]



Instructions:

1. Create a contact form 7 form as you normally would.

1. Add a hidden tag named "step" with the value being <current_step>-<total-steps>.  For example, if you have a 5-step form and you are creating the first step, the form would need: `[hidden step "1-5"]`.  The last form in this example would need: `[hidden step "5-5"]`

1. In the "Additional Settings" textarea at the bottom of the form editing page, add in the location of the next form.
If the next form is located on my-second-page on example.com you would add the following all on one line to "Additional Settings":  `on_sent_ok: "location.replace('http://example.com/my-second-page/');"` 

1. Repeat steps 1 - 3.  On the form that will actually send a email, do not do step 3 unless you want the form to redirect 
the user to another page.

In a contact form, to retrieve fields from previous forms you can use something like `[form your-email]` where "your-email" is the name of the field from the previous form.  This would be useful on the last step where it is confirming all the info from previous forms.

In a contact form you users may want to go back to a previous step to change some info they entered.  To allow the user to go back, add the `[back "Previous Step"]` button to the form.

**Additional Info**
The hidden field is taken directly from the "Contact Form 7 Modules".  If you have that installed, the Multi-Step plugin will use that.

This plugin does not support File Uploads.  If you need to use file uploads make sure to place it on the last step.

This plugin only works when the forms are on separate pages.  Many have asked to make it load via ajax so all forms can reside on one page.  This plugin does not support that.  You can try it on your own, but it is harder than it seems.


== Frequently Asked Questions ==

= I keep getting the "Please fill out the form on the previous page" message.  What's wrong? =

If you have everything set up correctly and you get a message saying, "Please fill out the form on the previous page" after submitting the first form, then it's probably your caching system not allowing cookies (and possibly sessions) to be set in the normal way.  No workarounds or fixes are planned at this time.  (This issue can be resolved on WPEngine [http://wordpress.org/support/topic/please-fill-out-previous-form-error?replies=4](http://wordpress.org/support/topic/please-fill-out-previous-form-error?replies=4)).


= How can I show a summary of what the user entered or show fields from previous steps? =

As stated in the instructions:  "In a contact form, to retrieve fields from previous forms you can use something like `[form your-email]` where "your-email" is the name of the field from the previous form."


= Why aren't you answering my question? =

This plugin is free for a reason.  Please go through the video tutorial provided by RoseAppleMedia carefully to make sure you have the plugin set up correctly.



== Changelog ==

= 1.4.3 =
fix exclusive checkboxes not saving on back.  added version to javascript.

= 1.4.2 =
fix radio button not saving on back. make sure its the last step before clearing cookies.

= 1.4.1 =
Fixed bug where tapping the Submit button on the final step submits form even with validation errors.

= 1.4 =
Updated to be compatible with Contact Form 7 version 3.9.

= 1.3.6 =
Updated readme to be more readable.
Fixed issue for servers with magic quotes turned off.  Fixes "Please fill out the form on the previous page" error.

= 1.3.5 =
Fix:  Also detect contact-form-7-3rd-party-integration/hidden.php so no conflicts arise if both are activated.

= 1.3.4 =
Fix:  Better detection of contact-form-7-modules plugin so no conflicts arise if both are activated.

= 1.3.3 =
Fixed back button functionality.

= 1.3.2 =
Some people are having trouble with cookies.  added 'cf7msm_force_session' filter to force to use session.

= 1.3.1 =
Added checks to prevent errors when contact form 7 is not installed.

= 1.3 =
Confused with the version numbers.  apparently 1.02 is greater than 1.1?

= 1.1 =
renamed all function names to be more consistent.
use cookies before falling back to session.
added back shortcode so users can go back to previous step.

= 1.02 =
updated version numbers.

= 1.01 =
updated readme.

= 1.0 =
Initial release.
