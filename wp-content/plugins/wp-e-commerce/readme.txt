=== WP e-Commerce ===
Contributors: mufasa, mychelle, garyc40, JustinSainton
Donate link: http://getshopped.org
Tags: e-commerce, wp-e-commerce, shop, cart, paypal, authorize, stock control, ecommerce, shipping, tax
Requires at least: 3.1
Tested up to: 3.4.2
Stable tag: 3.8.9.3

WP e-Commerce is a free WordPress Shopping Cart Plugin that lets customers buy your products, services and digital downloads online.

== Description ==

We make setting up an ecommerce shop easy, and with over 2 Million downloads, we have unparalleled experience.

Features:

= WordPress Integration =
* Easy to install WordPress plugin
* Works with any standards compliant WordPress theme
* Plays well with other Plugins
* Supports regular WordPress widgets, as well as a few snazzy ones of our own
* Utilizes shortcodes and template tags (just like WordPress)
* Works out-of-the-box with WordPress MU (make sure you use sub domains with your MU setup)

= 100% Customizable =
* A designers dream – use your own HTML & CSS and have complete control over the look and feel of your store
* Easy to modify templates

= Amazing Support =
* Lots of video tutorials
* Guaranteed speedy response (through our premium forums)
* Access to instant support from our community of users

= Payment Gateways Integration =
* Manual Payment (checks/money orders) (included)
* PayPal Payments Standard (included)
* PayPal Payments Pro (included)
* PayPal Express Checkout (included)
* Google Checkout (Level 2) (included)
* Chronopay (included)
* PayPal Payflow Pro (available with Gold Cart)
* Authorize.net (available with Gold Cart)
* FirstData/LinkPoint (available with Gold Cart)
* eWay Payment (available with Gold Cart)
* iDEAL (available with Gold Cart)
* BluePay (available with Gold Cart)
* DPS (available with Gold Cart)
* Paystation (available with Gold Cart)
* SagePay (available with Gold Cart)
* If you still aren’t happy, we provide you with the necessary info to write your payment gateway

= Marketing =
* Flexible coupon/discount pricing rules
* Product specific sales
* Quantity discounts
* Free shipping options
* Multi-tier pricing for quantity discounts.
* Search Engine Friendly URLs
* New Products widget
* Cross-sells on product pages (in 3.8 this is now available as a Plugin)
* Google Site Map
* Uses the popular “Share This” button for easily promoting your products on popular social networking sites
* Integrates with Facebook Marketplace (Facebook Marketplace API has closed – we’re working on it)
* Integrates with Google Base
* Integrates with Campaign Monitor for advanced email marketing
* Integrates with Intense Debate for shared comments
* Mail Chimp integration coming soon

= Search Engine Optimization =
* 100% Search Engine Friendly
* Meta-information for products and categories
* RSS feeds for products and categories
* Integrates with Google (XML site maps and Google Merchant Centre)
* Integrates with the All in One SEO plugin for WordPress (which includes Google Analytics)

= Internationalization Support =
* Multi-lingual (the first Plugin to fully utilize and integrate with GlotPress)
* Support for multiple currencies
* Ability to target specific countries

= Shipping =
* Integrates with UPS, USPS, Australia Post and Shipwire for real-time shipping rates
* Flexible built-in shipping rate calculators
* Domestic and global shipping rates
* Flat rate shipping
* Table rate shipping
* Weight rate shipping

= Checkout =
* One-Page Checkout or Stepped Checkout, whichever you prefer
* SSL security support for orders on both front-end and back-end
* Checkout without account/Guest Checkout
* Shopping Cart with tax and shipping estimates
* Option to create account at beginning of checkout
* Fully customizable checkout page

= Managing Orders =
* Admin dashboard for sales overview
* Export orders and customers into CSV formats
* Order history with labels for order processing status
* Email notifications of orders
* Print invoices and packing slips

= Catalog Management =
* Single-page product data entry
* Ability to duplicate products
* Quickly edit your products from the store front (saving you heaps of time)
* Smart Groups allow you to organize your products with hierarchical categories, as well as by brand.
* Batch import/export of catalog
* Google Base integration
* Product variation management
* Create attributes on the fly
* Downloadable/Digital Products
* Support for donations
* Customer Personalized Products
* Media Manager with automatic image resizing
* Handles multiple product images with easy drag-and-drop sorting
* support for Special Prices
* Tax rates per location
* Basic inventory control

= Catalog Browsing =
* Live product search – mmm just like apple.com (available add on)
* Cross-sells
* Product listing in list format
* Product listing in grid format (available with Gold Cart)
* Breadcrumbs
* Product Image Zoom-in Capability
* Stock Availability
* Multiple Images Per Product (activated with Gold Cart)
* Product comments
* Filter by Product Tags
* New Products widget
* Features Products widget
* Live updating shopping cart (put it wherever you want)

= Additional Modules =
* Gold Cart & Grid Module – adds more options and functionality to your store
* Drop Shop – an incredibly snazzy way for buyers to add products to their cart, via a simple drag n drop process.
* Mp3 Audio Player – Preview audio clips on your website
* NextGen Gallery Buy Now Buttons – turns your NextGen gallery into an ecommerce solution
* Product Slider – Display your products in a new and fancy way
* Members Only Module – Create pay to view subscription sites

For more information visit [http://getshopped.org](http://getshopped.org "http://getshopped.org")

== Installation ==

1. Upload the folder 'wp-e-commerce' to the '/wp-content/plugins/' directory
2. Activate the plugin through the 'Plugins' menu in WordPress

= Updating =

Before updating please make a backup of your existing files and database. Just in case.
After upgrading from earlier versions look for link "Update Store". This will update your database structure to work with new version.

== Changelog ==
= 3.8.9.3 =
* New: Add support for quantity field in default grid view template.
* New: Let plugins add new column to product variation list table via filter 'wpsc_manage_product_variations_custom_column'.
* Fix: Blank transaction results page when using paypal gateways.
* Fix: Comment form is displayed even though comment is closed on products page.
* Fix: Fatal error in formatting.php for some sites.
* Fix: New countries in 3.8.9 automatically added to target market list.
* Fix: PayPal Standard doesnt' take care of coupons.
* Fix: Punctuation in pending transaction email.

= 3.8.9.2 =
* Fix: Admin cannot download file from product edit page.
* Fix: Compatibility issues with Jetpack.
* Fix: Google Analytics is printed out even when it's not active. Also, PHP notice when the product doesn't have a category.
* Fix: Make sure PayPal Standard works with 100% discount.
* Fix: Product page title is not properly replaced with the category or tag title in WP 3.5.
* Fix: Products are sometimes displayed even when products page is set to only display list of categories.
* Fix: Products thumbnail sizes are inconsistent with the settings.
* Fix: Properly flush outdated customer meta from the transient table.
* Fix: Typo in wpsc_cart::update_location().
* Fix: Wrong class attribute for price display.

= 3.8.9.1 =
* Fix: Fatal error in Shipwire.
* Fix: Fatal error with customer meta on multisite.
* Fix: Fatal error with get_the_product_tags().
* Fix: Pagination in admin product list doesn't work.
* Fix: Permalinks are incorrect when products page is set as home page and permalink scheme is set to %post_name%.
* Fix: Rewrite rules are not regenerated correctly when switching from "Default" to "Post name".
* Fix: Shipwire and Google Analytics are not working properly.
* Fix: Shipwire request is sent even when Shipwire is not active.
* Fix: States are displayed as numbers in admin purchase report.
* Fix: Transaction results displaying cart content twice as well as "Oops, there is nothing in your cart".
* Fix: Use customer meta instead of $_SESSION for eway and payflow message.
* Fix: Variation pagination doesn't work.

= 3.8.9 =
* New: Additional columns can now be added to Store Sales page via filter hook.
* New: Additional filters for purchase log notification classes.
* New: Allow devs to filter the list of accepted credit cards in PayPal Pro.
* New: Filters to enable image scaling (versus cropping).
* New: Hook to modify the product table on transaction results and purchase receipts.
* New: Make buy now button's html output filterable.
* New: More flexibility in role management.
* New: New Hook for cancelling subscriptions with Memebers Access.
* New: Pagination UI for product variations.
* New: Users can bulk edit products' stock, price, sales price etc.
* New: Users can now choose to "Notify site owner" and "Unpublish product" separately when stock runs out.
* New: Users can now delete checkout form sets.
* New: Users can now set product sorting direction in Settings->Presentation.
* New: Variation UI enhancements.
* Change: "Registration required" and "Anyone can register" are now synchronized.
* Change: Default checkout shipping option to lowest shipping cost of all choices.
* Fix: "Variation Controls" anchor in metabox leads nowhere.
* Fix: AJAX code audit (security)
* Fix: Activating WP e-Commerce on a vanilla WordPress installation with pretty permalinks enabled messes up the rewrite rules.
* Fix: Add a space after tilde character to avoid confusion in admin product list.
* Fix: Add new variation sets and terms from Edit Product page doesn't work properly.
* Fix: Additional description is double escaped in product edit page.
* Fix: Alignment of checkboxes and radios in product category edit page is a bit off.
* Fix: Avoid using query_posts() which could break themes.
* Fix: Backslashes are sometimes added to UPS and USPS settings.
* Fix: Base_region option remains set if base country is switched.
* Fix: Billing phone number not accessible via wpsc_merchant::$cart_data.
* Fix: Buy Now feature doesn't properly create and update sales log.
* Fix: Can't add variations on new products.
* Fix: Can't delete coupon conditions.
* Fix: Can't order products properly in Products admin page.
* Fix: Can't upload product category image when adding a new category.
* Fix: Cannot set thumbnail for variations.
* Fix: Cart item name is not updated when corresponding variation name is changed.
* Fix: Cart items are not translated for qTranslate.
* Fix: Cart mix up when multisite is enabled.
* Fix: Category image size metadata are not used properly on templates.
* Fix: Category title is replaced with the first product's title, and pagination does not work correctly on Category page.
* Fix: Changing an order status in Sales Log page incorrectly updates the views and pagination links.
* Fix: Changing checkout field sort order doesn't work.
* Fix: Checkout- Parent Product Thumbnail Displayed Instead of Product Variation Thumbnail.
* Fix: Claimed stock cronjob doesn't take into consideration timezone.
* Fix: Collapse product variation sets by default on Manage tab.
* Fix: Colorbox Gallery doesn't work.
* Fix: Country dropdown lists disregard Target Market option.
* Fix: Coupon is not invalid is displayed even when there's no coupon applied.
* Fix: Coupon start and expiry date don't take into account local timezone.
* Fix: Currency converter doesn't work for some particular currencies.
* Fix: Custom fields are missing in purchase log if they have the same name as other fields.
* Fix: Customers are able able to purchase scheduled but unpublished products.
* Fix: Database upgrade routines.
* Fix: Division by zero in product-template.php.
* Fix: Dollar signs are used in flat rate settings regardless of the main currency.
* Fix: Duplicating a Product doesn't duplicate the images correctly.
* Fix: Email information in "Admin" settings tab is not displayed properly.
* Fix: Enabling shipping but not selecting any shipping methods causes frustrating unexpected issues.
* Fix: Fatal error in PayPal Pro settings page.
* Fix: Fatal error in checkout page form validation.
* Fix: Fatal error when quick editing products.
* Fix: Fatal error when upgrading from 3.7.x.
* Fix: Final breadcrumb id tag is not W3C Compliant.
* Fix: Free shipping discount is not updated when shipping method is changed.
* Fix: Free shipping doesn't reset individual cart items' shipping amounts when submitted to PayPal.
* Fix: Free-shipping doesn't work on PayPal Pro if the discount amount > item total.
* Fix: Google Analytics is now tracking correctly.
* Fix: Great Britain is redundant in country list (we already have U.K. and North Ireland).
* Fix: Improper escaping of user input.
* Fix: Inaccurate dimension calculation in Australia Post.
* Fix: Incompatibility with $_SESSION.
* Fix: Incorrect i18n in Presentation tab.
* Fix: Increase gateway timeout settings across the board.
* Fix: Inefficient pinging when product is updated.
* Fix: Infinite loop on single product page.
* Fix: Infinite loop when using PayPal Pro.
* Fix: Issue with SSL and Share This URL.
* Fix: Latest product widget doesn't show image.
* Fix: Logic error in function wpsc_product_has_stock.
* Fix: Make it clear that the sidebar widget doesn't include discount.
* Fix: More flexibility in role management.
* Fix: New coupon conditions are added below the first condition instead of the last.
* Fix: Number of products per page field in shortcode generator doesn't work.
* Fix: On user details page, switching country to a country without region won't display the State (Region) text field.
* Fix: Only display permalink double save warning if WordPress version is earlier than 3.3.
* Fix: Outdated country codes and currency codes.
* Fix: Pagination does not work with price range widget.
* Fix: Pagination for category short codes does not work.
* Fix: Pagination for tags does not work.
* Fix: Pagination links generated with unnecessary "page/" portion for WP 3.4.
* Fix: Pagination links in Category shortcode page are not consistent.
* Fix: Parent product is still treated as if it had variations even though all its variations have been moved to trash or hidden (set to draft).
* Fix: PayPal Express Checkout doesn't take into account free shipping.
* Fix: PayPal Standard Subscriptions produce unexpected product title in PayPal cart and receipts.
* Fix: Performance improvement for dynamic stylesheet.
* Fix: Placeholder image is missing for products without thumbnails.
* Fix: Potential height issue with variation edit iframe (parent hidden overflow, expand/collapse checkboxes).
* Fix: Prevent segmentation fault when using wpsc-products shortcode.
* Fix: Product Specials Widget does not work with product variations on sale.
* Fix: Product page URLs are sometimes not updated properly.
* Fix: Product permalinks in single product view are not using current category path.
* Fix: Products page pagination fails if the products page is set as the homepage.
* Fix: Products with variations on sale does not display the prices correctly.
* Fix: Purchase logs list table doesn't have Total line as before 3.8.8.
* Fix: Refactor purchase log notifications to fix various issues:
* Fix: Region field is not consistently updated or displayed when selecting a country without regions on checkout form.
* Fix: SKU should be sent to PayPal Standard instead of Product ID if that's available.
* Fix: Shipping error is reported when "Shipping same as billing" is selected on the checkout page, even when shipping is disabled.
* Fix: Shipping location error message is displayed before the customer has a chance to specify state and zip code.
* Fix: Shipping method and option are not displayed on Sales Log single page if there is no shipping form fields.
* Fix: Shipping options not refreshed when "shipping same as billing" causes new quotes.
* Fix: Shipping rate choice not correctly encoded during checkout.
* Fix: Shipwire settings are broken.
* Fix: Shortcode button doesn't work in visual mode if WP folder configuration is different from default.
* Fix: Table rate shipping doesn't accept $0 amount.
* Fix: Target makret restrictions for product categories is broken.
* Fix: Tax bands not working.
* Fix: Template tags for product tags don't work.
* Fix: Terms & Conditions validation code is broken.
* Fix: Total Price not properly reflective of the total after $1,000.
* Fix: Transaction results refactor.
* Fix: Updating purchase log status doesn't update pagination count
* Fix: Unnecessary thumbnail regeneration on product single page.
* Fix: Update message is displayed even when the db has bene updated.
* Fix: Updating region when "Same shipping as billing" is checked doesn't update the shipping quote.
* Fix: Use $cart_item->get_title() instead of $cart_item->product_name.
* Fix: Use array instead of strings when calling WP_Query in wpsc_the_variation_price.
* Fix: Users are now warned that setting products per row for grid view to 0 would probably lead to layout breakage.
* Fix: Using 2 checkout sets shows incorrect order on Purchase History and Your details pages.
* Fix: Valid checkout fields are not preserved when there are invalid fields.
* Fix: Variation drag'n'drop sorting is not working.
* Fix: Various bugs and inconsistencies with coupon conditions.
* Fix: WPEC loads product image then scales to thumbnail size in the backend products list.
* Fix: Weird Taxable Amount column.
* Fix: When "Free Shipping" is enabled in Settings->Shipping, shipping is always set to 0 even when shipping discount value is set to 0 or empty.
* Fix: Wrong alternate row class for variation inline shipping editor.
* Fix: Wrong documentation link for Chronopay.
* Fix: Wrong logic in deprecated function nzshpcrt_currency_display().
* Fix: _wpsc_process_transaction_coupon() contains typos.
* Fix: also bought image path is supposed to be fixed already.
* Fix: i18n audit.
* Fix: improper escaping in Price metabox.
* Fix: post_status is not formatted correctly in wpsc_start_the_query().
* Fix: private products are listed on the /products/ page.
* Fix: wpsc_list_dir() should return empty array if directory is empty.
* Fix: wpsc_shopping_cart() function call doesn't work.
* Fix: wpsc_the_product_thumbnail() ignores custom width and height.

= 3.8.8.5 =
* Fix: Order Closed status does not count in the sales log totals on dashboard widget.
* Fix: PHP preg_replace warning.

= 3.8.8.4 =
* Fix: Also bought product image doesn't display correctly.
* Fix: Pagination fails when hierarchical category URL is enabled.
* Fix: Product Specials Widget causes 404 errors. Props Chris Jean.
* Fix: Product category slug beginning with a digit doesn't work.
* Updated localization.

= 3.8.8.3 =
* Fix: Incompatibility between WPEC products page pagination and WordPress 3.4.

= 3.8.8.2 =
* Change: CSV sales export now puts the item quanity in a separate column from the product title.
* Fix: Core checkout fields cannot be restored if they were deleted before upgrading to 3.8.8.
* Fix: Insecure SSL resources when WordPress is using SSL, or "Force SSL Checkout" is enabled.
* Fix: Issue with WPML and Variations.
* Fix: Shipping & Total Order values are wrong on Sales Log page.
* Fix: Terms and Conditions - Checkout page breaks if you read the terms and conditions.
* Fix: Total shipping value and total price incorrect in transaction results.
* Fix: Variation sales prices are inaccurate in Product Specials Widget

= 3.8.8.1 =
* Fix: CSV import not working in 3.8.8.
* Fix: Category page display setting does not override default Presentation settings.
* Fix: Clicking All/None in Category target market settings doesn't work.
* Fix: Non-SSL stylesheet is loaded even when force SSL for checkout page is on.
* Fix: PHP Warning and Notice in sales log page.
* Fix: PayPal currency converter is wrong.
* Fix: Sales logs are not displayed for some installations.
* Fix: Sales logs page sometimes display empty customers' names.
* Fix: Saving payment gateway settings erase Shipping settings.
* Fix: Sometimes clicking Save doesn't save tracking ID on sales log page.

= 3.8.8 =
* New: Actions for bulk actions on sales page: wpsc_sales_log_process_bulk_action, wpsc_sales_log_extra_tablenav
* New: Allow variation checkboxes to be collapsed & expanded without having to tick the variation set checkbox itself.
* New: Digital Download UI improvement.
* New: Extra hooks during checkout cart display: wpsc_before_checkout_cart_row, wpsc_before_checkout_cart_item_image, wpsc_after_checkout_cart_item_image, wpsc_before_checkout_cart_item_name, wpsc_after_checkout_cart_item_name, wpsc_after_checkout_cart_row
* New: Filter for ordering the sales logs: wpsc_purchase_logs_orderby.
* New: Filter wpsc_cart_shipping.
* New: Filter wpsc_default_shipping_quote.
* New: Filter wpsc_item_shipping_amount_db.
* New: Filter wpsc_paypal_standard_post_data.
* New: Filter wpsc_product_permalink_cat_slug.
* New: Filter wpsc_product_postage_and_packaging.
* New: Filter wpsc_shipping_quote_value.
* New: Filters wpsc_calculate_total_tax, wpsc_coupons_amount.
* New: 4 new filters for user meta in profile page and during checkout.class.php - wpsc_checkout_user_profile_get - wpsc_checkout_user_profile_update - wpsc_user_log_get - wpsc_user_log_update.
* New: Settings Page API.
* New: Some helpful filters to download_csv function: wpsc_purchase_log_start_end_csv, wpsc_purchase_log_month_year_csv, wpsc_purchase_log_month_year_csv, wpsc_purchase_log_csv_headers, wpsc_purchas_log_csv_output
* New: Variation Drag & Drop sorting.
* Change: Display file names instead of the product name on the downloads page.
* Change: Improved variation UI in Product Edit page.
* Change: In General Settings page, when changing country, load region / state list using AJAX instead of page reload.
* Change: Only display variants' associated terms in Product Edit page rather than including the parent product name, which is redundant and cluttered.
* Change: PayPal Standard settings now just offer dropdown of "live" / "sandbox" rather than URL entry.
* Change: Subtle UX tweaks for Store Settings page.
* Fix: %-based shipping cost is not working internationally.
* Fix: $wpsc_query->query_vars['wpsc_product_category'] not always set on product page with hierarchical category permalinks.
* Fix: Cannot add new Checkout field.
* Fix: Cannot re-re-send buyer receipt.
* Fix: 3.7 -> 3.8 Database Upgrade Routine causes some products with variations to display a $0.00 price.
* Fix: Double <p> tag with wpec_taxes_display_tax_bands() on product edit page.
* Fix: Fatal error when trying to include a non-existent admin file.
* Fix: Hide Google Feed information from display
* Fix: Incompatibility with Genesis framework in Product Edit page.
* Fix: Make the WP e-Commerce 3.8.x activation/installation routine much more efficient.
* Fix: Mandatory fields in user_log_functions.php are not properly validated.
* Fix: Memory improvement for productfeed.
* Fix: Purchase logs have incorrect time if a timezone is specified in Settings->General.
* Fix: Summary line does not get updated when sales log status is changed.
* Fix: Total Quantity check fails for coupon codes.
* Fix: USPS: "FLATE RATE ENVELOPE" should be changed to "VARIABLE" to allow for shipping quotes to be based on weight.
* Fix: Use ->add_help_tab() to support WP 3.3 admin screen API.
* Fix: Using discount causes Paypal Express to calculate wrong total amount.
* Fix: get_the_content() is not enough in product feed.
* Fix: settings page JS compatibility issue with Firefox.
* Fix: wpsc_get_template_file_url() function is inefficient and causes 10 extra SQL queries per page load.

= 3.8.7.6.1 =
* Fix: PHP Warning for 'wpsc_load_settings_page' callback.
* Fix: PHP Warning in wpsc-transaction_results_functions.php.
* Fix: get_current_screen() is not available in WP 3.0.

= 3.8.7.6 =
* New: Default hook to filter sessionid for previously selected payment gateways.
* Change: Stock notification emails are now sent to "purchase log email address" rather than admin address.
* Fix: SQL injection vulnerability.
* Fix: 3.7 -> 3.8 Database Upgrade Routine fails when importing variations sets with the same name.
* Fix: Category link structure is not correct in pagination links with hierarchical category permalink.
* Fix: Fix SQL error when using "?items_per_page=all" query.
* Fix: Missing "Use as product thumbnail" on WordPress 3.3.
* Fix: Products Page does not support custom page template - uses page.php instead.
* Fix: Products page, category items per page is broken, relies on 'posts per page' setting in Settings -> reading.
* Fix: Sticky post view broken due to deprecated query_string filter.
* Fix: Sub-pages of Products Page aren't supported.
* Fix: Total Quantity check for coupons.
* Fix: Use ->add_help_tab() to support WP 3.3 admin screen API.
* Fix: [wpsc_products] shortcode does not use 'Sort Product By' setting - it defaults to date-based ordering.
* Fix: dashboard.css is loaded for WordPress > 3.3 (404 error).

= 3.8.7.5 =
* Fix XSS vulnerability.

= 3.8.7.4 =
* Fix: "Session expired" error when viewing Customer Account page.

= 3.8.7.3 =
* Security fixes.

= 3.8.7.2 =
* New: Support for g:availability to Google Merchant Centre feed. Props bbaskets & longercat
* Fix: Admin product page sorting by column was not working.
* Fix: Call to undefined function wpsc_clear_stock_claims().
* Fix: Checkbox and Radio buttons have unexpected issues in checkout.
* Fix: Checkout field options' values are mutilated before getting inserted into the database.
* Fix: PayPal standard IPN fails if data used to validate the IPN POST contains ' or ".
* Fix: Price incorrectly updated when multiple products with variations exist on the same page.
* Fix: Security vulnerability.
* Fix: ShareThis integration does not properl respect HTTPS connections.
* Fix: The Terms and conditions checkbox on the checkout page should have a required field asterisk, just like all other required checkout fields do.
* Fix: Wrong login URL for [userlog] page.
* Fix: Zero shipping price doesn't work in flatrate.php.
* Fix: invalid HTML on checkout page for default theme.
* Fix: wpsc_coupons::uses_coupons() needs optimization.

= 3.8.7.1 =
* Fix: Fancy notifications not being displayed on single product page.
* Fix: Sale and normal prices are switched around.

= 3.8.7 =
* New: 'insert_child_product_meta' filter to allow customising of meta data when a variation product (child product) is created.
* New: 'wpsc_variation_groups' and 'wpsc_all_associated_variations' filters. Allows customising order of variation menu items etc.
* New: Add hook "wpsc_product_form_fields_end" and rename "wpsc_product_form_fields" to "wpsc_product_form_fields_begin" to offer more flexibility when adding new fields to the product form.
* New: Add hooks "wpsc_add_to_cart_button_form_begin" and "wpsc_add_to_cart_button_form_end" when outputting [add_to_cart] shortcode. wpsc_add_to_cart_button() is also refactored to get rid of ugly repetitive "$output .= ".
* New: Additional hooks for adding extra FORM fields to the add to cart form.
* New: Additional filter hooks for product price and transaction result messages.
* New: Allow hierarchical product category URL.
* New: Hooks 'wpsc_product_form_fields_begin' and 'wpsc_product_form_fields_end' for list and grid views.
* New: Option to set claimed stock clearance interval (Store Settings -> General).
* New: filterable g:shipping_weight to google product feed. Thanks to Rudy Hassall.
* Change: Proper post updated messages - now says "Product updated" instead or "Post updated".
* Change: Settings tabs are restyled to conform with WordPress UI. Props Pippin.
* Fix: A product is displayed as "sold out" when its variations' stock control options are turned off.
* Fix: Additional Checkout Form Fields Not Showing with Variation. Props jRayx.
* Fix: Australia Post shipping quote caching by reducing the transient key length from 51 to 41 characters.
* Fix: AJAX error when changing country with a coupon applied.
* Fix: Breadcrumbs not showing for empty product categories.
* Fix: Discounts / coupons not passing to Paypal Standard.
* Fix: Error with merging image metadata in Media popup. Props Ben Huson.
* Fix: Fancy notifications are sometimes output twice.
* Fix: Fatal memory allocation error in Add Product page when WPEC downloadable folder is not created yet.
* Fix: Incompatibility with WP 3.3-dev (dashboard.css is merged into wp-admin.css).
* Fix: JavaScript globals not properly escaped, causing fatal JS errors due to internationalized strings that have single quotes in them.
* Fix: Paypal Express Checkout fails if product names contain unicode special characters.
* Fix: Paypal Standard passes wrong discount amount.
* Fix: PHP Notice when activating wpec, resulting in 'unexpected output' error message.
* Fix: PHP Notice when editing product category.
* Fix: PHP notice in wpsc-functions.php.
* Fix: Product categories sometimes disappear in admin (but still show on front end).
* Fix: Product variations not deleted when deleting a product from the trash.
* Fix: Products with variations display 'from' even if all prices are the same. Change: Product that have variations will display "from" price regardless of whether the variations are in stock or not (to avoid inconsistency).
* Fix: Removing additional description of a product doesn't have any effect. Props groques.
* Fix: SQL error when updating from 3.7.
* Fix: Saving thumbnail settings caused PHP timeout.
* Fix: Single product image is not re-generated properly sometimes.
* Fix: User submitted data is double-escaped, causing slashes to be stored in database table and sent to payment gateways.
* Fix: Variations are not cloned properly when duplicating a product, causing error / hang in wp-admin.
* Fix: WP Menus items don't apply current-menu-item (and ancestor) for product categories.
* Fix: When on the edit products page, the filter by category menu does not show subcategories if the parent has no products. Props benjaminhuson.
* Fix: for paypal express, coupons being included when there are none
* Fix: is_home() is true when viewing default category on products page.
* Fix: login redirect on checkout page if WordPress files are in a subfolder.
* Fix: $wpsc_cart->use_shipping() returns true even when shipping is disabled.
* Fix: wpsc_display_purchlog_totalprice() returns wrong value. Props dlingren for initial patch.
* Fix: wpsc_is_single_product() returns false even when viewing a single product. Props Ben Huson for initial patch.
* Fix: wpsc_the_product_thumbnail() sometimes returns relative URL instead of absolute URL, which causes image failure in Google Product Feed.


= 3.8.6.1 =
* Fix: Security vulnerability in chronopay.

= 3.8.6 =
* New: Filter for 'wpsc_display_product_multicurrency'.
* New: Additional filters for compatibility with WPML.
* Change: Discount information is now displayed on the Packing Slip.
* Fix: Sometimes wpsc_product_has_multicurrency() returns true when it should return false.
* Fix: Edit product page makes many database queries if you have lots of variations.
* Fix: Variation prices are not calculated correctly.
* Fix: Request-URI Too Large error when searching on the Admin Products page with lots of products.
* Fix: Add to cart shortcode doesn't display fancy notifications, and also doesn't check whether variations are selected.
* Fix: Infinite AJAX loop on checkout page when Same as Billing is checked.
* Fix: Per-item shipping total is calculated incorrectly in various places (Packing Slip, Sales Report etc.).
* Fix: Wrong product link when the product is assigned multiple categories.
* Fix: Canonical tags are not generated correctly for products with multiple categories.
* Fix: Edit variations inline messes up columns when stock limitation is disabled.
* Fix: Product with no category selected is not automatically assigned a default category when sort by drag&drop is enabled.
* Fix: Unnecessary use of livequery in variations.js causes Product edit page to freeze when there are many variation sets.
* Fix: Slashes added to checkout form field that has single quotes in it (e.g: O\'Connor).
* Fix: Multicurrency price is truncated when displayed.
* Fix: Checkout page keeps refreshing without displaying Google Checkout Button.
* Fix: Discount doesn't work with Paypal Standard.
* Fix: wpsc_single_template is not removed from the_content after it's run, causing subsequent the_content() calls to output the single product again.
* Fix: Sorting product categories is broken.
* Fix: Coupon rule "In Category" not taken into consideration.
* Fix: WPEC default stylesheet imposes #content font-size.
* Fix: Incompatibility with Prototype JS library.
* Fix: Checking (or unchecking) Stock checkbox when editing product causes variation table columns to break.
* Fix: jQuery 1.6 incompatibility with attr( 'className' ).


= 3.8.5 =
* New: Added hooks to support WPML.
* New: Links to WP e-Commerce documentation for individual payment gateways.
* Change: User can specify 0 in thumbnail width or height to make it scale proportional.
* Change: Show display name, not internal name for shipping method on purchase log view.
* Change: Presentation settings page is restored to WPEC Settings page when WooTheme is activated.
* Fix: Add to cart using Donation widget causes the page to reload and the item is added twice.
* Fix: Free-shipping discount causes tax to be calculated incorrectly.
* Fix: Paypal Buy Now button passes the wrong price to Paypal if product is on sale.
* Fix: Thumbnail sizes are not generated correctly.
* Fix: Broken output buffering rendering wpsc_add_advanced_options hook useless.
* Fix: Paypal Pro doesn't properly account for discount and coupon.
* Fix: IPN doesn't work on Paypal Standard.
* Fix: IPN doesn't work on Paypal Pro gateway.
* Fix: Paypal Express doesn't handle discounts.
* Fix: Paypal Express doesn't handle IPN.
* Fix: Paypal Express doesn't send purchase receipt after a payment is accepted on Paypal.
* Fix: Paypal Express doesn't include item description, quantity, tax etc. in email receipts.
* Fix: Invalid country code in Paypal Pro and Express, should be GB instead of UK
* Fix: Take Discount into account when DoExpressCheckout in Paypal Express gateway.
* Fix: Category checkout form sets don't work.
* Fix: Incorrect Product display mode selected when ['view_type'] is set and 'show_advanced_search' is disabled.
* Fix: PHP notice in wpsc-transaction_results_functions.php.
* Fix: attr('checked') == true always evaluates to false. Use is(':checked') instead.
* Fix: jQuery 1.6 select by attribute incompatibility.
* Fix: Price tag is added to RSS even when there is no price.
* Fix: Span tag is not closed in issue 598.
* Fix: Faulty php tag in template (issue 589).
* Fix: PHP Notices when checking out with shipping disabled.

= 3.8.4 =
* Add: User can duplicate a product in admin panel
* Add: WooThemes integration support
* Change: Total in Cart widget now excludes shipping and tax
* Fix: Invalid country code in paypal-standard.merchant.php
* Fix: Tax is not passed properly to Paypal Pro
* Fix: Currency code preference not correctly selected in Paypal gateways
* Fix: Paypal gateways doesn't check whether the currency being sent to Paypal is accepted or not, resulting in wrong currency
* Fix: Checkout form selecting the wrong field when a previous field with the same uniquename was deleted
* Fix: Various issues with Google Checkout
* Fix: State data outside of US is not passed to payment gateways
* Fix: State is not displaying correctly in the users purchase history
* Fix: Wrong generated product permalink when a product is assigned multiple cats, and a product category is being viewed
* Fix: Submitting a checkout form with mandatory billing state only refreshes the form although everything is filled out correctly
* Fix: Billing Country is trimmed, and Billing State is not properly decoded
* Fix: Billing and shipping state no longer stored correctly
* Fix: Checkout form validation skips mandatory custom checkout fields on default form set
* Fix: Paystation does not properly update purchase logs
* Fix: When there's no product, and Sort Product By is set to 'dragndrop', viewing the admin product list would produce a Division by zero warning
* Fix: Store sub-pages return 404 error
* Fix: Only Purchase History in Your Account show the login option
* Fix: Weight on Variations contain too many decimals
* Fix: Add to Cart in grid view bypasses Variations selection
* Fix: get_queried_object() requires WP 3.1
* Fix: Invalid version number in display-update.page.php
* Fix: Correct HTML, to stop Free Shipping Discount getting blanked
* Fix: Support taxonomy archives for product_tag taxonomy

= 3.8.3 =
* New: Individual item details are sent to Paypal Express Checkout
* Change: Automatically reload database update page when PHP maximum execution time is detected
* Change: Add progress bar and estimated time remaining for database update tasks
* Change: Themes can now use taxonomy-wpsc_product_category-{$term}.php and taxonomy-wpsc_product_category.php templates, which take precedence over page.php when viewing a product category
* Change: Paypal Express Checkout API is updated to ver 71.0
* Fix: Tax is calculated incorrectly when a coupon is used
* Fix: Update a large database of products and variations take ages
* Fix: Reloading database update page makes wpec scan the records from the beginning instead of continuing where it left off
* Fix: Reactivating the plugin causes Fatal Error (PHP Timeout) if there are a lot of attached images (not just post products, but all image attachments)
* Fix: Purchase logs' statuses are not properly updated when upgrading from 3.7.x
* Fix: Billing state is not sent to checkout
* Fix: Country name is truncated when sending to payment gateway
* Fix: Billing state code is not properly converted before sending to payment gateway
* Fix: Wrong USA country code is sent to Paypal Standard Payment
* Fix: Wrong sandbox gateway URL for Paypal Pro
* Fix: SSLVERIFY error when connecting to Paypal Pro Gateway
* Fix: Template hierarchy error with child themes
* Fix: Total amount is not visible when checking out with Paypal Express Checkout
* Fix: Transaction result page is inaccurate after checking out with Paypal Express Checkout
* Fix: Incompatibility with Thesis theme's loop when viewing product category, or paginated product listing

= 3.8.2 =
* Add: Currency display for Google RSS feed
* Add: Third-party plugins can now filter 'wpsc-tax_rate' to provide their own tax solution
* Change: Merchant subclasses now have access to $this->address_keys
* Change: Grid Settings are now always visible
* Change: Total Shipping is no longer included in notification email when shipping is disabled
* Change: Thumbnail size for single product view now defaults to Single Product Page thumbnail size option
* Change: wpsc_the_product_thumbnail() defaults to 'medium-single-product' size when in single product view
* Fix: Update notice being displayed when it has already been completed
* Fix: Broken image in latest products widget
* Fix: Custom checkout field not always saved
* Fix: Downloadable file list not updated after existing files are selected
* Fix: Already attached downloadable files are duplicated each time you select an existing downloadable file
* Fix: Inconsistent behavior when adding a new field to a checkout form set
* Fix: Custom product slug not editable
* Fix: Incompatibility issues with shipping helper and modules
* Fix: Product meta are not included in Google product feed
* Fix: Incorrect variation "from" price
* Fix: Shortcode not working in single product description
* Fix: Item cost not correctly calculated in paypal-standard-merchant
* Fix: Invalid SSL URL for some images
* Fix: Select from wrong table in WPSC_Merchant::get_authcode()
* Fix: Wrong use of get_query_var() in wpsc_category_id()
* Fix: Table `wordpress.wp_wpsc_product_list` doesn't exist
* Fix: ?items_per_page=all is ignored
* Fix: Duplicate transaction result emails
* Fix: Wrong filter in wpsc_item_add_preview_file()
* Fix: Wrong display type when using advanced search view mode and viewing a category
* Fix: Category list is displayed in tag archive
* Fix: wpsc_display_products_page() outputs "Fail" when the product shortcode is used 10 times (no kidding)
* Fix: Single product view's thumbnail size is incorrect
* Fix: Wrong featured thumbnail is displayed in Single Product View when there are multiple attached product images
* Fix: Incorrect condition statements in WPSC_Coupons::compare_logic()
* Fix: Can't add new field to checkout form set in IE
* Fix: Missing trash icon when adding custom options to dropdowns in checkout form
* Fix: Custom select, checkbox and radio fields are displayed as textbox on [userlog] page
* Fix: Custom checkboxes, radios and select fields are not properly populated in Checkout form
* Fix: Attachment metadata are not properly generated when converting product thumbnails from 3.7.x to 3.8

= 3.8.1 =
* Fix: Special price mix-up when ugprade to 3.8
* Fix: Missing database update notice
* Fix: Breadcrumb markup and style fixes
* Fix: Deprecate WPSC_Query()
* Fix: Deprecate wpsc_total_product_count()
* Fix: Deprecate wpsc_print_product_list()
* Change: Warning message for PHP 4 users. GoldCart requires PHP 5 or above.
* Change: Don't display categories when there's a search

= 3.8 =
* Utilize custom post types for products
* Utilize custom taxonomy for categories and variations
* Database optimization
* Redesigned taxes and shipping systems
* New user interface
* Integrates with WordPress Media Manager
* Better template integration for designers
* Optimized for ticketing (Tikipress)


== Frequently Asked Questions ==

= How do I customize WP e-Commerce =

First of all you should check out the Presentation settings which are in the Settings->Store page.

Advanced users can edit the CSS (and do just about anything). Not so advanced users can hire WP consultants developers and designers from [http://getshopped.org/resources/wp-consultants/](http://getshopped.org/resources/wp-consultants/ "http://getshopped.org/resources/wp-consultants/").

== Screenshots ==

1. Products list in WordPress backend
2. Edit Product screen
3. Single product page
4. Checkout page

== Upgrade Notice ==

= 3.8.1 =
This version addresses several urgent issues when upgrading from 3.7.x to 3.8.
