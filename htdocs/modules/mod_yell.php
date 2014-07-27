<?php

/**
* nx3 Module: Yell
* 
* Provides the yell box to submit yell messages.
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

  // Display recent yells in DB in reverse order
  $db_result = func_db_query($db, "SELECT y.created_date, y.yell_id, IF(y.created_by = -1, y.name, u.display_name) AS name, y.comment FROM @TABLE_PREFIX@nx3_yell y 
    JOIN @TABLE_PREFIX@nx3_user u ON y.created_by = u.user_id ORDER BY 1 DESC LIMIT ?", array("i", (int)lookup_setting($db, 'nx3.yell.displaynumber')));
  
  // Reverse results so that the latest appears at the bottom
  $db_result = array_reverse($db_result);
  $arr_content["nx3_yell_history"] = array();
  
  foreach ($db_result as $row_id => $row_data)
  {
    $arr_content["nx3_yell_history"][] = array('name' => $row_data['name'], 'comment' => wordwrap($row_data['comment'], 16, ' ', 1));
  }
  
  // Assign anti-spam key
  $arr_content["nx3_yell_anti_spam_key"] = lookup_setting($db, 'nx3.global.antispamkey');
  
?>