<?php

/**
* nx3 Script Module: Feed
* 
* Provides the ability to deliver an RSS feed as XML to the browser based on a SQL query.
* @author Nick McHardy <nm@nisch.org>
* @version 1.0
* @package nx3
* 
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 24-Jun-2009  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*/

function script_handler($db, $obj_user, $content, $action, $smarty_template_file)
{
  if ($action == '')
  {
    fatal_error_handler ($db, "Invalid action specified.");
  }

  $get_feed_code = $GLOBALS['NX3_PARAM_ARRAY'][2];
  
  // Validate parameters
  if ($get_feed_code == '')
  {
    fatal_error_handler ($db, "No feed specified.");
  }

  // Fetch feed definition. Also check if user is able to access feed (apply security).
  $result_feed_details = func_db_query($db, 'SELECT f.feed_id, f.feed_code, f.feed_name, f.feed_description, f.feed_sql, f.enabled_yn
    FROM @TABLE_PREFIX@nx3_feed f WHERE f.feed_code = ? AND f.feed_id IN @FEED_SECURITY@', array("s", $get_feed_code));
      
  // Perform checks of result set
  if (!isset($result_feed_details[0]))
  {
    fatal_error_handler ($db, "Requested feed code " . $get_feed_code . " does not exist or you do not have access to the feed.");
  }
  
  $feed_id = $result_feed_details[0]['feed_id'];
  $feed_name = $result_feed_details[0]['feed_name'];
  $feed_description = $result_feed_details[0]['feed_description'];
  $feed_sql = $result_feed_details[0]['feed_sql'];
  $feed_enabled_yn = $result_feed_details[0]['enabled_yn'];
  
  if ($feed_enabled_yn != 'Y')
  {
    fatal_error_handler ($db, "Requested feed code " . $get_feed_code . " is not enabled.");
  }
  
  /* Assumes the SQL query returns the following columns:
      guid, title, link, description, pubDate
   */
  
  // Generate RSS XML based on SQL query. Security is applied by the func_db_query call below.
  $result_feed_content = func_db_query($db, $feed_sql, null);
  $page_content = array();
  foreach ($result_feed_content as $row)
  {
    $page_content['script_feed_items'][] = array('script_feed_item_guid' => $row['guid']
      , 'script_feed_item_title' => htmlspecialchars(strip_tags($row['title']))
      , 'script_feed_item_link' => strip_tags($row['link'])
      , 'script_feed_item_description' => htmlspecialchars(strip_tags($row['description']))
      , 'script_feed_item_pub_date' => date("r", strtotime($row['pubDate']))); // Convert to RSS date from MySQL DATETIME format
  }
  
  $page_content['script_feed_title'] = htmlspecialchars($feed_name);
  $page_content['script_feed_link'] = lookup_setting($db, 'nx3.global.siteurl');
  $page_content['script_feed_description'] = htmlspecialchars($feed_description);
  
  // Invoke Smarty Template Engine
  $smarty = new Smarty;
  $smarty->template_dir = lookup_setting($db, 'smarty.template.location');
  $smarty->compile_dir = lookup_setting($db, 'smarty.compile.location');
  $smarty->config_dir = lookup_setting($db, 'smarty.config.location');
  $smarty->compile_check = $GLOBALS['NX3_DEBUG']; // Only compile if NX3 debug mode is enabled
  foreach ($page_content as $key => $value)
  {
    $smarty->assign($key, $value);
  }
  
  // change the content-type so the browser knows how to handle it
  header("Content-type: application/rss+xml");
  
  // set the content expiry thing so the browser always gets the latest version
  header("Cache-Control: no-cache");

  // Return the xml data
  return $smarty->fetch($smarty_template_file);
}
 
?>