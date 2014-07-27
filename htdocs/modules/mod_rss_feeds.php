<?php

/**
* nx3 Module: RSS Feeds List
* 
* Adds the list of available RSS feeds into the <HEAD> tag of the template.
* @author Nick McHardy <nm@nisch.org>
* @version 1.1
* @package nx3
* 
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 08-Jul-2009  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*  1.1     | 12-Jan-2010  | nisch       | Changed to support Apache Mod_Rewrite for nicer URLs
* ---------+--------------+-------------+----------------------------------------
*/

  $result_feed_details = func_db_query($db, 'SELECT f.feed_code, f.feed_name FROM @TABLE_PREFIX@nx3_feed f WHERE f.feed_id IN @FEED_SECURITY@', null);
  $arr_content["nx3_feed_list"] = array();
  
  foreach ($result_feed_details as $row)
  {
    $arr_content["nx3_feed_list"][] = array('feed_url' => lookup_setting($db, 'nx3.global.siteurl') . 'feed/view/' . $row['feed_code'] . '/', 
      'feed_title' => $row['feed_name']);
  }

?>
