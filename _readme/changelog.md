== Changelog ==


= v3.29.0 - 2019-02-27 =
------------------------

##### Improved Access Plan Management

+ Added a set of methods for creating access plans programmatically.
+ Updated the Access Plan metabox on courses and lessons with improved data validation.
+ When using the block editor, the "Pricing Table" block will automatically update when access plan changes are saved to the database (from LifterLMS Blocks 1.3.5).
+ Access plans are now created and updated via AJAX requests, resolves a 5.0 editor issue causing duplicated access plans to be created.

##### Student Management Improvements

+ Added the ability for instructors and admins to mark lessons complete and incomplete for students via the student course reporting table.

##### Admin Panel Settings and Reporting Design Changes

+ Replaced LifterLMS logos and icons on the admin panel with our new logo LifterLMS Logo and Icons.
+ Revamped the design and layout of settings and reporting screens.

##### Checkout Improvements

+ Updated checkout javascript to expose an error addition functions
+ Abstracted the checkout form submission functionality into a callable function not directly tied to `$_POST` data
+ Removed display order field from payment gateway settings in favor of using the gateway table sortable list

##### Other Updates

+ Removed code related to an incompatibility between Yoast SEO Premium and LifterLMS resulting from former access plan save methods.
+ Reduced application logic in the `course/complete-lesson-link.php` template file by refactoring button display filters into functions.
+ Added function for checking if request is a REST request
+ Updated LifterLMS Blocks to version 1.3.6

##### Bug Fixes

+ Fixed the checkout nonce to have a unique ID & name
+ Fixed an issue with deleted quizzes causing quiz notification's to throw fatal errors.
+ Fixed an issue preventing notification timestamps from displaying on the notifications dashboard page.
+ Fix an issue causing `GET` requests with no query string variables from causing issues via incorrect JSON encoding via the API Handler abstract.
+ Fix an issue causing access plan sale end dates from using the default WordPress date format settings.
+ `LLMS_Lesson::has_quiz()` will now properly return a boolean instead of the ID of the associated quiz (or 0 when none found)

##### Template Updates

+ [checkout/form-checkout.php](https://github.com/gocodebox/lifterlms/blob/master/templates/checkout/form-checkout.php)
+ [course/complete-lesson-link.php](https://github.com/gocodebox/lifterlms/blob/master/templates/course/complete-lesson-link.php)
+ [product/access-plan-pricing.php](https://github.com/gocodebox/lifterlms/blob/master/templates/product/access-plan-pricing.php)
+ [notifications/basic.php](https://github.com/gocodebox/lifterlms/blob/master/templates/notifications/basic.php)

##### Templates Removed

Admin panel templates replaced with view files which cannot be overridden from a theme or custom plugin.

+ `admin/post-types/product-access-plan.php`
+ `admin/post-types/product.php`


= v3.28.3 - 2019-02-14 =
------------------------

+ ❤❤❤ Happy Valentines Day or whatever ❤❤❤
+ Tested to WordPress 5.1
+ Fixed an issue causing JSON data saved by 3rd party plugins in course or lesson postmeta fields to be not duplicate properly during course duplications and imports.


= v3.28.2 - 2019-02-11 =
------------------------

##### Updates

+ Updated default country list to remove non-existant countries and resolve capitilization issues, thanks [nrherron92](https://github.com/nrherron92)!

##### Bug fixes

+ Fixed an issue causing the email notification content getter to use the same filter as popover notifications.
+ Fixed an issue preventing default blog date & time settings from being used when displaying an access plan's access expiration date on course and membership pricing tables.
+ Fixed an issue causing 404s on paginated dashboard endpoints when the permalink structure is set to anything other than `%postname%`.

##### Deprecations

+ `LLMS_Query->set_dashboard_pagination()`


= v3.28.1 - 2019-02-01 =
------------------------

+ Fixed an issues preventing exports to be accessible on Apache servers.
+ Fixed an issue causing servers with certain nginx rules to open CSV exports directly instead of downloading them.


= v3.28.0 - 2019-01-29 =
------------------------

##### Updates

+ Updated reporting table export functions to provide immediate download prompts of the files. Exports are generated in real time and you *must* remain on the page while it generates. The good news is if your site had issues with email or cronjobs it'll no longer be an issue for you.
+ Updated lesson metabox to use icons for attached quizzes
+ Added an orange highlight to the admin "Add-Ons & More" menu item
+ Removed unused cron event.

##### LifterLMS Blocks

+ Updated LifterLMS Blocks to 1.3.4
+ Adds support for handling courses & lessons in "Classic Editor" mode as defined by the Divi page builder
+ Skips course and lesson migration when "Classic" mode is enabled.
+ Adds conditions to identify "Classic" mode when the Classic Editor plugin settings are configured to enforce classic (or block) mode for *all* posts.

##### Database Updates

+ Unschedules the aforementioned unused cron event.

##### Bug fixes

+ Fixed an issue preventing the temp directory old file cleanup cron from firing on schedule.
+ During plugin uninstallation the tmp cleanup cron will now be properly unscheduled.
+ Fixed an issue causing notifications on the student dashboard to appear on top of static headers or the WP Admin Bar when scrolling.
+ Fixed an issue preventing manual updating of customer and source information on orders resulting from unfocusable hidden form fields.
+ Fixed mismatched HTML tags on the Admin Add-Ons screen

##### Deprecations

+ Class method: `LLMS_Admin_Table::queue_export()`
+ Class: `LLMS_Processor_Table_To_Csv`


= v3.27.0 - 2019-01-22 =
------------------------

###### Updates

+ Added the ability to add existing questions to a quiz in the course builder. This allows cloning of existing questions as well as attaching "orphaned" questions currently attached to no quizzes.
+ Added the ability to detach questions from quizzes. Coupled with adding existing questions, questions can now be easily moved between quizzes.
+ Added permalink capabilities to the builder to allow linking to specific items within the builder (a lesson, quiz, etc...).
+ Quizzes with 0 possible points will no longer show a Pass/Fail chart with a 0% (failing) grade on quiz results screens.
+ Replaced option `lifterlms_lock_down` which cannot be set via any setting with a filter to reduce database calls. This will have no effect on anyone unless you manually set this option to "no" via a database query. Having done this would allow the admin bar to be shown to students.

##### Bug Fixes

+ Fixed an issue causing the default "Redeem Voucher" and "My Orders" student dashboard endpoint slugs from not having the correct default values. Thanks [@tnorthcutt](https://github.com/tnorthcutt)!
+ Fixed an issue causing quotation marks in quiz question answers to show escaping slashes on results screens.
+ Fixed a bug preventing viewing quiz results for quizzes with questions that have been deleted.
+ Fixed a bug causing a PHP Notice to be output when registering a new user with a valid voucher.

##### Templates Changed

+ [quiz/results-attempt.php](https://github.com/gocodebox/lifterlms/blob/master/templates/quiz/results-attempt.php)


= v3.26.4 - 2019-01-16 =
------------------------

+ Update to [LifterLMS Blocks 1.3.2](https://make.lifterlms.com/2019/01/15/lifterlms-blocks-version-1-3-1/), fixing an issue preventing template actions from being removed from migrated courses & lessons.


= v3.26.3 - 2019-01-15 =
------------------------

##### Updates

+ Fix issue preventing course difficulty and course length from being edited when using the classic editor plugin.
+ Improved pagination methods on Student Dashboard Endpoints
+ "My Notifications" dashboard tab now consistently paginated like other dashboard endpoints
+ Update to [LifterLMS Blocks 1.3.1](https://make.lifterlms.com/2019/01/15/lifterlms-blocks-version-1-3-1/).

##### Bug Fixes

+ Fixed an issue preventing course difficulty and course length from being edited when using various page builders.
+ Fixed issues causing errors on quiz reporting screens for quiz attempts made by deleted users.

##### Deprecated Functions

+ `LLMS_Student_Dashboard::output_notifications_content()` replaced with `lifterlms_template_student_dashboard_my_notifications()`

##### Templates Changed

+ [myaccount/my-notifications.php](https://github.com/gocodebox/lifterlms/blob/master/templates/myaccount/my-notifications.php)
+ [admin/reporting/tabs/quizzes/attempt.php](https://github.com/gocodebox/lifterlms/blob/master/templates/admin/reporting/tabs/quizzes/attempt.php)


= v3.26.2 - 2019-01-09 =
------------------------

+ Fast follow to fix incorrect version number pushed to the readme files for 3.26.1 which prevents upgrading to 3.26.1


= v3.26.1 - 2019-01-09 =
------------------------

##### Updates

+ Tested to WordPress 5.0.3
+ Student CSV reports will now bypass cached data during report generation.
+ Add course and membership catalog visibility settings into the block editor.
+ Includes LifterLMS Blocks 1.3.0.

##### Bug Fixes

+ Fixed issue preventing the course instructors metabox from displaying when using the classic editor plugin.
+ Fixed an issue causing membership background enrollment from processing when the course background processor is disabled via filters.
+ Fixed an issue causing errors when reviewing orders on the admin panel which were placed via a payment gateway which is no longer active.
+ Fixed an issue preventing course difficulty and course length from being edited when using the classic editor plugin.
+ Fixed a very convoluted conflict between LifterLMS, WooCommerce, and Elementor explained at https://github.com/gocodebox/lifterlms/issues/730.