<?php

/**
* nx3 Content Module: News
* 
* Description.
* @author Nick McHardy <nm@nisch.org>
* @version 1.0
* @package nx3
*
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 11-Jun-2009  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*/

  function content_handler($db, $obj_user, $content, $action, $template)
  {
    define("PAGE_HEADING", "Latest News");
    return 'This is coming from the mod_news file.';  
  }
/*
  $obj_news = new mysql_multi_record(constant("table_prefix"), 'nx2_threads',
     "WHERE forum_id = 3 ORDER BY datetime DESC");

  foreach ($obj_news->fields as $record)
  {
    $page_content .= "<p><font size=4><b>:: " . $record['title'] . " ::</b></font><br><br>";
    $page_content .= "" . $record['post'] . "<br><br>";
    $page_content .= "<font size=2><i>Posted " . date_format_nx($record['datetime']) . " by ";
    $page_content .= "" . get_username($record['member_id']) . "<br></i></font></p><hr>";
    
  }      
    
  return $page_content;

}

*/

?>