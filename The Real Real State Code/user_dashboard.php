<?php 

// It Will Work Into WordPress While Loop
function get_post_data_into_json()
{
    if( has_post_thumbnail() ):
        $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(),'large', true);
        $data['single_img'] = $thumbnail[0];
    else:
        $data['single_img'] = '';
    endif;
    
    if( get_field('listing_gallery') ):
        $listing_gallery = get_field('listing_gallery');
        $counter = 0;
        foreach( $listing_gallery as $listing_gallery_id ):
            $data['gallery'][$counter] = array('sg_id' => $listing_gallery_id['id'], 'sg_url' => $listing_gallery_id['url']);
            $counter++;
        endforeach;
    else:
        $data['gallery'] = array();
    endif;
    
    $data['id']             = get_the_ID();
    $data['title']          = get_the_title();
    $data['description']    = strip_tags(get_the_content());
    $data['price']          = (get_field('price')) ? get_field('price') : '';
    $data['address']        = (get_field('address')) ? get_field('address') : '';
    $data['citystate']      = (get_field('citystate')) ? get_field('citystate') : '';
    $data['zipcode']        = (get_field('zipcode')) ? get_field('zipcode') : '';
    $data['area_aqft']      = (get_field('area_aqft')) ? get_field('area_aqft') : '';
    $data['bedrooms']       = (get_field('bedrooms')) ? get_field('bedrooms') : '';
    $data['bathrooms']      = (get_field('bathrooms')) ? get_field('bathrooms') : '';
    $data['style_of_house'] = (get_field('style_of_house')) ? get_field('style_of_house') : '';
    $data['amenities']      = (get_field('amenities')) ? get_field('amenities') : '';
    $data['phone_number']   = (get_field('phone_number')) ? get_field('phone_number') : '';
    $data['youtube_video']  = (get_field('youtube_video')) ? get_field('youtube_video') : '';
    
    return json_encode($data);
}

class User_Dashboard_Class{
    
    function __construct()
    {
        add_action( "wp_ajax_user_can_delete_post", array($this, 'user_can_delete_post'), 10 );
        add_action( "wp_ajax_nopriv_user_can_delete_post", array($this, 'user_can_delete_post'), 10 );
        
        add_action( "wp_ajax_delete_one_image_from_gallery", array($this, 'delete_one_image_from_gallery'), 10 );
        add_action( "wp_ajax_nopriv_delete_one_image_from_gallery", array($this, 'delete_one_image_from_gallery'), 10 );
        
        add_action( "wp_ajax_updating_listing_info", array($this, 'updating_listing_info'), 10 );
        add_action( "wp_ajax_nopriv_updating_listing_info", array($this, 'updating_listing_info'), 10 );
        
        add_action( "wp_ajax_get_all_published_listing_by_user", array($this, 'get_all_published_listing_by_user'), 10 );
        add_action( "wp_ajax_nopriv_get_all_published_listing_by_user", array($this, 'get_all_published_listing_by_user'), 10 );
    
        add_action( "wp_ajax_get_all_draft_listing_by_user", array($this, 'get_all_draft_listing_by_user'), 10 );
        add_action( "wp_ajax_nopriv_get_all_draft_listing_by_user", array($this, 'get_all_draft_listing_by_user'), 10 );
    }
    
    function user_can_delete_post()
    {
        $post_ID = (int)$_POST['post_id'];
        
        if( get_post_field( 'post_author', $post_ID ) == get_current_user_id() )
        {
            if(wp_delete_post($post_ID, true))
            {
                $ajax['status'] = true;
                print(json_encode($ajax));
                exit();
            }
            else
            {
                $ajax['status'] = false;
                $ajax['message'] = 'Unexpected Error! Please Refresh Try Again!';
                print(json_encode($ajax));
                exit();
            }
        }
        else
        {
            $ajax['status'] = false;
            $ajax['message'] = 'permission denied!';
            print(json_encode($ajax));
            exit();
        }
    }
    
    function delete_one_image_from_gallery()
    {
        $img_ID = (int)$_POST['img_id'];
        
        if( $img_ID )
        {
            if(wp_delete_attachment($img_ID, true))
            {
                $ajax['status'] = true;
                print(json_encode($ajax));
                exit();
            }
            else
            {
                $ajax['status'] = false;
                $ajax['message'] = 'Unexpected Error! Please Refresh Try Again!';
                print(json_encode($ajax));
                exit();
            }
        }
        else
        {
            $ajax['status'] = false;
            $ajax['message'] = 'permission denied!';
            print(json_encode($ajax));
            exit();
        }
    }
    
    function updating_listing_info()
    {
        if( !empty($_POST['listing_title']) && is_user_logged_in() )
        {
            if( !empty($_FILES['featured_images']['name']) )
            {
                $allow_file_type = array('png', 'jpg', 'jpeg', 'webp');
                $filename = $_FILES['featured_images']['name'];
                $ext = pathinfo($filename, PATHINFO_EXTENSION);
                if (!in_array($ext, $allow_file_type))
                {
                    $ajax['status'] = false;
                    $ajax['message'] = 'Invalid File Type!';
                    print(json_encode($ajax));
                    exit();
                }
            }
            
            $user_ID = get_current_user_id();
            $post_array = array(
                'ID' => (int)$_POST['list_id'],
                'post_type'         => 'home_listing',
                'post_author'       => $user_ID,
                'post_content'      => sanitize_textarea_field( $_POST['description'] ),
                'post_title'        => sanitize_text_field( $_POST['listing_title'] ),
            );
            
            $postID = wp_update_post( $post_array );
            update_post_meta( $postID, 'price', sanitize_text_field( $_POST['expected_price'] ));
            update_post_meta( $postID, 'address', sanitize_text_field( $_POST['listing_address_physical'] ));
            update_post_meta( $postID, 'citystate', sanitize_text_field( $_POST['city_state'] ));
            update_post_meta( $postID, 'zipcode', sanitize_text_field( $_POST['zip_code'] ));
            update_post_meta( $postID, 'area_aqft', sanitize_text_field( $_POST['area_aqft'] ));
            update_post_meta( $postID, 'bedrooms', sanitize_text_field( $_POST['listing_bedrooms'] ));
            update_post_meta( $postID, 'bathrooms', sanitize_text_field( $_POST['listing_bathrooms'] ));
            update_post_meta( $postID, 'style_of_house', sanitize_text_field( $_POST['style_of_house'] ));
            update_post_meta( $postID, 'amenities', sanitize_text_field( $_POST['listing_amenities'] ));
            update_post_meta( $postID, 'phone_number', sanitize_text_field( $_POST['listing_phone'] ));
            update_post_meta( $postID, 'youtube_video', sanitize_text_field( $_POST['youTube_video_link'] ));
            
            $single_image = false;
            $multiple_image = false;
            $ajax['media_error'] = false;
            
            // Single Image
            if( !empty($_FILES['featured_images']['name']) )
            {
                $file_attach_id = insert_attachment( 'featured_images', $postID);
                if( empty($file_attach_id) )
                {
                    $single_image = true;
                }
                else
                {
                    set_post_thumbnail( $postID, $file_attach_id );
                }
            }
            
            // Multiple Image
            if( !empty($_FILES['gallery_images']['name'][0]) )
            {
                $gallery_images = $_FILES['gallery_images'];
                foreach( $gallery_images['name'] as $keyImage => $valueImage )
                {
                    if( $gallery_images['name'][$keyImage] )
                    {
                        $gallery_image_file = array(
                            'name'      => $gallery_images['name'][$keyImage],
                            'type'      => $gallery_images['type'][$keyImage],
                            'tmp_name'  => $gallery_images['tmp_name'][$keyImage],
                            'error'     => $gallery_images['error'][$keyImage],
                            'size'      => $gallery_images['size'][$keyImage]
                        );
                
                        $_FILES = array ('gallery_images' => $gallery_image_file);
                        foreach( $_FILES as $keyFile => $valueFile )
                        {
                            $file_attach_ids[] = insert_attachment( $keyFile, $postID);
                        }
                    }
                }
                
                if( empty($file_attach_ids) )
                {
                    $multiple_image = true;
                }
                else
                {
                    update_field( 'listing_gallery', $file_attach_ids , $postID );
                }
            }
            
            $ajax['status'] = true;
            if( $single_image == TRUE && $multiple_image == TRUE)
            {
                $ajax['media_error'] = true;
                $ajax['file_upload_error_0'] = 'Media Is Failed To Upload - Try To Upload Again!';
            }
            else
            {
                if( $single_image == TRUE )
                {
                    $ajax['media_error'] = true;
                    $ajax['file_upload_error_0'] = 'Featured Image Is Failed To Upload - Try To Upload Again';
                }
                if( $multiple_image == TRUE )
                {
                    $ajax['media_error'] = true;
                    $ajax['file_upload_error_0'] = 'Gallery Is Failed To Upload - Try To Upload Again';
                }
            }
            
            $ajax['updated_json_meta'] = get_post_data_into_json();
            $ajax['message'] = 'Your Post Has Been Updated!';
            print(json_encode($ajax));
            exit();
        }
        else
        {
            $ajax['status'] = false;
            $ajax['message'] = 'Some fields are required!';
            print(json_encode($ajax));
            exit();
        }
    }
    
    function get_all_published_listing_by_user()
    {
        $mainarray = array(
            'post_type' => array('home_listing'),
            'post_status' => array('publish'),
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => -1,
            'author' => get_current_user_id()
        );
        $q = new WP_Query($mainarray);
        
        if( $q->have_posts() )
        {
            $counter = 0;
            while ( $q->have_posts() )
            {
                $q->the_post();
                
                $listing[$counter]['ID'] = get_the_ID();
                $listing[$counter]['title'] = get_the_title();
                $listing[$counter]['raw_json'] = get_post_data_into_json();
                
                $counter++;
            }
            $ajax['status'] = true;
            $ajax['data'] = $listing;
        }
        else
        {
            $ajax['status'] = false;
            $ajax['no_record'] = get_permalink(182);
        }
        
        print(json_encode($ajax));
        exit();
    }
    
    function get_all_draft_listing_by_user()
    {
        $mainarray = array(
            'post_type' => array('home_listing'),
            'post_status' => array('draft'),
            'orderby' => 'date',
            'order' => 'DESC',
            'posts_per_page' => -1,
            'author' => get_current_user_id()
        );
        $q = new WP_Query($mainarray);
        
        if( $q->have_posts() )
        {
            $counter = 0;
            while ( $q->have_posts() )
            {
                $q->the_post();
                
                $listing[$counter]['ID'] = get_the_ID();
                $listing[$counter]['title'] = get_the_title();
                $listing[$counter]['raw_json'] = get_post_data_into_json();
                
                $counter++;
            }
            $ajax['status'] = true;
            $ajax['data2'] = $listing;
        }
        else
        {
            $ajax['status'] = false;
            $ajax['no_record'] = get_permalink(182);
        }
        
        print(json_encode($ajax));
        exit();
    }
    
    
}
new User_Dashboard_Class();