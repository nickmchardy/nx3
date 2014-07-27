<?php

/**
* nx3 Common Module: Log
* 
* Provides log sub system.
* @author Nick McHardy <nm@nisch.org>
* @version 1.1
* @package nx3
* 
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 24-Jun-2009  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*  1.1     | 18-Jan-2010  | nisch       | Changed SERVER variable from HTTP_REFERRER to HTTP_REFERER
* ---------+--------------+-------------+----------------------------------------
*/

function log_init($db)
{
  lookup_setting($db, 'nx3.log.enable');
  lookup_setting($db, 'nx3.log.level');
}
 
function log_message($db, $str_source, $int_severity, $str_message)
{
  if (lookup_setting($db, 'nx3.log.enable') == 'Y' && $int_severity >= lookup_setting($db, 'nx3.log.level'))
  {
    // look up user (requester)
    if (auth_logged_in($db))
    {
      // User is logged in, use logged in account
      $int_user_id = $_SESSION['NX3_USER']['user_id'];
    }
    else
    {
      // Use guest account
      $int_user_id = (int) lookup_setting($db, 'nx3.global.guestuserid');
    }

    // INSERT INTO LOG TABLE
    $insert_into_log = func_db_query($db, 'INSERT INTO @TABLE_PREFIX@nx3_log (request_id, user_id, severity, source, message) VALUES (?,?,?,?,?)',
                               array('siiss', $_SERVER['UNIQUE_ID'], $int_user_id, $int_severity, $str_source, $str_message));
  }
}

function log_usage($db, $int_user_id, $str_content, $str_action, $str_template, $int_query_count, $int_render_time, $str_error_level, $int_content_length, $str_notes = null)
{
  // Log usage to usage statistics table for reporting later on if it is enabled.
  if (lookup_setting($db, 'nx3.log.enableusagestats') == 'Y')
  {
    if (!ISSET($_SERVER['HTTP_REFERER']))
    {
      $str_http_referer = null;
    }
    else
    {
      $str_http_referer = $_SERVER['HTTP_REFERER'];
    }
  
    $insert_into_log_usage = func_db_query($db, 'INSERT INTO `@TABLE_PREFIX@nx3_log_usage` (`request_id`, `request_datetime`, `remote_ip`, `remote_domain`, `user_id`, 
      `url`, `url_referrer`, `content`, `action`, `template`, `render_time`, `query_count`, `error_level`, `content_length`, `notes`)
      VALUES (?,NOW(),?,?,?,?,?,?,?,?,?,?,?,?,?)',
        array('sssisssssiisis'
          , $_SERVER['UNIQUE_ID']
          , $_SERVER['REMOTE_ADDR']
          , gethostbyaddr($_SERVER['REMOTE_ADDR'])
          , $int_user_id
          , (!empty($_SERVER['HTTPS'])) ? "https://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI'] : "http://".$_SERVER['SERVER_NAME'].$_SERVER['REQUEST_URI']
          , $str_http_referer
          , $str_content
          , $str_action
          , $str_template
          , $int_render_time
          , $int_query_count
          , $str_error_level
          , $int_content_length
          , $str_notes
          ));
  }
}

?>