<?php

/**
* nx3 Content Module: Online
* 
* List of online users. For admins.
* @author Nick McHardy <nm@nisch.org>
* @version 1.0
* @package nx3
*
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 17-Aug-2009  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*/

function content_handler($db, $obj_user, $content, $action, $template)
{
  define("PAGE_HEADING", 'Online Users');

  $arr_content = array();
  $arr_content['content_online_frequency'] = lookup_setting($db, 'nx3.online.frequency');
  
  // Online guests
  $query_guests_online = func_db_query($db, "SELECT l.remote_domain AS name, MAX(l.request_datetime) AS datetime
    FROM @TABLE_PREFIX@nx3_log_usage l WHERE NOW() - INTERVAL ? MINUTE < l.request_datetime AND l.user_id = ?
    GROUP BY l.remote_domain ORDER BY 2 DESC",  array("ii", (int)lookup_setting($db, 'nx3.online.frequency'), (int)lookup_setting($db, 'nx3.global.guestuserid')));
  foreach ($query_guests_online as $row)
  {
    $arr_content['content_online_guests'][] = array('name' => $row['name'], 'datetime' => $row['datetime']);
  }

  // Online registered users
  $query_users_online = func_db_query($db, "SELECT u.display_name AS name, u.last_active AS datetime
    FROM @TABLE_PREFIX@nx3_user u WHERE NOW() - INTERVAL ? MINUTE < u.last_active", 
    array("i", (int)lookup_setting($db, 'nx3.online.frequency')));
  foreach ($query_users_online as $row)
  {
    $arr_content['content_online_users'][] = array('name' => $row['name'], 'datetime' => $row['datetime']);
  }  
  
  return $arr_content;
}

?>