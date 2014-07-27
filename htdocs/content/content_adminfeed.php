<?php

/**
* nx3 Content Module: Admin Feed Editor
* 
* Admin module to view & edit feeds (internal RSS and external RSS).
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
    define("PAGE_HEADING", "View Feeds");
    return action_default($db, $obj_user);
  }
  else
  {
    fatal_error_handler ($db, "Specified action is not valid.");
  }
}

function action_default($db, $obj_user)
{
  $page_content = array();

  // Display all rows - internal RSS feeds
  $db_result = func_db_query($db, "SELECT f.feed_code, f.feed_name, f.feed_description, f.feed_sql, f.enabled_yn
    FROM @TABLE_PREFIX@nx3_feed f ORDER BY 1", null);
  
  foreach ($db_result as $row_id => $row_data)
  {
    $page_content['content_list_feed'][] = array(
      'feed_code' => $row_data['feed_code'], 
      'feed_name' => $row_data['feed_name'],
      'feed_description' => $row_data['feed_description'],
      'feed_sql' => $row_data['feed_sql'],
      'enabled_yn' => $row_data['enabled_yn']
      );
  }

  // Display all rows - external RSS feeds
  $db_result = func_db_query($db, "SELECT f.feed_external_code, f.feed_external_name, f.feed_external_description, f.feed_external_url, f.enabled_yn,
    f.last_cache_attempt, f.last_cache_success, f.auto_index_enabled_yn
    FROM @TABLE_PREFIX@nx3_feed_external f ORDER BY 1", null);
  
  foreach ($db_result as $row_id => $row_data)
  {
    $page_content['content_list_feed_external'][] = array(
      'feed_external_code' => $row_data['feed_external_code'], 
      'feed_external_name' => $row_data['feed_external_name'],
      'feed_external_description' => $row_data['feed_external_description'],
      'feed_external_url' => $row_data['feed_external_url'],
      'last_cache_attempt' => $row_data['last_cache_attempt'],
      'last_cache_success' => $row_data['last_cache_success'],
      'auto_index_enabled_yn' => $row_data['auto_index_enabled_yn'],
      'enabled_yn' => $row_data['enabled_yn']
      );
  }
  
  return $page_content;
}

?>