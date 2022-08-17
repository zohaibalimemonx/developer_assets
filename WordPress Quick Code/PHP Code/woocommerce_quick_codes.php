<?php

/* * * * * 
    GET PRODUCT SUMMARY i.e. TITLE, ADD-TO-CART, VARIATIONS ETC. 
    REF: https://github.com/woocommerce/woocommerce/wiki/wc_get_products-and-WC_Product_Query
* * * * */

// Used In While Loop For Each Product

/**
 * woocommerce_single_product_summary hook
 *
 * @hooked woocommerce_template_single_title - 5
 * @hooked woocommerce_template_single_rating - 10
 * @hooked woocommerce_template_single_price - 10
 * @hooked woocommerce_template_single_excerpt - 20
 * @hooked woocommerce_template_single_add_to_cart - 30
 * @hooked woocommerce_template_single_meta - 40
 * @hooked woocommerce_template_single_sharing - 50
 */
do_action( 'woocommerce_single_product_summary' );

// FOR Any Unwanted Detail Just Remove That Action As Should Be Placed Before do_action('woocommerce_single_product_summary);

remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_title', 5);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_rating', 10);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_price', 10);
// In Woodmart The Priority Of woocommerce_template_single_excerpt is 30
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_excerpt', 20);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40);
remove_action('woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50);

?>

<?php

/* * * * * GET PRODUCT PRICE BY ID * * * * */

// IDs
$id_one = 242;
$id_two = 243;

// Load Full Product Object By ID
$product_one = wc_get_product( $id_one );
$product_two = wc_get_product( $id_two );

// Calling Price Function
echo $product_one->get_price();
echo $product_two->get_price();

/**
 *
 *  General Product Data
 *
 */
$product->get_id(); // Returns the unique ID for this object.
$product->get_description(); // Get product description.
$product->get_formatted_name(); // Get product name with SKU or ID. Used within admin.
$product->get_featured(); // If the product is featured.
$product->get_name(); // Get product name.
$product->get_title(); // Get the product's title. For products this is the product name.
$product->get_type(); // Get internal type. Should return string and *should be overridden* by child classes.
$product->get_virtual(); // Get virtual.
$product->get_total_sales(); // Get number total of sales.
$product->get_short_description(); // Get product short description.
$product->get_sku(); // Get SKU (Stock-keeping unit) - product unique ID.
$product->get_slug(); // Get product slug.
$product->get_status(); // Get product status.
$product->get_permalink(); // Product permalink.
$product->get_catalog_visibility(); // Get catalog visibility.

/**
 *
 *  Pricing Data
 *
 */
$product->get_price(); // Returns the product's active price.
$product->get_date_on_sale_from(); // Get date on sale from.
$product->get_date_on_sale_to(); // Get date on sale to.
$product->get_display_price(); // Returns the price including or excluding tax, based on the 'woocommerce_tax_display_shop' setting.
$product->get_price_excluding_tax(); // Returns the price (excluding tax) - ignores tax_class filters since the price may *include* tax and thus needs subtracting.
$product->get_price_html(); // Returns the price in html format.
$product->get_price_html_from_text(); // Functions for getting parts of a price, in html, used by $product->get_price_html.
$product->get_price_html_from_to(); // Functions for getting parts of a price, in html, used by $product->get_price_html.
$product->get_price_including_tax(); // Returns the price (including tax). Uses customer tax rates. Can work for a specific $qty for more accurate taxes.
$product->get_price_suffix(); // Get the suffix to display after prices > 0.
$product->get_sale_price(); // Returns the product's sale price.
$product->get_regular_price(); // Returns the product's regular price.
$product->get_tax_class(); // Returns the tax class.
$product->get_tax_status(); // Returns the tax status.

/**
 *
 *  Image Related Data
 *
 */
$product->get_image(); // Returns the main product image.
$product->get_image_id(); // Get main image ID.
$product->get_gallery_attachment_ids(); // Returns the gallery attachment ids.
$product->get_gallery_image_ids(); // Returns the gallery attachment ids.

/**
 *
 *  Stock or Inventory Data
 *
 */
$product->get_backorders(); // Get backorders.
$product->get_availability(); // Returns the availability of the product.
$product->get_max_purchase_quantity(); // Get max quantity which can be purchased at once.
$product->get_min_purchase_quantity(); // Get min quantity which can be purchased at once.
$product->get_stock_managed_by_id(); // If the stock level comes from another product ID, this should be modified.
$product->get_stock_quantity(); // Returns number of items available for sale.
$product->get_stock_status(); // Return the stock status.
$product->get_total_stock(); // Get total stock - This is the stock of parent and children combined.
$product->get_sold_individually(); // Return if should be sold individually.
$product->get_low_stock_amount(); // Get low stock amount.

/**
 *
 *  Shipping Data
 *
 */
$product->get_height(); // Returns the product height.
$product->get_length(); // Returns the product length.
$product->get_weight(); // Returns the product's weight.
$product->get_width(); // Returns the product width.
$product->get_dimensions(); // Returns formatted dimensions.
$product->get_manage_stock(); // Return if product manage stock.
$product->get_shipping_class(); // Returns the product shipping class SLUG.
$product->get_shipping_class_id(); // Get shipping class ID.

/**
 *
 *  Product Variations / Parent Data
 *
 */
$product->get_child(); // Returns the child product.
$product->get_children(); // Returns the children IDs if applicable. Overridden by child classes.
$product->get_formatted_variation_attributes(); // Get formatted variation data with WC < 2.4 back compat and proper formatting of text-based attribute names.
$product->get_matching_variation(); // Match a variation to a given set of attributes using a WP_Query.
$product->get_parent(); // Get the parent of the post.
$product->get_parent_id(); // Get parent ID.
$product->get_variation_default_attributes(); // If set, get the default attributes for a variable product.
$product->get_variation_description(); // Get product variation description.
$product->get_variation_id(); // Get variation ID.

/**
 *
 *  Product Downloads
 *
 */
$product->get_download_expiry(); // Get download expiry.
$product->get_download_limit(); // Get download limit.
$product->get_downloadable(); // Get downloadable.
$product->get_downloads(); // Get downloads.
$product->get_file(); // Get a file by $download_id.
$product->get_file_download_path(); // Get file download path identified by $download_id.
$product->get_files(); // Same as $product->get_downloads in CRUD.

/**
 *
 *  Attributes, Tags, Categories & Associated Data Objects
 *
 */
$product->get_attribute(); // Returns a single product attribute as a string.
$product->get_attributes(); // Returns product attributes.
$product->get_categories(); // Returns the product categories.
$product->get_category_ids(); // Get category ids.
$product->get_default_attributes(); // Get default attributes.
$product->get_cross_sell_ids(); // Get cross sell IDs.
$product->get_cross_sells(); // Returns the cross sell product ids.
$product->get_related(); // Get and return related products.
$product->get_tag_ids(); // Get tag ids.
$product->get_tags(); // Returns the product tags.
$product->get_upsell_ids(); // Get upsell IDs.
$product->get_upsells(); // Returns the upsell product ids.
$product->get_meta(); // Get Meta Data by Key.
$product->get_meta_data(); // Get All Meta Data.

/**
 *
 *  Ratings and Reviews
 *
 */
$product->get_rating_count(); // Get the total amount (COUNT) of ratings, or just the count for one rating e.g. number of 5 star ratings.
$product->get_rating_counts(); // Get rating count.
$product->get_rating_html(); // Returns the product rating in html format.
$product->get_review_count(); // Get review count.
$product->get_reviews_allowed(); // Return if reviews is allowed.
$product->get_average_rating(); // Get average rating.

/**
 *
 *  Other Product Data
 *
 */
$product->get_changes(); // Return data changes only.
$product->get_data(); // Returns all data for this object.
$product->get_data_keys(); // Returns array of expected data keys for this object.
$product->get_data_store(); // Get the data store.
$product->get_date_created(); // Get product created date.
$product->get_date_modified(); // Get product modified date.
$product->get_extra_data_keys(); // Returns all "extra" data keys for an object (for sub objects like product types).
$product->get_menu_order(); // Get menu order.
$product->get_meta_cache_key(); // Helper method to compute meta cache key. Different from WP Meta cache key in that meta data cached using this key also contains meta_id column.
$product->get_object_read(); // Get object read property.
$product->get_post_data(); // Get the product's post data.
$product->get_post_password(); // Get post password.
$product->get_purchase_note(); // Get purchase note.

?>

<?php

/* * * * * GET EXTERNAL PRODUCT's EXTERNAL URL BY ID * * * * */

    // Load Full Product Object By ID
    $aff_product_meta = wc_get_product(get_the_ID());

    if( $aff_product_meta->is_type( 'external' ) ):
        echo $aff_product_meta->get_product_url();
    endif;

    // BUTTON TEXT
    $aff_product_meta->button_text;
?>


<?php 
/**
 * Auto Complete all WooCommerce orders.
 */
add_action( 'woocommerce_thankyou', 'custom_behavioralfitnesstoday_auto_complete_order' );
function custom_behavioralfitnesstoday_auto_complete_order( $order_id ) { 
    if ( ! $order_id ) {
        return;
    }

    $order = wc_get_order( $order_id );
    $order->update_status( 'completed' );
}
?>