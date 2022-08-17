<?php 
// PRODUCT CUSTOM FILTER
class WC_Product_Filter{
    
    function __construct()
    {
        add_action( "wp_ajax_get_tax_children", array($this, 'get_tax_children'), 10 );
        add_action( "wp_ajax_nopriv_get_tax_children", array($this, 'get_tax_children'), 10 );
        
        add_action( "wp_ajax_get_tax_grandchildren", array($this, 'get_tax_grandchildren'), 10 );
        add_action( "wp_ajax_nopriv_get_tax_grandchildren", array($this, 'get_tax_grandchildren'), 10 );
        
        add_action( "wp_ajax_get_filtered_result", array($this, 'get_filtered_result'), 10 );
        add_action( "wp_ajax_nopriv_get_filtered_result", array($this, 'get_filtered_result'), 10 );
    }
    
    function get_tax_children()
    {
        $parent_tax_ID = (int)$_POST['cat_ID'];
        
        $child_arg = array( 'hide_empty' => false, 'parent' => $parent_tax_ID );
        $child_cat = get_terms( 'product_cat', $child_arg );
        
        if ( ! empty( $child_cat ) && is_array( $child_cat ) )
        {
            $counter = 0;
            $ajax['status'] = true;
            foreach ( $child_cat as $term )
            {
                $child[$counter]['child_id'] = $term->term_id;
                $child[$counter]['child_name'] = $term->name;
                $counter++;
            }
        }
        else
        {
            $ajax['status'] = false;
            $ajax['message'] = 'No Child Categroy';
        }
        
        $ajax['childen'] = $child;
        print(json_encode($ajax));
        exit();
    }
    
    function get_tax_grandchildren()
    {
        $child_tax_ID = (int)$_POST['cat_child_ID'];
        
        $child_arg = array( 'hide_empty' => false, 'parent' => $child_tax_ID );
        $child_cat = get_terms( 'product_cat', $child_arg );
        
        if ( ! empty( $child_cat ) && is_array( $child_cat ) )
        {
            $counter = 0;
            $ajax['status'] = true;
            foreach ( $child_cat as $term )
            {
                $child[$counter]['child_id'] = $term->term_id;
                $child[$counter]['child_name'] = $term->name;
                $counter++;
            }
        }
        else
        {
            $ajax['status'] = false;
            $ajax['message'] = 'No Child Categroy';
        }
        
        $ajax['childen'] = $child;
        print(json_encode($ajax));
        exit();
    }
    
    function get_filtered_result()
    {
        $parent_category_id = $_POST['printer_brand'];
        $child_category_id = $_POST['printer_family'];
        $grandchild_category_id = $_POST['printer_model'];
        
        $grandchild_term = get_term( $grandchild_category_id );
        $grandchild_term_id = $grandchild_term->term_id;
        
        $child_term = get_term( $child_category_id );
        $child_term_id = $child_term->term_id;
        
        $parent_term = get_term( $parent_category_id );
        $parent_term_id = $parent_term->term_id;
        
        if( !empty( $parent_category_id ) && !empty( $child_category_id ) && !empty( $grandchild_category_id ) )
        {
            wp_safe_redirect( esc_url( get_term_link( $grandchild_term_id ) ) );
            exit();
        }
        else if( !empty( $parent_category_id ) && !empty( $child_category_id ) )
        {
            wp_safe_redirect( esc_url( get_term_link( $child_term_id ) ) );
            exit();
        }
        else if( !empty( $parent_category_id ) )
        {
            wp_safe_redirect( esc_url( get_term_link( $parent_term_id ) ) );
            exit();
        }
        else
        {
            wp_safe_redirect( site_url() );
            exit();
        }
    }
}
new WC_Product_Filter();

?>