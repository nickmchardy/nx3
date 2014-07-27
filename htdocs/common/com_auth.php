<?php

/**
* nx3 Common Module: Auth
* 
* Provides various authentication routines and security lookups.
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

function auth_can_access_module($db, $str_module_code)
{
  // Check if user can access module - by code
  $result_module_access = func_db_query($db, "SELECT m.module_code FROM @TABLE_PREFIX@nx3_module m
    WHERE m.module_code = ? AND m.module_id IN @MODULE_SECURITY@ LIMIT 1", array("s", $str_module_code));
  return (isset($result_module_access[0]) && $result_module_access[0]['module_code'] != '');
}
  
function auth_apply_sql_security($db, $str_sql_query)
{
  // Security Lookup Queries - provide a sql 'view' of sorts for common security queries
  // Implemented views are:
  // @FUNCTION_SECURITY@
  // @MENU_ITEM_SECURITY@
  // @RES_SECURITY@
  // @ARTICLE_FOLDER_SECURITY@
  // @MODULE_SECURITY@
  // @FEED_SECURITY@
  // @FEED_EXTERNAL_SECURITY@
  // @ACTIVITY_SECURITY@
  
  if (!ISSET($_SESSION['NX3_USER']))
  {
    $user_id = (int)lookup_setting($db, 'nx3.global.guestuserid');
  }
  else
  {
    $user_id = $_SESSION['NX3_USER']['user_id'];
  }

  $str_sql_query = str_replace('@FUNCTION_SECURITY@', '(SELECT fs.function_id FROM @TABLE_PREFIX@nx3_group_membership gm 
    JOIN @TABLE_PREFIX@function_security fs ON gm.group_id = fs.group_id
    WHERE gm.user_id = ' . $user_id . ')', $str_sql_query);
  $str_sql_query = str_replace('@MENU_ITEM_SECURITY@', '(SELECT mis.menu_item_id FROM @TABLE_PREFIX@nx3_group_membership gm 
    JOIN @TABLE_PREFIX@nx3_menu_item_security mis ON gm.group_id = mis.group_id
    WHERE gm.user_id = ' . $user_id . ')', $str_sql_query);
  $str_sql_query = str_replace('@RES_SECURITY@', '(SELECT rs.res_id FROM @TABLE_PREFIX@nx3_group_membership gm 
    JOIN @TABLE_PREFIX@nx3_res_security rs ON gm.group_id = rs.group_id
    WHERE gm.user_id = ' . $user_id . ')', $str_sql_query);
  $str_sql_query = str_replace('@ARTICLE_FOLDER_SECURITY@', '(SELECT afs.article_folder_id FROM @TABLE_PREFIX@nx3_group_membership gm 
    JOIN @TABLE_PREFIX@nx3_article_folder_security afs ON gm.group_id = afs.group_id
    WHERE gm.user_id = ' . $user_id . ')', $str_sql_query);
  $str_sql_query = str_replace('@MODULE_SECURITY@', '(SELECT ms.module_id FROM @TABLE_PREFIX@nx3_group_membership gm 
    JOIN @TABLE_PREFIX@nx3_module_security ms ON gm.group_id = ms.group_id
    WHERE gm.user_id = ' . $user_id . ')', $str_sql_query);
  $str_sql_query = str_replace('@FEED_SECURITY@', '(SELECT fs.feed_id FROM @TABLE_PREFIX@nx3_group_membership gm 
    JOIN @TABLE_PREFIX@nx3_feed_security fs ON gm.group_id = fs.group_id
    WHERE gm.user_id = ' . $user_id . ')', $str_sql_query);
  $str_sql_query = str_replace('@FEED_EXTERNAL_SECURITY@', '(SELECT fs.feed_external_id FROM @TABLE_PREFIX@nx3_group_membership gm 
    JOIN @TABLE_PREFIX@nx3_feed_external_security fs ON gm.group_id = fs.group_id
    WHERE gm.user_id = ' . $user_id . ')', $str_sql_query);
  $str_sql_query = str_replace('@ACTIVITY_SECURITY@', '(SELECT as.activity_id FROM @TABLE_PREFIX@nx3_group_membership gm 
    JOIN @TABLE_PREFIX@nx3_activity_security `as` ON gm.group_id = as.group_id
    WHERE gm.user_id = ' . $user_id . ')', $str_sql_query);
  return $str_sql_query;
}

function auth_login($db, $str_username, $str_password)
{
  // check if username/password are correct
  $result_user = func_db_query($db, 'SELECT user_id FROM @TABLE_PREFIX@nx3_user WHERE username = ? AND password = MD5(?)',
                               array('ss', $str_username, $str_password));
  if (isset($result_user[0]) && $result_user[0]['user_id'] != '')
  {
    $user_id = $result_user[0]['user_id'];
    $_SESSION['NX3_AUTHENTICATED'] = 'Y';
    auth_retrieve_user_properties($db, $user_id);
    log_message($db, __FILE__, 4, 'Logging user IN - user_id = ' . $user_id);
  }
  else
  {
    // Log user out, set user to 'guest'
    log_message($db, __FILE__, 5, 'User authentication Failed, username = "' . $str_username . '"');
    auth_logout($db);
  }
}

function auth_retrieve_user_properties($db, $user_id)
{
  // Load user properties into session array
  $result_user = func_db_query($db, "SELECT user_id, username, email, display_name, status, activation_code, first_name, last_name, address, city, "
                        . "state, post_code, country, phone1, phone2, phone3, date_of_birth, last_active, post_count, avatar, tag_line, attribute1, "
                        . "attribute2, attribute3, attribute4, attribute5, attribute6, attribute7, attribute8, attribute9, attribute10 "
                        . "FROM @TABLE_PREFIX@nx3_user WHERE user_id = ? LIMIT 1", array("i", $user_id));
  foreach ($result_user[0] as $field => $value)
  {
    $_SESSION['NX3_USER'][$field] = $value;
  }
}

function auth_current_user_is_guest($db)
{
  // Returns true if the user who is accessing the website is using the guest account
  if (!ISSET($_SESSION['NX3_USER']))
  {
    return true;
  }
  else
  {
    return $_SESSION['NX3_USER']['user_id'] == (int)lookup_setting($db, 'nx3.global.guestuserid');
  }
}

function auth_logged_in($db)
{
  return isset($_SESSION['NX3_AUTHENTICATED']) && $_SESSION['NX3_AUTHENTICATED'] == 'Y';
}

function auth_update_last_active($db)
{
  // Updates the user's profile setting when they were last active on the site

  if (auth_logged_in($db))
  {
    $update_user = func_db_query($db, "UPDATE @TABLE_PREFIX@nx3_user SET last_active = NOW() WHERE user_id = ?",
      array("i", $_SESSION['NX3_USER']['user_id']));
  }
}

function auth_logout($db)
{
  $_SESSION['NX3_AUTHENTICATED'] = 'N';
  // log user out - set user to special GUEST account
  auth_retrieve_user_properties($db, (int) lookup_setting($db, 'nx3.global.guestuserid'));
  log_message($db, __FILE__, 4, 'Logging user OUT');
}

?>
