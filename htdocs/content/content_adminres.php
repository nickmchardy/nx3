<?php

/**
* nx3 Content Module: Admin Res Editor
* 
* Admin module to view & edit res table.
* @author Nick McHardy <nm@nisch.org>
* @version 1.0
* @package nx3
*
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 13-Jan-2010  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*/

function content_handler($db, $obj_user, $content, $action, $template)
{
  if ($action == "view" || $action == "")
  {
    define("PAGE_HEADING", "View Resources");
    return action_default($db, $obj_user);
  }
  else
  {
    fatal_error_handler ($db, "Specified action is not valid.");
  }
}

function action_default($db, $obj_user)
{
  // Display all records in DB
  $db_result = func_db_query($db, "SELECT res_file_name, res_description, res_content_type, res_content_expiry, enabled_yn
    FROM @TABLE_PREFIX@nx3_res ORDER BY 1", null);
  
  $page_content = array();
  foreach ($db_result as $row_id => $row_data)
  {
    $page_content['content_res'][] = array(
      'res_file_name' => $row_data['res_file_name'], 
      'res_description' => $row_data['res_description'],
      'res_content_type' => $row_data['res_content_type'],
      'res_content_expiry' => $row_data['res_content_expiry'],
      'enabled_yn' => $row_data['enabled_yn']
      );
  }
  return $page_content;
}

?>