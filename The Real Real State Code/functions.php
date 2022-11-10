<?php
add_action('init', function (){ session_start(); });

if( !function_exists( 'wordpress_enqueue_additional_scripts' ) )
{
    add_action( 'wp_enqueue_scripts', 'wordpress_enqueue_additional_scripts' );
    function wordpress_enqueue_additional_scripts()
    {
        wp_enqueue_style( 'image-uploader-min-css', get_stylesheet_directory_uri() . '/backend-system/library/image-uploader.min.css', array(), '1.2.3', 'all' );
        wp_enqueue_style( 'fancybox-css', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.26/dist/fancybox.css', array(), '4.0.26', 'all' );
        wp_enqueue_script( 'jquery-validate-min-js', get_stylesheet_directory_uri() . '/backend-system/library/jquery.validate.min.js', array('jquery'), '1.17.0', true );
        wp_enqueue_script( 'loadingoverlay-min-js', get_stylesheet_directory_uri() . '/backend-system/library/loadingoverlay.min.js', array('jquery'), '2.1.6', true );
        wp_enqueue_script( 'sweetalert-min-js', get_stylesheet_directory_uri() . '/backend-system/library/sweetalert.min.js', array('jquery'), '1.0.0', true );
        wp_enqueue_script( 'image-uploader-min-js', get_stylesheet_directory_uri() . '/backend-system/library/image-uploader.min.js', array('jquery'), '1.2.3', true );
        wp_enqueue_script( 'fancybox-umd-min-js', 'https://cdn.jsdelivr.net/npm/@fancyapps/ui@4.0.26/dist/fancybox.umd.min.js', array('jquery'), '4.0.26', true );
        wp_enqueue_script( 'scripts-handler-js', get_stylesheet_directory_uri() . '/backend-system/scripts-handler.js', array('jquery-validate-min-js', 'loadingoverlay-min-js', 'sweetalert-min-js', 'jquery'), rand(100,1000), true );
        wp_localize_script('scripts-handler-js', 'handler_object',
    		array(
    			'ajax_url' => admin_url( 'admin-ajax.php' ),
    		)
    	);
    }
}

add_action('after_setup_theme', 'remove_admin_bar');
function remove_admin_bar() 
{
    if ( !current_user_can('manage_options') && !is_admin() ) {
      show_admin_bar(false);
    }
}

add_filter('login_redirect', 'admin_default_page');
function admin_default_page()
{
    if( !current_user_can('manage_options') && !is_admin() )
    {
        return get_permalink(952);
    }
}



function zx_get_user_priv_status($atts)
{
    $atts = shortcode_atts( array(
        'login_page_id' => '',
        'login_page_url' => '',
        'logout_page_url' => ''
        ), 
        $atts
    );

    if( is_user_logged_in() )
    {
        $current_user = wp_get_current_user();
        $output = '<span class="zx-priv-status"><span><a href="'.get_permalink(952).'" title="Go To Dashboard">'.$current_user->user_login.'</a></span><a href="'.wp_logout_url( get_permalink($atts['logout_page_url']) ).'" title="Logout"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M96 480h64C177.7 480 192 465.7 192 448S177.7 416 160 416H96c-17.67 0-32-14.33-32-32V128c0-17.67 14.33-32 32-32h64C177.7 96 192 81.67 192 64S177.7 32 160 32H96C42.98 32 0 74.98 0 128v256C0 437 42.98 480 96 480zM504.8 238.5l-144.1-136c-6.975-6.578-17.2-8.375-26-4.594c-8.803 3.797-14.51 12.47-14.51 22.05l-.0918 72l-128-.001c-17.69 0-32.02 14.33-32.02 32v64c0 17.67 14.34 32 32.02 32l128 .001l.0918 71.1c0 9.578 5.707 18.25 14.51 22.05c8.803 3.781 19.03 1.984 26-4.594l144.1-136C514.4 264.4 514.4 247.6 504.8 238.5z"/></svg></a></span>';
    }
    else
    {
        if( !empty( $atts['login_page_id'] ) )
        {
            $output = '<a href="'. get_permalink( $atts['login_page_id'] ) .'" class="zx-priv-link"><svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18.9135 13.1958C18.2507 12.6133 17.4469 12.1101 16.5242 11.7001C16.1297 11.5249 15.6682 11.7025 15.493 12.0968C15.3178 12.4911 15.4954 12.9527 15.8897 13.128C16.6678 13.4738 17.3382 13.8914 17.8822 14.3695C18.5528 14.9588 18.9375 15.812 18.9375 16.7109V18.1562C18.9375 18.587 18.587 18.9375 18.1562 18.9375H2.84375C2.41299 18.9375 2.0625 18.587 2.0625 18.1562V16.7109C2.0625 15.812 2.44717 14.9588 3.1178 14.3695C3.90714 13.6758 6.20694 12.0625 10.5 12.0625C13.6877 12.0625 16.2812 9.46896 16.2812 6.28125C16.2812 3.09354 13.6877 0.5 10.5 0.5C7.31229 0.5 4.71875 3.09354 4.71875 6.28125C4.71875 8.14481 5.60529 9.80496 6.97858 10.8629C4.46576 11.4152 2.90265 12.4785 2.08646 13.1958C1.07831 14.0815 0.5 15.3627 0.5 16.7109V18.1562C0.5 19.4487 1.55133 20.5 2.84375 20.5H18.1562C19.4487 20.5 20.5 19.4487 20.5 18.1562V16.7109C20.5 15.3627 19.9217 14.0815 18.9135 13.1958ZM6.28125 6.28125C6.28125 3.95505 8.1738 2.0625 10.5 2.0625C12.8262 2.0625 14.7188 3.95505 14.7188 6.28125C14.7188 8.60745 12.8262 10.5 10.5 10.5C8.1738 10.5 6.28125 8.60745 6.28125 6.28125Z" fill="#A1CF55"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.21875 6.28125C4.21875 2.81739 7.03614 0 10.5 0C13.9639 0 16.7812 2.81739 16.7812 6.28125C16.7812 9.74511 13.9639 12.5625 10.5 12.5625C6.34513 12.5625 4.15933 14.1198 3.44786 14.7451C2.88607 15.2387 2.5625 15.9548 2.5625 16.7109V18.1562C2.5625 18.3109 2.68914 18.4375 2.84375 18.4375H18.1562C18.3109 18.4375 18.4375 18.3109 18.4375 18.1562V16.7109C18.4375 15.9548 18.1139 15.2387 17.5522 14.7451C17.0522 14.3057 16.4265 13.9137 15.6867 13.5849C15.0402 13.2975 14.7487 12.5405 15.036 11.8938C15.3234 11.2471 16.0804 10.9559 16.7271 11.2431C17.6895 11.6708 18.5377 12.2 19.2436 12.8202C20.3603 13.8013 21 15.2196 21 16.7109V18.1562C21 19.7248 19.7248 21 18.1562 21H2.84375C1.27519 21 0 19.7248 0 18.1562V16.7109C0 15.2196 0.639697 13.8013 1.75644 12.8202C2.52046 12.1487 3.8737 11.2149 5.95179 10.6089C4.87922 9.48232 4.21875 7.95782 4.21875 6.28125ZM18.9135 13.1958L18.5835 13.5714C17.9637 13.0267 17.2042 12.5494 16.3212 12.1571M18.9135 13.1958L18.5835 13.5714C19.4831 14.3617 20 15.5058 20 16.7109V18.1562C20 19.1725 19.1725 20 18.1562 20H2.84375C1.82747 20 1 19.1725 1 18.1562V16.7109C1 15.5058 1.51692 14.3617 2.41648 13.5714C3.17748 12.9026 4.66587 11.8832 7.08592 11.3512L8.13303 11.121L7.28371 10.4668C6.02753 9.49908 5.21875 7.98255 5.21875 6.28125C5.21875 3.36968 7.58843 1 10.5 1C13.4116 1 15.7812 3.36968 15.7812 6.28125C15.7812 9.19282 13.4116 11.5625 10.5 11.5625C6.06875 11.5625 3.65494 13.2318 2.78774 13.9939C2.00829 14.6788 1.5625 15.6693 1.5625 16.7109V18.1562C1.5625 18.8631 2.13685 19.4375 2.84375 19.4375H18.1562C18.8631 19.4375 19.4375 18.8631 19.4375 18.1562V16.7109C19.4375 15.6693 18.9917 14.6788 18.2123 13.9939C17.6243 13.4772 16.9091 13.0339 16.0929 12.6712C15.9507 12.6079 15.8869 12.4417 15.9499 12.2998C16.0129 12.158 16.1791 12.094 16.3212 12.1571M10.5 2.5625C8.44994 2.5625 6.78125 4.23119 6.78125 6.28125C6.78125 8.33131 8.44994 10 10.5 10C12.5501 10 14.2188 8.33131 14.2188 6.28125C14.2188 4.23119 12.5501 2.5625 10.5 2.5625ZM5.78125 6.28125C5.78125 3.67891 7.89766 1.5625 10.5 1.5625C13.1023 1.5625 15.2188 3.67891 15.2188 6.28125C15.2188 8.88359 13.1023 11 10.5 11C7.89766 11 5.78125 8.88359 5.78125 6.28125Z" fill="#A1CF55"/>
            </svg> Login</a>';
        }
        elseif( !empty( $atts['login_page_url'] ) )
        {
            $output = '<a href="'. $atts['login_page_url'] .'" class="zx-priv-link"><svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18.9135 13.1958C18.2507 12.6133 17.4469 12.1101 16.5242 11.7001C16.1297 11.5249 15.6682 11.7025 15.493 12.0968C15.3178 12.4911 15.4954 12.9527 15.8897 13.128C16.6678 13.4738 17.3382 13.8914 17.8822 14.3695C18.5528 14.9588 18.9375 15.812 18.9375 16.7109V18.1562C18.9375 18.587 18.587 18.9375 18.1562 18.9375H2.84375C2.41299 18.9375 2.0625 18.587 2.0625 18.1562V16.7109C2.0625 15.812 2.44717 14.9588 3.1178 14.3695C3.90714 13.6758 6.20694 12.0625 10.5 12.0625C13.6877 12.0625 16.2812 9.46896 16.2812 6.28125C16.2812 3.09354 13.6877 0.5 10.5 0.5C7.31229 0.5 4.71875 3.09354 4.71875 6.28125C4.71875 8.14481 5.60529 9.80496 6.97858 10.8629C4.46576 11.4152 2.90265 12.4785 2.08646 13.1958C1.07831 14.0815 0.5 15.3627 0.5 16.7109V18.1562C0.5 19.4487 1.55133 20.5 2.84375 20.5H18.1562C19.4487 20.5 20.5 19.4487 20.5 18.1562V16.7109C20.5 15.3627 19.9217 14.0815 18.9135 13.1958ZM6.28125 6.28125C6.28125 3.95505 8.1738 2.0625 10.5 2.0625C12.8262 2.0625 14.7188 3.95505 14.7188 6.28125C14.7188 8.60745 12.8262 10.5 10.5 10.5C8.1738 10.5 6.28125 8.60745 6.28125 6.28125Z" fill="#A1CF55"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.21875 6.28125C4.21875 2.81739 7.03614 0 10.5 0C13.9639 0 16.7812 2.81739 16.7812 6.28125C16.7812 9.74511 13.9639 12.5625 10.5 12.5625C6.34513 12.5625 4.15933 14.1198 3.44786 14.7451C2.88607 15.2387 2.5625 15.9548 2.5625 16.7109V18.1562C2.5625 18.3109 2.68914 18.4375 2.84375 18.4375H18.1562C18.3109 18.4375 18.4375 18.3109 18.4375 18.1562V16.7109C18.4375 15.9548 18.1139 15.2387 17.5522 14.7451C17.0522 14.3057 16.4265 13.9137 15.6867 13.5849C15.0402 13.2975 14.7487 12.5405 15.036 11.8938C15.3234 11.2471 16.0804 10.9559 16.7271 11.2431C17.6895 11.6708 18.5377 12.2 19.2436 12.8202C20.3603 13.8013 21 15.2196 21 16.7109V18.1562C21 19.7248 19.7248 21 18.1562 21H2.84375C1.27519 21 0 19.7248 0 18.1562V16.7109C0 15.2196 0.639697 13.8013 1.75644 12.8202C2.52046 12.1487 3.8737 11.2149 5.95179 10.6089C4.87922 9.48232 4.21875 7.95782 4.21875 6.28125ZM18.9135 13.1958L18.5835 13.5714C17.9637 13.0267 17.2042 12.5494 16.3212 12.1571M18.9135 13.1958L18.5835 13.5714C19.4831 14.3617 20 15.5058 20 16.7109V18.1562C20 19.1725 19.1725 20 18.1562 20H2.84375C1.82747 20 1 19.1725 1 18.1562V16.7109C1 15.5058 1.51692 14.3617 2.41648 13.5714C3.17748 12.9026 4.66587 11.8832 7.08592 11.3512L8.13303 11.121L7.28371 10.4668C6.02753 9.49908 5.21875 7.98255 5.21875 6.28125C5.21875 3.36968 7.58843 1 10.5 1C13.4116 1 15.7812 3.36968 15.7812 6.28125C15.7812 9.19282 13.4116 11.5625 10.5 11.5625C6.06875 11.5625 3.65494 13.2318 2.78774 13.9939C2.00829 14.6788 1.5625 15.6693 1.5625 16.7109V18.1562C1.5625 18.8631 2.13685 19.4375 2.84375 19.4375H18.1562C18.8631 19.4375 19.4375 18.8631 19.4375 18.1562V16.7109C19.4375 15.6693 18.9917 14.6788 18.2123 13.9939C17.6243 13.4772 16.9091 13.0339 16.0929 12.6712C15.9507 12.6079 15.8869 12.4417 15.9499 12.2998C16.0129 12.158 16.1791 12.094 16.3212 12.1571M10.5 2.5625C8.44994 2.5625 6.78125 4.23119 6.78125 6.28125C6.78125 8.33131 8.44994 10 10.5 10C12.5501 10 14.2188 8.33131 14.2188 6.28125C14.2188 4.23119 12.5501 2.5625 10.5 2.5625ZM5.78125 6.28125C5.78125 3.67891 7.89766 1.5625 10.5 1.5625C13.1023 1.5625 15.2188 3.67891 15.2188 6.28125C15.2188 8.88359 13.1023 11 10.5 11C7.89766 11 5.78125 8.88359 5.78125 6.28125Z" fill="#A1CF55"/>
            </svg> Login</a>';
        }
        else
        {
            $output = '<a href="'. site_url('/wp-admin') .'" class="zx-priv-link"><svg width="21" height="21" viewBox="0 0 21 21" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M18.9135 13.1958C18.2507 12.6133 17.4469 12.1101 16.5242 11.7001C16.1297 11.5249 15.6682 11.7025 15.493 12.0968C15.3178 12.4911 15.4954 12.9527 15.8897 13.128C16.6678 13.4738 17.3382 13.8914 17.8822 14.3695C18.5528 14.9588 18.9375 15.812 18.9375 16.7109V18.1562C18.9375 18.587 18.587 18.9375 18.1562 18.9375H2.84375C2.41299 18.9375 2.0625 18.587 2.0625 18.1562V16.7109C2.0625 15.812 2.44717 14.9588 3.1178 14.3695C3.90714 13.6758 6.20694 12.0625 10.5 12.0625C13.6877 12.0625 16.2812 9.46896 16.2812 6.28125C16.2812 3.09354 13.6877 0.5 10.5 0.5C7.31229 0.5 4.71875 3.09354 4.71875 6.28125C4.71875 8.14481 5.60529 9.80496 6.97858 10.8629C4.46576 11.4152 2.90265 12.4785 2.08646 13.1958C1.07831 14.0815 0.5 15.3627 0.5 16.7109V18.1562C0.5 19.4487 1.55133 20.5 2.84375 20.5H18.1562C19.4487 20.5 20.5 19.4487 20.5 18.1562V16.7109C20.5 15.3627 19.9217 14.0815 18.9135 13.1958ZM6.28125 6.28125C6.28125 3.95505 8.1738 2.0625 10.5 2.0625C12.8262 2.0625 14.7188 3.95505 14.7188 6.28125C14.7188 8.60745 12.8262 10.5 10.5 10.5C8.1738 10.5 6.28125 8.60745 6.28125 6.28125Z" fill="#A1CF55"/>
            <path fill-rule="evenodd" clip-rule="evenodd" d="M4.21875 6.28125C4.21875 2.81739 7.03614 0 10.5 0C13.9639 0 16.7812 2.81739 16.7812 6.28125C16.7812 9.74511 13.9639 12.5625 10.5 12.5625C6.34513 12.5625 4.15933 14.1198 3.44786 14.7451C2.88607 15.2387 2.5625 15.9548 2.5625 16.7109V18.1562C2.5625 18.3109 2.68914 18.4375 2.84375 18.4375H18.1562C18.3109 18.4375 18.4375 18.3109 18.4375 18.1562V16.7109C18.4375 15.9548 18.1139 15.2387 17.5522 14.7451C17.0522 14.3057 16.4265 13.9137 15.6867 13.5849C15.0402 13.2975 14.7487 12.5405 15.036 11.8938C15.3234 11.2471 16.0804 10.9559 16.7271 11.2431C17.6895 11.6708 18.5377 12.2 19.2436 12.8202C20.3603 13.8013 21 15.2196 21 16.7109V18.1562C21 19.7248 19.7248 21 18.1562 21H2.84375C1.27519 21 0 19.7248 0 18.1562V16.7109C0 15.2196 0.639697 13.8013 1.75644 12.8202C2.52046 12.1487 3.8737 11.2149 5.95179 10.6089C4.87922 9.48232 4.21875 7.95782 4.21875 6.28125ZM18.9135 13.1958L18.5835 13.5714C17.9637 13.0267 17.2042 12.5494 16.3212 12.1571M18.9135 13.1958L18.5835 13.5714C19.4831 14.3617 20 15.5058 20 16.7109V18.1562C20 19.1725 19.1725 20 18.1562 20H2.84375C1.82747 20 1 19.1725 1 18.1562V16.7109C1 15.5058 1.51692 14.3617 2.41648 13.5714C3.17748 12.9026 4.66587 11.8832 7.08592 11.3512L8.13303 11.121L7.28371 10.4668C6.02753 9.49908 5.21875 7.98255 5.21875 6.28125C5.21875 3.36968 7.58843 1 10.5 1C13.4116 1 15.7812 3.36968 15.7812 6.28125C15.7812 9.19282 13.4116 11.5625 10.5 11.5625C6.06875 11.5625 3.65494 13.2318 2.78774 13.9939C2.00829 14.6788 1.5625 15.6693 1.5625 16.7109V18.1562C1.5625 18.8631 2.13685 19.4375 2.84375 19.4375H18.1562C18.8631 19.4375 19.4375 18.8631 19.4375 18.1562V16.7109C19.4375 15.6693 18.9917 14.6788 18.2123 13.9939C17.6243 13.4772 16.9091 13.0339 16.0929 12.6712C15.9507 12.6079 15.8869 12.4417 15.9499 12.2998C16.0129 12.158 16.1791 12.094 16.3212 12.1571M10.5 2.5625C8.44994 2.5625 6.78125 4.23119 6.78125 6.28125C6.78125 8.33131 8.44994 10 10.5 10C12.5501 10 14.2188 8.33131 14.2188 6.28125C14.2188 4.23119 12.5501 2.5625 10.5 2.5625ZM5.78125 6.28125C5.78125 3.67891 7.89766 1.5625 10.5 1.5625C13.1023 1.5625 15.2188 3.67891 15.2188 6.28125C15.2188 8.88359 13.1023 11 10.5 11C7.89766 11 5.78125 8.88359 5.78125 6.28125Z" fill="#A1CF55"/>
            </svg> Login</a>';
        }
        
    }

    return $output;

}
add_shortcode( 'zx_user_btn', 'zx_get_user_priv_status' );
// [zx_user_btn login_page_id=""] OR [zx_user_btn login_page_url=""]

if(!function_exists('insert_attachment')) {
	function insert_attachment($file_handler, $post_id, $setthumb=false) {

		if ($_FILES[$file_handler]['error'] !== UPLOAD_ERR_OK) {
			return __return_false();
		}
		require_once(ABSPATH . "wp-admin" . '/includes/image.php');
		require_once(ABSPATH . "wp-admin" . '/includes/file.php');
		require_once(ABSPATH . "wp-admin" . '/includes/media.php');
		$attach_id = media_handle_upload( $file_handler, $post_id );

		return $attach_id;
	}
}

// HANDLE LISTING FORM

class Multistep_Form_Handler{
    
    function __construct()
    {
        add_action( "wp_ajax_register_new_user", array($this, 'register_new_user'), 10 );
        add_action( "wp_ajax_nopriv_register_new_user", array($this, 'register_new_user'), 10 );
        
        add_action( "wp_ajax_listing_house_info", array($this, 'listing_house_info'), 10 );
        add_action( "wp_ajax_nopriv_listing_house_info", array($this, 'listing_house_info'), 10 );
        
        add_action( "wp_ajax_listing_house_additional_info", array($this, 'listing_house_additional_info'), 10 );
        add_action( "wp_ajax_nopriv_listing_house_additional_info", array($this, 'listing_house_additional_info'), 10 );
        
        add_action( "wp_ajax_publish_listing_info", array($this, 'publish_listing_info'), 10 );
        add_action( "wp_ajax_nopriv_publish_listing_info", array($this, 'publish_listing_info'), 10 );
        
        add_action( "wp_ajax_send_new_inquire_to_owner", array($this, 'send_new_inquire_to_owner'), 10 );
        add_action( "wp_ajax_nopriv_send_new_inquire_to_owner", array($this, 'send_new_inquire_to_owner'), 10 );
        
        add_action( "wp_ajax_upload_single_file_func", array($this, 'upload_single_file_func'), 10 );
        add_action( "wp_ajax_nopriv_upload_single_file_func", array($this, 'upload_single_file_func'), 10 );
        
        add_action( "wp_ajax_upload_multiple_file_func", array($this, 'upload_multiple_file_func'), 10 );
        add_action( "wp_ajax_nopriv_upload_multiple_file_func", array($this, 'upload_multiple_file_func'), 10 );
        
        add_action( "wp_ajax_get_previous_step", array($this, 'get_previous_step'), 10 );
        add_action( "wp_ajax_nopriv_get_previous_step", array($this, 'get_previous_step'), 10 );
    }
    
    // STEP #1
    public function register_new_user()
    {
        if( !wp_verify_nonce($_POST['secure_listing'] , 'secure_listing' ) )
        {
            $ajax['status'] = false;
            $ajax['message'] = 'Nonce Error!';
            
            print(json_encode($ajax));
            exit();
        }
        
        if( !empty($_POST['email_address']) && !empty($_POST['username']) && !empty($_POST['password']) && !is_user_logged_in())
        {
            
            if( username_exists($_POST['username']) )
            {
                $ajax['status']     = false;
                $ajax['message']    = 'Username already exists';
    
                print(json_encode($ajax));
                exit();
            }
            elseif( email_exists($_POST['email_address']) )
            {
                $ajax['status']     = false;
                $ajax['message']    = 'Email Address already exists';
    
                print(json_encode($ajax));
                exit();
            }
            
            $user_data = array(
                'user_pass'     => $_POST['password'],
                'user_login'    => esc_attr($_POST['username']),
                'user_email'    => esc_attr($_POST['email_address']),
                'first_name'    => esc_attr($_POST['first_name']),
                'last_name'     => esc_attr($_POST['last_name']),
                'role'          => esc_attr('subscriber'),
                'phone_number'  => esc_attr($_POST['phone_number'])
            );
            
            $_SESSION['user_data'] = $user_data;
            
            ob_start();
            require get_stylesheet_directory() . '/backend-system/form-steps/step2.php';
            $html = ob_get_clean();
            
            $ajax['html'] = $html;
            $ajax['status'] = true;
            
            print(json_encode($ajax));
            exit();
        }
        elseif( is_user_logged_in() )
        {
            $current_user = wp_get_current_user();
            $user_data = array(
                'user_email'    => $current_user->user_email,
                'first_name'    => get_user_meta( $current_user->ID, 'first_name', true ),
                'last_name'     => get_user_meta( $current_user->ID, 'last_name', true ),
                'phone_number'  => esc_attr($_POST['phone_number'])
            );
            
            $_SESSION['user_data'] = $user_data;
            
            ob_start();
            require get_stylesheet_directory() . '/backend-system/form-steps/step2.php';
            $html = ob_get_clean();
            
            $ajax['html'] = $html;
            $ajax['status'] = true;
            $ajax['session_data'] = (!empty( $_SESSION['listing_house_info_1'] )) ? $_SESSION['listing_house_info_1'] : '';
            
            print(json_encode($ajax));
            exit();
        }
        else
        {
            $ajax['status']     = false;
            $ajax['message']    = 'Invalid User Input';
            print(json_encode($ajax));
            exit();
        }
    }
    
    // STEP #2
    public function listing_house_info()
    {
        $_SESSION['listing_house_info_1'] = $_POST;
        
        ob_start();
        require get_stylesheet_directory() . '/backend-system/form-steps/step2a.php';
        $html = ob_get_clean();
        
        $ajax['html'] = $html;
        $ajax['status'] = true;
        $ajax['session_data'] = (!empty( $_SESSION['listing_house_info_2'] )) ? $_SESSION['listing_house_info_2'] : '';
        
        print(json_encode($ajax));
        exit();
    }
    
    // STEP #3
    public function listing_house_additional_info()
    {
        $_SESSION['listing_house_info_2'] = $_POST;
        
        ob_start();
        require get_stylesheet_directory() . '/backend-system/form-steps/step3.php';
        $html = ob_get_clean();
        
        $ajax['html'] = $html;
        $ajax['status'] = true;
        
        print(json_encode($ajax));
        exit();
    }
    
    // STEP #4
    public function publish_listing_info()
    {
        // $allow_file_type = array('png', 'jpg', 'jpeg', 'webp');
        // $filename = $_FILES['featured_images']['name'];
        // $ext = pathinfo($filename, PATHINFO_EXTENSION);
        // if (!in_array($ext, $allow_file_type))
        // {
        //     $ajax['status'] = false;
        //     $ajax['message'] = 'Invalid File Type!';
        //     print(json_encode($ajax));
        //     exit();
        // }
        
        if( !is_user_logged_in() )
        {
            $user_ID = wp_insert_user($_SESSION['user_data']);
        }
        else
        {
            $user_ID = get_current_user_id();
        }
        
        $post_array = array(
            'post_type'         => 'home_listing',
            'post_author'       => $user_ID,
            'post_content'      => sanitize_textarea_field( $_SESSION['listing_house_info_1']['sell_your_hourse'] ),
            'post_title'        => sanitize_text_field( $_SESSION['listing_house_info_1']['house_name'] ),
        );
        
        $postID = wp_insert_post( $post_array );
        update_post_meta( $postID, 'price', sanitize_text_field( $_SESSION['listing_house_info_1']['dream_price'] ));
        update_post_meta( $postID, 'address', sanitize_text_field( $_SESSION['listing_house_info_2']['physical_address'] ));
        update_post_meta( $postID, 'citystate', sanitize_text_field( $_SESSION['listing_house_info_2']['city_state'] ));
        update_post_meta( $postID, 'zipcode', sanitize_text_field( $_SESSION['listing_house_info_2']['zip_code'] ));
        update_post_meta( $postID, 'area_aqft', sanitize_text_field( $_SESSION['listing_house_info_2']['area_squarefeet'] ));
        update_post_meta( $postID, 'bedrooms', sanitize_text_field( $_SESSION['listing_house_info_2']['number_of_bedrooms'] ));
        update_post_meta( $postID, 'bathrooms', sanitize_text_field( $_SESSION['listing_house_info_2']['number_of_bathrooms'] ));
        update_post_meta( $postID, 'style_of_house', sanitize_text_field( $_SESSION['listing_house_info_1']['style_of_house'] ));
        update_post_meta( $postID, 'amenities', implode(", ", $_SESSION['listing_house_info_1']['amenities']));
        update_post_meta( $postID, 'phone_number', sanitize_text_field($_SESSION['user_data']['phone_number']));
        
        // $single_image = false;
        // $multiple_image = false;
        // $ajax['media_error'] = false;
        
        // Single Image
        // $file_attach_id = insert_attachment( 'featured_images', $postID);
        
        // Multiple Image
        // $gallery_images = $_FILES['gallery_images'];
        // foreach( $gallery_images['name'] as $keyImage => $valueImage )
        // {
        //     if( $gallery_images['name'][$keyImage] )
        //     {
        //         $gallery_image_file = array(
        //             'name'      => $gallery_images['name'][$keyImage],
        //             'type'      => $gallery_images['type'][$keyImage],
        //             'tmp_name'  => $gallery_images['tmp_name'][$keyImage],
        //             'error'     => $gallery_images['error'][$keyImage],
        //             'size'      => $gallery_images['size'][$keyImage]
        //         );
        
        //         $_FILES = array ('gallery_images' => $gallery_image_file);
        //         foreach( $_FILES as $keyFile => $valueFile )
        //         {
        //             $file_attach_ids[] = insert_attachment( $keyFile, $postID);
        //         }
        //     }
        // }
        
        if( empty($_POST['featured_image_id']) )
        {
            $single_image = true;
        }
        else
        {
            set_post_thumbnail( $postID, $_POST['featured_image_id'] );
        }
        
        if( empty($_POST['gallery_image_id']) )
        {
            $multiple_image = true;
        }
        else
        {
            $file_attach_ids = explode(",", $_POST['gallery_image_id']);
            update_field( 'listing_gallery', $file_attach_ids, $postID );
        }
        
        ob_start();
        require get_stylesheet_directory() . '/template-list_your_house.php';
        $html = ob_get_clean();
        
        $ajax['html'] = $html;
        $ajax['status'] = true;
        
        if( $single_image && $multiple_image )
        {
            $ajax['media_error'] = true;
            $ajax['file_upload_error_0'] = 'Media Is Failed To Upload - Try To Upload Again From Dashboard!';
        }
        else
        {
            if( $single_image )
            {
                $ajax['media_error'] = true;
                $ajax['file_upload_error_0'] = 'Featured Image Is Failed To Upload - Try To Upload Again From Dashboard!';
            }
            if( $multiple_image )
            {
                $ajax['media_error'] = true;
                $ajax['file_upload_error_0'] = 'Gallery Is Failed To Upload - Try To Upload Again From Dashboard!';
            }
        }
        
		
		$headers = array('Content-Type: text/html; charset=UTF-8');
		$subject = "Notification: New Listing (". $_SESSION['listing_house_info_1']['house_name'] .")";
		$message = '<html><body>';
		$message .= '<table>';

		$message .= "<tr><td><strong>Name: </strong> </td><td>".$_SESSION['user_data']['first_name'] . ' ' . $_SESSION['user_data']['last_name']."</td></tr>";
		$message .= "<tr><td><strong>Email: </strong> </td><td>".$_SESSION['user_data']['user_email']."</td></tr>";
		$message .= "<tr><td><strong>Phone: </strong> </td><td>".$_SESSION['user_data']['phone_number']."</td></tr>";
		
		$message .= "<tr><td><br></td></tr>";
		
		$message .= "<tr><td><a href='".get_permalink($postID)."'>Click Here</a> To View The Listing.</tr>";

		$message .= "</table>";
		$message .= "</body></html>";

		wp_mail('dallas@therealrealestate.com', $subject,$message, $headers);
		
		
        $ajax['message'] = 'Your Post Has Been Submitted - Waiting For Approval!';
        print(json_encode($ajax));
        session_destroy();
        exit();
    }
    
    // FILE UPLOAD FUNCTIONS
    public function upload_single_file_func()
    {
        $allow_file_type = array('png', 'jpg', 'jpeg', 'webp');
        $filename = $_FILES['featured_images']['name'];
        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        if (!in_array($ext, $allow_file_type))
        {
            $ajax['status'] = false;
            $ajax['message'] = 'Invalid File Input';
            print(json_encode($ajax));
            exit();
        }
        
        $file_attach_id = insert_attachment( 'featured_images', rand(1111, 99999));
        
        if( !empty($file_attach_id) )
        {
            $ajax['status'] = true;
            $ajax['data'] = $file_attach_id;
            $ajax['message'] = 'Done';
            $ajax['s_class'] = 'file-ok';
            print(json_encode($ajax));
            exit();
        }
        else
        {
            $ajax['status'] = false;
            $ajax['message'] = 'Error';
            $ajax['s_class'] = 'file-error';
            print(json_encode($ajax));
            exit();
        }
    }
    
    // FILE UPLOAD FUNCTIONS
    public function upload_multiple_file_func()
    {
        // Multiple Image
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
                    $file_attach_ids[] = insert_attachment( $keyFile, rand(1111, 999999));
                }
            }
        }
        
        if( !empty($file_attach_ids) )
        {
            $ajax['status'] = true;
            $ajax['data'] = $file_attach_ids;
            $ajax['message'] = 'Done';
            $ajax['s_class'] = 'file-ok';
            print(json_encode($ajax));
            exit();
        }
        else
        {
            $ajax['status'] = false;
            $ajax['message'] = 'Error';
            $ajax['s_class'] = 'file-error';
            print(json_encode($ajax));
            exit();
        }
    }
    
    public function get_previous_step()
    {
        if( !empty( $_POST['step_no'] ) )
        {
            $step_no = (int)$_POST['step_no'];
            
            if( $step_no == 1 )
            {
                ob_start();
                require get_stylesheet_directory() . '/template-list_your_house.php';
                $html = ob_get_clean();
                $session_data = $_SESSION['user_data'];
            }
            elseif( $step_no == 2 )
            {
                ob_start();
                require get_stylesheet_directory() . '/backend-system/form-steps/step2.php';
                $html = ob_get_clean();
                $session_data = $_SESSION['listing_house_info_1'];
            }
            elseif( $step_no == 3 )
            {
                ob_start();
                require get_stylesheet_directory() . '/backend-system/form-steps/step2a.php';
                $html = ob_get_clean();
                $session_data = $_SESSION['listing_house_info_2'];
            }
            else
            {
                $ajax['status'] = false;
                $ajax['message'] = 'Invalid Step ID';
                print(json_encode($ajax));
                exit();
            }
            
            $ajax['html'] = $html;
            $ajax['session_data'] = $session_data;
            $ajax['status'] = true;
            print(json_encode($ajax));
            exit();
        }
        else
        {
            $ajax['status'] = false;
            $ajax['message'] = 'Oops! Something Went Wrong!';
            print(json_encode($ajax));
            exit();
        }
    }
    
    
    // SEND NEW INQUIRE
    public function send_new_inquire_to_owner()
    {
        if( !wp_verify_nonce($_POST['new_inquire_nonce'] , 'new_inquire_nonce' ) )
        {
            $ajax['status'] = false;
            $ajax['message'] = 'Nonce Error!';
            
            print(json_encode($ajax));
            exit();
        }
        
        $name   = $_POST['full_name'];
        $email  = $_POST['phone_number'];
        $phone  = $_POST['email_address'];
		$price = $_POST['price_offer'];
        $message_text = $_POST['message_to_owner'];
        
        $listing_ID = $_POST['current_single_listing'];
        $listing_obj = get_post($listing_ID);
        $listing_Author = $listing_obj->post_author;
        $author_obj = get_user_by('id', $listing_Author);
        
        if( !empty( $name ) && !empty( $email ) && !empty( $phone ) && !empty( $message_text ) && !empty( $listing_ID ) )
        {
            $headers = array('Content-Type: text/html; charset=UTF-8');
            $subject = "Notification: New Inquiry (". $listing_obj->post_title .")";
            $message = '<html><body>';
            $message .= '<table rules="all" style="border-color: #666;" cellpadding="10">';
            
            $message .= "<tr style='background: #eee;'><td><strong>Name: </strong> </td><td>".$name."</td></tr>";
            $message .= "<tr style='background: #eee;'><td><strong>Email: </strong> </td><td>".$email."</td></tr>";
            $message .= "<tr style='background: #eee;'><td><strong>Phone: </strong> </td><td>".$phone."</td></tr>";
			$message .= "<tr style='background: #eee;'><td><strong>Offer Price: </strong> </td><td>".$price."</td></tr>";
            $message .= "<tr style='background: #eee;'><td><strong>Message: </strong> </td><td>".$message_text."</td></tr>";
            
            $message .= "</table>";
            $message .= "</body></html>";
            
            wp_mail(array($author_obj->user_email, 'dallas@therealrealestate.com'), $subject,$message, $headers);
            
            $ajax['status'] = true;
            $ajax['message'] = 'Inquire Has Been Sent!';
            
            print(json_encode($ajax));
            exit();
        }
        else
        {
            $ajax['status'] = false;
            $ajax['message'] = 'Something Went Wrong!';
            
            print(json_encode($ajax));
            exit();
        }
    }
    
}
new Multistep_Form_Handler();


class Search_Form_Handler{
    
    function __construct()
    {
        add_action( "wp_ajax_primary_listing_search_func", array($this, 'primary_listing_search_func'), 10 );
        add_action( "wp_ajax_nopriv_primary_listing_search_func", array($this, 'primary_listing_search_func'), 10 );
    }
    
    public function primary_listing_search_func()
    {
        $searched_key_letters   = !empty( $_POST['search_text'] ) ? $_POST['search_text'] : '';
        $searched_home_style    = !empty( $_POST['style_of_home'] ) ? $_POST['style_of_home'] : '';
        $searched_price_range   = !empty( $_POST['home_price'] ) ? $_POST['home_price'] : '';
        $searched_home_beds     = !empty( $_POST['home_beds'] ) ? $_POST['home_beds'] : '';
        $searched_home_baths    = !empty( $_POST['home_bath'] ) ? $_POST['home_bath'] : '';
        
        $mainarray = array(
            'post_type' => array('home_listing'),
            'post_status' => array('publish'),
            'order' => 'DESC',
            'posts_per_page' => -1,
            's' =>  $searched_key_letters,
            'meta_query' => array(
                'relation' => 'AND',
                array(
                    'key' => 'style_of_house',
                    'value' => $searched_home_style,
                    'compare' => 'LIKE'
                ),
                array(
                    'key' => 'price',
                    'value' => $searched_price_range,
                    'type' => 'numeric',
                    'compare' => '<='
                ),
                array(
                    'key' => 'bedrooms',
                    'value' => $searched_home_beds,
                    'type' => 'numeric',
                    'compare' => '='
                ),
                array(
                    'key' => 'bathrooms',
                    'value' => $searched_home_baths,
                    'type' => 'numeric',
                    'compare' => '='
                ),
            ),
        );
        
        $q = new WP_Query($mainarray);
        
        if( $q->have_posts() )
        {
            while ($q->have_posts())
            {
                $q->the_post();
                
                 if( has_post_thumbnail() )
                 {
                     $thumbnail = wp_get_attachment_image_src(get_post_thumbnail_id(),'large', true);
                 }
                 else
                 {
                     $thumbnail[0] = site_url('/wp-content/uploads/2022/05/No_Image_Placeholder-1.png');
                 }
        		    
                $fetched_data[] = array(
                    'listing_permalink' => get_permalink(),
                    'listing_thumbnail' => $thumbnail[0],
                    'listing_price'     => get_field('price'),
                    'listing_address'   => get_field('address'),
                    'listing_citystate' => get_field('citystate'),
                    'listing_zipcode'   => get_field('zipcode'),
                    'listing_area'      => get_field('area_aqft'),
                    'listing_bedroom'   => get_field('bedrooms'),
                    'listing_bathroom'  => get_field('bathrooms'),
                    'site_url'          => site_url()
                );
            }
            $ajax['status'] = true;
            $ajax['data'] = $fetched_data;
        }
        else
        {
            $ajax['status'] = false;
            $ajax['norecord'] = '<strong>No Result Found For ' . $searched_key_letters . '</strong>';
        }
        
        
        print(json_encode($ajax));
        exit();
    }
    
}
new Search_Form_Handler();




