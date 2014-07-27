<?php

/**
* nx3 Content Module: Admin Menu Editor
* 
* Admin module to view & edit menus.
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
    define("PAGE_HEADING", "View Menus");
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
  $db_result = func_db_query($db, "SELECT m.menu_code, m.menu_name, m.menu_description, 'Y' AS enabled_yn,
    (SELECT COUNT(1) FROM @TABLE_PREFIX@nx3_menu_item mi WHERE m.menu_id = mi.menu_id) AS count_menu_items
    FROM @TABLE_PREFIX@nx3_menu m ORDER BY 1", null);
  
  $page_content = array();
  foreach ($db_result as $row_id => $row_data)
  {
    $page_content['content_list_menu'][] = array(
      'menu_code' => $row_data['menu_code'], 
      'menu_name' => $row_data['menu_name'],
      'menu_description' => $row_data['menu_description'],
      'count_menu_items' => $row_data['count_menu_items'],
      'enabled_yn' => $row_data['enabled_yn']
      );
  }
  
  return $page_content;
}

?>