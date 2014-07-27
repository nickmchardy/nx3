<?php

/**
* nx3 Content Module: Admin Settings Editor
* 
* Admin module to view & edit settings table.
* @author Nick McHardy <nm@nisch.org>
* @version 1.0
* @package nx3
*
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 12-Jan-2010  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*/

function content_handler($db, $obj_user, $content, $action, $template)
{
  if ($action == "view" || $action == "")
  {
    define("PAGE_HEADING", "View Settings");
    return action_default($db, $obj_user);
  }
  elseif ($action == "savesetting")
  {
    define("PAGE_HEADING", "View Settings");
    return action_save($db, $obj_user);
  }
  else
  {
    fatal_error_handler ($db, "Specified action is not valid.");
  }
}

function action_default($db, $obj_user)
{
  // Display all logs in DB
  $db_result = func_db_query($db, "SELECT field, value, description FROM @TABLE_PREFIX@nx3_setting ORDER BY 1", null);
  
  $page_content = array();
  foreach ($db_result as $row_id => $row_data)
  {
    $page_content['content_settings'][] = array('field' => $row_data['field'], 
      'value' => $row_data['value'],
      'description' => $row_data['description']
      );
  }
  return $page_content;
}

function action_save($db, $obj_user)
{
  if (isset($_POST['field']) && isset($_POST['value']))
  {
    $str_field = $_POST['field'];
    $str_value = $_POST['value'];
    $int_user_id = $obj_user['user_id'];
  }
  else
  {
    return array('content_settings_error' => 'missing_data');
  }
  
  $db_update = func_db_query($db, "UPDATE @TABLE_PREFIX@nx3_setting SET value = ?, updated_date = NOW(), updated_by = ?
    WHERE field = ? LIMIT 1", array("sis", $str_value, $int_user_id, $str_field));
  
  $page_content = action_default($db, $obj_user);
  $page_content['content_setting_field'] = $str_field; 
  $page_content['content_setting_value'] = $str_value;
  
  return $page_content;
}

?>