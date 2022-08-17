<?php

/*
*   This Shortcode is searching products from specfic categories->subcategories->sub subcategories
*   This is keyword typing based search
*   This code can be used in general wordpress search
*/

    class Search_By_Product_Category_Class{
        
        function __construct()
        {
            add_action( "wp_ajax_do_search_by_product_cat", array($this, 'do_search_by_product_cat'), 10 );
            add_action( "wp_ajax_nopriv_do_search_by_product_cat", array($this, 'do_search_by_product_cat'), 10 );
        }
        
        function do_search_by_product_cat()
        {
            $searchK = str_replace(' ', '', $_POST['searched_keywords']);
            $searchC = (int)$_POST['searched_category'];
            
            if( !empty($searchK) )
            {
                $default_cat[] = $searchC;
                $searched_keywords = $searchK;
                
                $product_query_args = array(
                    'post_type' => 'product',
                    'post_status' => 'publish',
                    'posts_per_page' => 12,
                    's' => $searched_keywords,
                    'tax_query' => array(
                        array(
                            'taxonomy' => 'product_cat',
                            'field'    => 'term_id',
                            'terms'    => $default_cat,
                            'operator' => 'IN',
                        )
                    )
                );
                
                $woo_query = new WP_Query($product_query_args);
                
                if( $woo_query->have_posts() )
                {
                    $counter = 0;
                    
                    while( $woo_query->have_posts() )
                    {
                        $woo_query->the_post();
                     
                        $product_price = wc_get_product( get_the_ID() );
                        
                        $ajax_data[$counter]['title'] = get_the_title();
                        $ajax_data[$counter]['price'] =  $product_price->get_price();
                        $ajax_data[$counter]['thumbnail'] =  wp_get_attachment_url( $product_price->get_image_id() );
                        $ajax_data[$counter]['cart'] = get_the_ID();
                        $ajax_data[$counter]['link'] = get_the_permalink();
                        
                        $counter++;
                    }
                    
                    $ajax['status'] = true;
                    $ajax['data'] = $ajax_data;
                    print(json_encode($ajax));
                    exit();
                }
                else
                {
                    $ajax['status'] = false;
                    $ajax['message'] = 'No Record Found!';
                    print(json_encode($ajax));
                    exit();
                }
            }
            else
            {
                $ajax['status'] = false;
                $ajax['message'] = 'No Record Found!';
                print(json_encode($ajax));
                exit();
            }
        }
        
    }
    new Search_By_Product_Category_Class();
    
    // [search_by_product_category product_cat=""]
    function Ajax_Search_By_Product_Category($atts)
    {
        $atts = shortcode_atts( array(
            'post_type' => 'product',
            'product_cat' => '',
            ),
            $atts
        );
        
        if( !empty( $atts['product_cat'] ) )
        {
            $catProduct = (int)$atts['product_cat'];
        }
        else
        {
            $catProduct = 15;
        }
    
        $output = '<div class="custom-search-box-wrap">';
        $output .= '<div class="woodmart-vc-ajax-search woodmart-ajax-search color-dark custom-search-box">';
        $output .= '<div class="woodmart-search-form">';
        $output .= '<form role="search" method="post" class="searchform woodmart-ajax-search custom-search-form" id="customAjaxSearch">';
        $output .= '<input type="text" class="s" placeholder="Search for products" value="" name="search_keywords" autocomplete="off"><input type="hidden" name="tax_word" value="'.$catProduct.'">';
        $output .= '<button type="button" class="searchsubmit">Search</button>';
        $output .= '</form></div></div>';
        $output .= '<div id="searchedResult" class="searched-result x-hide"></div></div>';
        
        return $output;
    }
    add_shortcode( 'search_by_product_category', 'Ajax_Search_By_Product_Category' );

?>