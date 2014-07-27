<?php

/**
* nx3 Common Module: rss
* 
* Provides the ability to pull rss (xml) feeds from external sites (eg twitter) and deliver them inline with nx3-generated content.
* @author Nick McHardy <nm@nisch.org>
* @version 1.0
* @package nx3
* 
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 29-Jun-2009  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*/

$RSS_Content = array();

function rss_extract_tags($item)
{
  // Retrieve tag values for an RSS element
  $arr_item = array();
  
  if (isset($item))
  {
    if ($item->getElementsByTagName("title")->item(0) != null)
      $arr_item["title"] = $item->getElementsByTagName("title")->item(0)->firstChild->data;
    else
      $arr_item["title"] = '';
    
    if ($item->getElementsByTagName("link")->item(0) != null)
      $arr_item["link"] = $item->getElementsByTagName("link")->item(0)->firstChild->data;
    else
      $arr_item["link"] = '';
    
    if ($item->getElementsByTagName("description")->item(0) != null)
      $arr_item["description"] = $item->getElementsByTagName("description")->item(0)->firstChild->data;
    else
      $arr_item["description"] = '';
    
    if ($item->getElementsByTagName("pubDate")->item(0) != null)
      $arr_item["pubDate"] = $item->getElementsByTagName("pubDate")->item(0)->firstChild->data;
    else
      $arr_item["pubDate"] = '';
      
    if ($item->getElementsByTagName("guid")->item(0) != null)
      $arr_item["guid"] = $item->getElementsByTagName("guid")->item(0)->firstChild->data;
    else
      $arr_item["guid"] = '';
  }
  
  return $arr_item;
}

function rss_retrieve_external_feed($db, $feed_code, $fatal_error_if_rss_unreachable = true)
{
  // Look up configured RSS feed
  
  $query_result = func_db_query($db, 'SELECT f.feed_external_id, f.feed_external_name, f.enabled_yn, f.feed_external_url
    FROM @TABLE_PREFIX@nx3_feed_external f WHERE f.feed_external_code = ? AND f.feed_external_id IN @FEED_EXTERNAL_SECURITY@', array("s", $feed_code));

  // Perform checks of result set
  if (!isset($query_result[0]))
  {
    fatal_error_handler($db, "External feed '$feed_code' not found.");
  }
    
  $feed_id = $query_result[0]['feed_external_id'];
  $feed_url = $query_result[0]['feed_external_url'];
  $feed_enabled_yn = $query_result[0]['enabled_yn'];
  
  if ($feed_enabled_yn != 'Y')
  {
    fatal_error_handler($db, "External feed '$feed_code' is disabled.");
  }

  // Retrieve RSS feed and convert it into an array
	$xml_doc = new DOMDocument();
	if (@$xml_doc->load($feed_url) === FALSE) // Using the @ symbol to hide an error if it does occur (prevents URL from being public-readable)
  {
    if ($fatal_error_if_rss_unreachable)
    {
      // Perform error-handling
      fatal_error_handler($db, "Could not open specified RSS Feed with feed code of '$feed_code'. RSS Feed URL may not be reachable.");
    }
    else
    {
      log_message($db, __FILE__, 7, 'ERROR: RSS feed ' . $feed_code . ' unreachable - URL: ' . $feed_url);
      return null;
    }
  }

	$arr_rss = array();

  // Extract channels  
	$xml_channels = $xml_doc->getElementsByTagName("channel");
	foreach($xml_channels as $channel)
	{
    $xml_items = $channel->getElementsByTagName("item");

    // Processing articles
    $arr_item = array();
    foreach($xml_items as $item)
    {
      // Add RSS item to item array
      $new_item = rss_extract_tags($item);
      if ($new_item != null)
      {
        $arr_item[] = $new_item;
      }
    }
  
    // Add channel to RSS array
    $arr_rss[$channel->getElementsByTagName("title")->item(0)->firstChild->data] = $arr_item;
	}
  
  return $arr_rss;
}

function rss_cache_external_feed($db, $feed_code, $arr_rss)
{ 
  if (!empty($arr_rss))
  {   
    // Delete the cache for this feed
    $delete_feed_external_cache = func_db_query($db, 'DELETE FROM @TABLE_PREFIX@nx3_feed_external_cache
      WHERE feed_external_code = ?', array("s", $feed_code));

    // Cache each item in the RSS feed
    foreach ($arr_rss as $channel_name => $arr_items)
    {
      foreach ($arr_items as $item)
      {         
        // Cache the feed in the database
        $insert_feed_external_cache = func_db_query($db, 'INSERT INTO @TABLE_PREFIX@nx3_feed_external_cache
          (feed_external_id, feed_external_code, title, description, pubDate, guid, link, created_date)
          VALUES ((SELECT feed_external_id FROM @TABLE_PREFIX@nx3_feed_external WHERE feed_external_code = ?),?,?,?,?,?,?,NOW())'
          , array("sssssss", $feed_code, $feed_code, $item['title'], $item['description']
            , date("Y-m-d H:i:s", strtotime($item['pubDate'])) // Convert RSS date format to MySQL DATETIME format
            , $item['guid'], $item['link']));
      }
    }
    
    // Update the last cache success date
    $update_feed_external = func_db_query($db, 'UPDATE @TABLE_PREFIX@nx3_feed_external SET last_cache_success = NOW()
      WHERE feed_external_code = ?', array("s", $feed_code));
  }
}

?>