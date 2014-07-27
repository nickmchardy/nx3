<?php

/**
* nx3 Content Module: Admin Smilies Editor
* 
* Admin module to view & edit smilies.
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
    define("PAGE_HEADING", "View Smilies");
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
  $db_result = func_db_query($db, "SELECT s.smiley_id, s.target, s.url, s.enabled_yn
    FROM @TABLE_PREFIX@nx3_smiley s ORDER BY 1", null);
  
  $page_content = array();
  foreach ($db_result as $row_id => $row_data)
  {
    $page_content['content_list_smilies'][] = array(
      'target' => $row_data['target'], 
      'url' => $row_data['url'],
      'enabled_yn' => $row_data['enabled_yn']
      );
  }
  
  return $page_content;
}

?>