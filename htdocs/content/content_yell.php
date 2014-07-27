<?php

/**
* nx3 Content Module: Yell
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
*  1.1     | 12-Jan-2010  | nisch       | Changed to support Apache Mod_Rewrite for nicer URLs
* ---------+--------------+-------------+----------------------------------------
*/

function content_handler($db, $obj_user, $content, $action, $template)
{
  if ($action == "view" || $action == "")
  {
    define("PAGE_HEADING", "Complete Yell Box History");
    return action_default($db, $obj_user);
  }
  else if ($action == 'submit')
  {
    define("PAGE_HEADING", "Yell");
    return action_submit($db, $obj_user);
  }
  else
  {
    fatal_error_handler ($db, "Specified action is not valid.");
  }
}

function action_default($db, $obj_user)
{
  // Display all Yells in DB in reverse order
  $db_result = func_db_query($db, "SELECT y.created_date, y.yell_id, IF(y.created_by = -1, y.name, u.display_name) AS name, y.comment FROM @TABLE_PREFIX@nx3_yell y 
    JOIN @TABLE_PREFIX@nx3_user u ON y.created_by = u.user_id ORDER BY 1 DESC", null);
  
  $page_content = array();
  foreach ($db_result as $row_id => $row_data)
  {
    $page_content['content_yell_list'][] = array('name' => $row_data['name'], 'comment' => $row_data['comment']);
  }
  return $page_content;
}

function action_submit($db, $obj_user)
{
  $comments = strip_tags($_POST['comments']);
  if ($_POST['target'] != '')
  {
    $url = $_POST['target']; // success, forward user to previous page
  }
  else
  {
    $url = lookup_setting($db, 'nx3.global.siteurl') . 'yell/'; // Success, forward user to default page
  }
  
  if (auth_current_user_is_guest($db))
  {
    // Guest users
  
    // Anti-spam key validation
    $key = strip_tags($_POST['key']);
    $name = strip_tags($_POST['name']);
    $anti_spam_key = lookup_setting($db, 'nx3.global.antispamkey');
    if ($key != $anti_spam_key)
    {
      return array('content_yell_error' => 'spam_key_mismatch', 'content_yell_anti_spam_key' => $anti_spam_key);
    }
    
    // Basic data validation
    if (strlen($name) < 2 || strlen($comments) < 2)
    {
      return array('content_yell_error' => 'missing_data');
    }
    else
    {
      $yell_insert = func_db_query($db, "INSERT INTO @TABLE_PREFIX@nx3_yell 
        (comment, name, request_id, created_date) VALUES (?,?,?,NOW())", 
        array("sss", $comments, $name, $_SERVER['UNIQUE_ID']));
        
      return array('content_yell_target' => $url);
    }
  }
  else
  {
    // Registered users
    
    // Basic data validation
    if ($comments == '')
    {
      return array('content_yell_error' => 'missing_data');
    }
    else
    {
      $yell_insert = func_db_query($db, "INSERT INTO @TABLE_PREFIX@nx3_yell 
        (comment, request_id, created_date, created_by) VALUES (?,?,NOW(),?)", 
        array("ssi", $comments, $_SERVER['UNIQUE_ID'], $_SESSION['NX3_USER']['user_id']));       
        
      return array('content_yell_target' => $url);
    }
  }
}
?>