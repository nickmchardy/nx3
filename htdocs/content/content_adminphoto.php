<?php

/**
* nx3 Content Module: Admin Photo Album Editor
* 
* Admin module to view & edit photo galleries & photos.
* @author Nick McHardy <nm@nisch.org>
* @version 1.0
* @package nx3
*
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 14-Jan-2010  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*/

function content_handler($db, $obj_user, $content, $action, $template)
{
  if ($action == "view" || $action == "")
  {
    define("PAGE_HEADING", "View Photo Galleries");
    return action_default($db, $obj_user);
  }
  else
  {
    fatal_error_handler ($db, "Specified action is not valid.");
  }
}

function action_default($db, $obj_user)
{
  // Display all rows
  $db_result = func_db_query($db, "SELECT pg.order_by, pg.photo_gallery_code, pg.photo_gallery_name, pg.image_path, pg.thumb_path,
    pg.hidden_yn, pg.enabled_yn
    FROM @TABLE_PREFIX@nx3_photo_gallery pg ORDER BY 1", null);
  
  $page_content = array();
  foreach ($db_result as $row_id => $row_data)
  {
    $page_content['content_list_photo_albums'][] = array(
      'order_by' => $row_data['order_by'], 
      'photo_gallery_code' => $row_data['photo_gallery_code'],
      'photo_gallery_name' => $row_data['photo_gallery_name'],
      'image_path' => $row_data['image_path'],
      'thumb_path' => $row_data['thumb_path'],
      'hidden_yn' => $row_data['hidden_yn'],
      'enabled_yn' => $row_data['enabled_yn']
      );
  }
  
  return $page_content;
}

?>