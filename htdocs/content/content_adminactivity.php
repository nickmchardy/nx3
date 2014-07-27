<?php

/**
* nx3 Content Module: Admin Activity Editor
* 
* Admin module to view & edit activity targets (eg blogs, comments, external feeds, etc).
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
    define("PAGE_HEADING", "View Activity");
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
  $db_result = func_db_query($db, "SELECT a.activity_code, a.activity_name, a.activity_description, a.activity_sql, a.enabled_yn
    FROM @TABLE_PREFIX@nx3_activity a ORDER BY 1", null);
  
  $page_content = array();
  foreach ($db_result as $row_id => $row_data)
  {
    $page_content['content_list_activity'][] = array(
      'activity_code' => $row_data['activity_code'], 
      'activity_name' => $row_data['activity_name'],
      'activity_description' => $row_data['activity_description'],
      'activity_sql' => $row_data['activity_sql'],
      'enabled_yn' => $row_data['enabled_yn']
      );
  }
  
  return $page_content;
}

?>