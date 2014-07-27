<?php

/**
* nx3 Script Module: Photo Gallery XML
* 
* Generates the content of a gallery.xml file to import into SimpleViewer (flash-based
*  photo album viewer).
* @author Nick McHardy <nm@nisch.org>
* @version 1.0
* @package nx3
* 
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 14-Jul-2009  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*/

function script_handler($db, $obj_user, $content, $action, $smarty_template_file)
{
  if ($action == '')
  {
    fatal_error_handler ($db, "Invalid action specified.");
  }

  $get_gallery_code = $GLOBALS['NX3_PARAM_ARRAY'][2];
  
  // Validate parameters
  if ($get_gallery_code == '')
  {
    fatal_error_handler ($db, "No photo gallery specified.");
  }

  // Fetch gallery definition.
  $result_gallery = func_db_query($db, "SELECT g.photo_gallery_id, g.photo_gallery_code, g.photo_gallery_name, g.enabled_yn,
    g.image_path, g.thumb_path
    FROM @TABLE_PREFIX@nx3_photo_gallery g WHERE g.photo_gallery_code = ? LIMIT 1", array("s", $get_gallery_code));

  if (!isset($result_gallery[0]['photo_gallery_id']))
  {
    fatal_error_handler ($db, "Requested photo gallery code " . $get_gallery_code . " does not exist or you do not have access to the gallery."); 
  }
    
  $gallery_id = $result_gallery[0]['photo_gallery_id'];
  $gallery_enabled_yn = $result_gallery[0]['enabled_yn'];
  $gallery_name = $result_gallery[0]['photo_gallery_name'];
  $gallery_image_path = $result_gallery[0]['image_path'];
  $gallery_thumb_path = $result_gallery[0]['thumb_path'];
      
  // Perform checks of result set
  if ($gallery_enabled_yn != 'Y')
  {
    fatal_error_handler ($db, "Requested photo gallery code " . $get_gallery_code . " is not enabled.");
  }
  
  // Generate XML for each image in the gallery
  $result_images = func_db_query($db, "SELECT i.order_by, i.image_name, i.image_description, i.image_file_name, i.date_taken
    FROM @TABLE_PREFIX@nx3_photo_image i WHERE i.photo_gallery_id = ? AND i.deleted_yn = 'N' ORDER BY 1", array("i", $gallery_id));
  $page_content = array();
  foreach ($result_images as $row)
  {
    $page_content['script_photo_gallery_images'][] = array('filename' => $row['image_file_name']
      , 'title' => $row['image_name']
      , 'date_taken' => func_compare_date_to_now($row['date_taken'])
      , 'description' => $row['image_description']);
  }
  
  $page_content['script_photo_gallery_title'] = $gallery_name;
  $page_content['script_photo_gallery_image_path'] = lookup_setting($db, 'nx3.global.siteurl') . $gallery_image_path;
  $page_content['script_photo_gallery_thumb_path'] = lookup_setting($db, 'nx3.global.siteurl') . $gallery_thumb_path;

  // Invoke Smarty Template Engine
  $smarty = new Smarty;
  $smarty->template_dir = lookup_setting($db, 'smarty.template.location');
  $smarty->compile_dir = lookup_setting($db, 'smarty.compile.location');
  $smarty->config_dir = lookup_setting($db, 'smarty.config.location');
  $smarty->compile_check = $GLOBALS['NX3_DEBUG']; // Only compile if NX3 debug mode is enabled
  foreach ($page_content as $key => $value)
  {
    $smarty->assign($key, $value);
  }
  
  // change the content-type so the browser knows how to handle it
  header("Content-type: text/xml");
  
  // set the content expiry thing so the browser always gets the latest version
  header("Cache-Control: no-cache");

  // Return the xml data
  return $smarty->fetch($smarty_template_file);
}
 
?>