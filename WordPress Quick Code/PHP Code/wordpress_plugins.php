<?php 

/* 
    Disable Plugin New Version Check & Updates 
*/
add_filter( 'site_transient_update_plugins', 'AS_disable_plugin_updates' );
function AS_disable_plugin_updates( $value ) 
{
    // Plugin's Main File With Folder Name
    $pluginsNotUpdatable = [
      	'dokan-lite/dokan.php',
		'dokan-pro/dokan-pro.php'
    ];
  
    if ( isset($value) && is_object($value) ) 
    {
        foreach ($pluginsNotUpdatable as $plugin) 
        {
            if ( isset( $value->response[$plugin] ) ) 
            {
                unset( $value->response[$plugin] );
            }
        }
    }
    
    return $value;
}