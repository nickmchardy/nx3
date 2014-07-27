<?php

/**
* nx3 Content Module: Admin Security Editor
* 
* Admin module to view & edit users and groups.
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
    define("PAGE_HEADING", "View Users and Groups");
    return action_default($db, $obj_user);
  }
  else
  {
    fatal_error_handler ($db, "Specified action is not valid.");
  }
}

function action_default($db, $obj_user)
{
  // Display all groups and their members in DB
  $db_result = func_db_query($db, "SELECT g.group_name, g.enabled_yn AS group_enabled_yn,
    u.username, u.email, u.display_name, CASE WHEN u.status = 'ACTIVE' THEN 'Y' ELSE 'N' END AS user_enabled_yn, u.last_active
    FROM @TABLE_PREFIX@nx3_group g
    JOIN @TABLE_PREFIX@nx3_group_membership gm ON g.group_id = gm.group_id
    JOIN @TABLE_PREFIX@nx3_user u ON gm.user_id = u.user_id
    ORDER BY 1, 3", null);
  
  $page_content = array();
  foreach ($db_result as $row_id => $row_data)
  {
    $page_content['content_list_security'][] = array(
      'group_name' => $row_data['group_name'], 
      'group_enabled_yn' => $row_data['group_enabled_yn'],
      'username' => $row_data['username'],
      'email' => $row_data['email'],
      'display_name' => $row_data['display_name'],
      'user_enabled_yn' => $row_data['user_enabled_yn'],
      'last_active' => $row_data['last_active']
      );
  }
  
  return $page_content;
}

?>