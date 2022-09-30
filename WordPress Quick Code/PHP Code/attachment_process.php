<?php 

/* 
    Get / Process Attachment File In PHP/WORDPRESS 
*/

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

/*
*   RETURN ATTACHMENT 'ID' AFTER SAVING IT TO DATABASE BY NAME_OF_FILE && CUTOM GIVEN ID
*   insert_attachment(NAME_OF_FILE, ID);
*/

$attach_id = insert_attachment('NAME_OF_FILE',  $POST_ID);

/*
*   GET ATTACHMENT FILE
*/
$attach_file = get_attached_file($attach_id);

/*
*   GET ATTACHMENT URL BY ID
*/
$attach_url = wp_get_attachment_url( $attach_id );

/*
*   GET FULL HTML TAG WITH 'src' (FOR IMAGE)
*/

wp_get_attachment_image($attach_id, array('300', '300'));


/*
*   ATTACHMENT VALIDATION
*/
$allow_file_type = array('png', 'jpg');
$filename = $_FILES['NAME_OF_FILE']['name'];
$ext = pathinfo($filename, PATHINFO_EXTENSION);
if (!in_array($ext, $allow_file_type))
{
	$ajax['status'] = false;
	$ajax['message'] = 'Invalid File Type!';
	print(json_encode($ajax));
	exit();
}

/*
*   SINGLE FILE UPLOAD
*/

$file_attach_id = insert_attachment( 'NAME_OF_FILE', $postID);
// Set Post Thumbnail
set_post_thumbnail( $postID, $file_attach_id );

/*
*   MULTIPLE FILES UPLOAD
*/
$gallery_images = $_FILES['NAME_OF_FILE'];
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

		$_FILES = array ('NAME_OF_FILE' => $gallery_image_file);
		foreach( $_FILES as $keyFile => $valueFile )
		{
			$file_attach_ids[] = insert_attachment( $keyFile, $postID);
		}
	}
}
// Updating ACF Gallery
update_field( 'listing_gallery', $file_attach_ids , $postID );