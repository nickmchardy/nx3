<?php

/**
* nx3 Content Module: Feed External
* 
* A sample external RSS feed retriever. Should be expanded on in the future.
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

function content_handler($db, $obj_user, $content, $action, $template)
{ 
  if ($action == "" || $action == 'view')
  {
    define('PAGE_HEADING', 'RSS Feed Retriever');
    return action_default($db, $obj_user, (isset($GLOBALS['NX3_PARAM_ARRAY'][2])) ? $GLOBALS['NX3_PARAM_ARRAY'][2] : null);
  }
  else
  {
    fatal_error_handler ($db, "Specified action is not valid.");
  }
}

function action_default($db, $obj_user, $get_feed_code)
{
  $page_content = array();
  
  if ($get_feed_code == null)
  {
    return array('content_feedexternal_error' => 'feed not specified');
  }
  else
  {
    // get the feed's contents
    $arr_rss = rss_retrieve_external_feed($db, $get_feed_code);
        
    if (!empty($arr_rss))
    {
      // Cache the feed
      rss_cache_external_feed($db, $get_feed_code, $arr_rss);
    
      // Format and display the RSS feed
      foreach ($arr_rss as $channel_name => $arr_items)
      {
        $channel_item_count = 0;
        foreach ($arr_items as $item)
        {
          $page_content['content_feedexternal_list'][] = array('link' => $item['link']
            , 'title' => $item['title']
            , 'description' => $item['description']);
          $channel_item_count++;
        }
        $page_content['content_feedexternal_channel_title'] = $channel_name;
        $page_content['content_feedexternal_item_count'] = $channel_item_count;
      }
    }
  }
  
  return $page_content;
}

?>