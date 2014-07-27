<?php

/**
* nx3 Content Module: Activity
* 
* Provides a graphical representation of recent activity on the site.
* @author Nick McHardy <nm@nisch.org>
* @version 1.0
* @package nx3
*
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 06-Jul-2009  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*/

function content_handler($db, $obj_user, $content, $action, $template)
{
  if ($action == "" || $action == 'view')
  {
    define("PAGE_HEADING", "Latest Activity");
    
    if (!ISSET($GLOBALS['NX3_PARAM_ARRAY'][2]) || $GLOBALS['NX3_PARAM_ARRAY'][2] == '')
    {
      $get_start_at = 0; // default
    }
    else
    {
      $get_start_at = $GLOBALS['NX3_PARAM_ARRAY'][2];
    }
    return action_default($db, $obj_user, $get_start_at);
  }
  else
  {
    fatal_error_handler ($db, "Specified action is not valid.");
  }
}

function action_default($db, $obj_user, $get_start_at)
{
  // Retrieve activity item definitions to be shown on the activity module page
  $result_activity = func_db_query($db, "SELECT a.activity_name, a.activity_code, a.activity_description, a.activity_sql
    FROM @TABLE_PREFIX@nx3_activity a WHERE a.activity_id IN @ACTIVITY_SECURITY@ AND a.enabled_yn = 'Y'", null);

  $result_events = array();
  $sql_events_union = '';
  // Assumes all SQL queries which have been defined are in the format:
  // activity_datetime, user_id, user_display_name, activity_message, activity_module, activity_link, activity_summary
  // If not, the UNION ALL query below will fail.
  $last_item = end($result_activity);
  foreach($result_activity as $row)
  {
    $sql_events_union .= $row['activity_sql'];
    if ($row != $last_item)
    {
      $sql_events_union .= "\n UNION ALL \n";
    }
    else
    {
      $sql_events_union .= "\n ORDER BY 1 DESC LIMIT ?,?";
    }
  }
  
  $activity_events_to_show = (int)lookup_setting($db, 'nx3.activity.displaynumber');
  
  $page_content = array();
  
  // Execute union query
  if ($sql_events_union != '')
  {
    $result_events = func_db_query($db, $sql_events_union, array("ii", $get_start_at, $activity_events_to_show));
    
    foreach($result_events as $row_data)
    {
      $page_content['content_activity_list'][] = array(
                        'content_activity_user_name' => $row_data['user_display_name']
                       ,'content_activity_user_id' => $row_data['user_id']
                       ,'content_activity_module' => $row_data['activity_module']
                       ,'content_activity_message' => $row_data['activity_message']
                       ,'content_activity_summary' => strip_tags($row_data['activity_summary'])
                       ,'content_activity_datetime' => func_compare_date_to_now($row_data['activity_datetime'])
                       ,'content_activity_icon' => $row_data['activity_icon']
                       ,'content_activity_link' => $row_data['activity_link']);
    }
  }
  
  // "Prev" and "Next" activity navigation links 
  $page_content['content_activity_prev_start_at'] = $get_start_at - $activity_events_to_show;
  $page_content['content_activity_next_start_at'] = $get_start_at + $activity_events_to_show;
  $page_content['content_activity_events_to_show'] = $activity_events_to_show;
  
  return $page_content;
}

?>