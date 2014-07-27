<?php

/**
* nx3 Content Module: Photo
* 
* A basic photo album implementation using SimpleViewer.
* @author Nick McHardy <nm@nisch.org>
* @version 1.1
* @package nx3
*
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 14-Jul-2009  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*  1.1     | 12-Jan-2010  | nisch       | Changed to support Apache Mod_Rewrite for nicer URLs
* ---------+--------------+-------------+----------------------------------------
*/

function content_handler($db, $obj_user, $content, $action, $template)
{
  if ($action == "")
  {
    define("PAGE_HEADING", "Photo Gallery List");
    return action_default($db, $obj_user);
  }
  else if ($action == "view")
  {
    return action_view($db, $obj_user, $GLOBALS['NX3_PARAM_ARRAY'][2]);
  }
  else
  {
    fatal_error_handler ($db, "Specified action is not valid.");
  }
}

function action_default ($db, $obj_user)
{     
  $result_galleries = func_db_query($db, "SELECT g.photo_gallery_code, g.photo_gallery_name, u.display_name, g.created_date
    FROM @TABLE_PREFIX@nx3_photo_gallery g JOIN @TABLE_PREFIX@nx3_user u ON g.created_by = u.user_id
    WHERE g.hidden_yn = 'N' AND g.enabled_yn = 'Y' ORDER BY g.order_by", null);
  $page_content = array();
  foreach ($result_galleries as $row_id => $row_data)
  {
    $page_content['content_photo_list'][] = array(
        'gallery_code' => $row_data['photo_gallery_code']
      , 'gallery_name' => $row_data['photo_gallery_name']
      , 'created_by' => $row_data['display_name']
      , 'created_date' => func_compare_date_to_now($row_data['created_date'])
      );
  }
 
  return $page_content;
}

function action_view($db, $obj_user, $gallery_code)
{
  // Display requested photo gallery if it is enabled etc.
  $result_gallery = func_db_query($db, "SELECT g.order_by, g.photo_gallery_id, g.photo_gallery_code, g.photo_gallery_name
    FROM @TABLE_PREFIX@nx3_photo_gallery g WHERE g.photo_gallery_code = ? AND g.enabled_yn = 'Y' LIMIT 1", array("s", $gallery_code));
  
  if ($result_gallery == null)
  {
    return array('content_photo_error' => true, 'content_photo_gallery_code' => $gallery_code);
  }
  define("PAGE_HEADING", "Viewing Photo Gallery '" . $result_gallery[0]['photo_gallery_name'] . "'");
  
  $page_content = array('content_photo_viewer_js_url' => lookup_setting($db, 'nx3.global.siteurl') . lookup_setting($db, 'nx3.photo.javascripturl'),
                    'content_photo_viewer_swf_url' => lookup_setting($db, 'nx3.global.siteurl') . lookup_setting($db, 'nx3.photo.flashurl'),
                    'content_photo_gallery_xml_url' => lookup_setting($db, 'nx3.global.siteurl') . 'photogalleryxml/view/' . $gallery_code);

  return $page_content;
}

?>