<?php

/**
* nx3 Module: Online
* 
* Show a count of guests and registered users who have been active in the last nx3.online.frequency minutes.
* @author Nick McHardy <nm@nisch.org>
* @version 1.0
* @package nx3
* 
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 04-Aug-2009  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*/

  // Online guests
  $query_guests_online = func_db_query($db, "SELECT COUNT(DISTINCT l.remote_ip) AS user_count
    FROM @TABLE_PREFIX@nx3_log_usage l WHERE NOW() - INTERVAL ? MINUTE < l.request_datetime AND l.user_id = ?", 
    array("ii", (int)lookup_setting($db, 'nx3.online.frequency'), (int)lookup_setting($db, 'nx3.global.guestuserid')));;
  $arr_content['nx3_online_guests'] = $query_guests_online[0]['user_count'];
  
  // Online registered users
  $query_users_online = func_db_query($db, "SELECT COUNT(1) AS user_count
    FROM @TABLE_PREFIX@nx3_user WHERE NOW() - INTERVAL ? MINUTE < last_active", 
    array("i", (int)lookup_setting($db, 'nx3.online.frequency')));
  $arr_content['nx3_online_users'] = $query_users_online[0]['user_count'];

?>