<?php

/**
* nx3 Content Module: Admin Log Viewer
* 
* Admin module to view the usage logs.
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
    define("PAGE_HEADING", "View Log");
    return action_default($db, $obj_user);
  }
  else
  {
    fatal_error_handler ($db, "Specified action is not valid.");
  }
}

function action_default($db, $obj_user)
{
  // Display all logs in DB
  $db_result = func_db_query($db, "SELECT LEFT(request_datetime, 10) AS request_datetime, content, action, 
    SUM(render_time) / SUM(CASE WHEN error_level <> 'FATAL' THEN 1 ELSE 0 END) AS render_time, 
    SUM(query_count) / SUM(CASE WHEN error_level <> 'FATAL' THEN 1 ELSE 0 END) AS query_count, 
    SUM(CASE WHEN error_level = 'FATAL' THEN 1 ELSE 0 END) AS error_count, 
    SUM(CASE WHEN error_level <> 'FATAL' THEN 1 ELSE 0 END) AS view_count FROM @TABLE_PREFIX@nx3_log_usage
    GROUP BY LEFT(request_datetime, 10), content, action ORDER BY 1 DESC", null);
  
  $page_content = array();
  foreach ($db_result as $row_id => $row_data)
  {
    $page_content['content_usage_log'][] = array('request_datetime' => $row_data['request_datetime'], 
      'content' => $row_data['content'],
      'action' => $row_data['action'],
      'render_time' => $row_data['render_time'],
      'query_count' => $row_data['query_count'],
      'error_count' => $row_data['error_count'],
      'view_count' => $row_data['view_count']
      );
  }
  return $page_content;
}

?>