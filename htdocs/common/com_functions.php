<?php

/**
* nx3 Common Module: Functions
* 
* Provides a number of common database functions.
* @author Nick McHardy <nm@nisch.org>
* @version 1.2
* @package nx3
* 
* MODIFICATION HISTORY
* ---------+--------------+-------------+----------------------------------------
*  Version | Date         | Author      | Notes
* ---------+--------------+-------------+----------------------------------------
*  1.0     | 24-Jun-2009  | nisch       | Initial Version
* ---------+--------------+-------------+----------------------------------------
*  1.1     | 07-Jul-2009  | nisch       | Created func_compare_date_to_now
* ---------+--------------+-------------+----------------------------------------
*  1.2     | 19-Jan-2010  | nisch       | Changed func_compare_date_to_now to make things older than 10 years "very long time ago"
* ---------+--------------+-------------+----------------------------------------
*/

function func_check_parameter($str_content, $str_action, $str_template)
{
  // TODO: add validation here
  return true;
}

function func_db_query($db, $str_query, $arr_bind, $boo_apply_security = true)
{
  // Execute a query with optional binds and return the result set as an array of arrays.
  $arr_result_set = array();
  
  // Apply Security to all queries if requested. default = true.
  if ($boo_apply_security)
  {
    $str_query = auth_apply_sql_security($db, $str_query);
  }
  
  $str_query = str_replace('@TABLE_PREFIX@', constant("table_prefix"), $str_query);
  
  if ($stmt = $db->prepare($str_query))
  {
    // Apply binds to query if they are required (ie $arr_bind is not null when binds are enabled)
    // Assumes first array value starts with the bind format, eg "ssi" would mean two strings followed by one integer,
    // then each element following in the array contains the values to be passed into the bind
    if ($arr_bind <> null)
    {
      call_user_func_array(array($stmt, 'bind_param'), $arr_bind);
    }
    
    // Execute the SQL statement
    $stmt->execute();
    
    if ($stmt->field_count != 0)
    {
      // Only load result set into array if a result set was returned (ie: only for SELECT statements and not for INSERT, UPDATE, DELETE, etc)
      $meta = $stmt->result_metadata(); 
      while ($field = $meta->fetch_field())
      { 
        $params[] = &$row[$field->name]; 
      } 
      
      call_user_func_array(array($stmt, 'bind_result'), $params); 

      while ($stmt->fetch()) { 
        foreach ($row as $key => $val) 
        { 
          $c[$key] = $val; 
        } 
        $arr_result_set[] = $c; 
      }
    }
    
    // Increment query counter
    $GLOBALS['NX3_DB_QUERY_COUNT']++;
    
    // Add query to query log
    $GLOBALS['NX3_DB_QUERY_LOG'][] = array('query' => $str_query, 'binds' => $arr_bind, 'security' => $boo_apply_security);
    
    $stmt->close();
    $meta = null;
    $stmt = null;
  }
  else
  {
    fatal_error_handler ($db, "SQL Processing Error [1] - " . $db->errno . " - " . $db->error . ' SQL: ' . $str_query);
  }
  
  return $arr_result_set;
}

function func_db_query_old_skool($db, $str_query, $boo_apply_security = true)
{
  // Only use this function if you require a binary value to be returned (eg BLOB or TEXT)
  // Does not provide any protection against SQL injection attacks

  $arr_result = array();
  
  // Apply Security to all queries if requested. default = true.
  if ($boo_apply_security)
  {
    $str_query = auth_apply_sql_security($db, $str_query);
  }
  $str_query = str_replace('@TABLE_PREFIX@', constant("table_prefix"), $str_query);

  if ($result = $db->query($str_query, MYSQLI_USE_RESULT))
  {
    while($row = $result->fetch_array())
    {
      $arr_result[] = $row;
    }
    $result->close();
  }
  else
  {
    fatal_error_handler ($db, "SQL Processing Error [2] - " . $db->errno . " - " . $db->error . ' SQL: ' . $str_query);
  }
  
  // Increment query counter
  $GLOBALS['NX3_DB_QUERY_COUNT']++;
  
  // Add query to query log
  $GLOBALS['NX3_DB_QUERY_LOG'][] = array('query' => $str_query, 'binds' => 'n/a: old skool', 'security' => $boo_apply_security);
  
  return $arr_result;
}

function func_db_get_blob($db, $str_table, $str_column, $str_id_column, $str_value)
{
  // Returns the blob
  $result = func_db_query_old_skool($db, "SELECT $str_column FROM @TABLE_PREFIX@$str_table WHERE $str_id_column = $str_value LIMIT 1", true);
  return $result[0][0];
}

function func_compare_date_to_now($mysql_datetime)
{
  // Compares a date to the current time and returns a string which displays a message like "8 hours ago" or "3 months ago"
  $second_diff = strtotime(date('Y-m-d H:i:s', time())) - strtotime($mysql_datetime);
  $minute_diff = round($second_diff / 60, 0);
  $hour_diff = round($second_diff / 60 / 60, 0);
  $day_diff = round($second_diff / 60 / 60 / 24, 0);
  $week_diff = round($second_diff / 60 / 60 / 24 / 7, 0);
  $month_diff = round($second_diff / 60 / 60 / 24 / 30, 0); // Assumes 30 days in a month (hey, this thing is only an approximation!)
  $year_diff = round($second_diff / 60 / 60 / 24 / 365, 0);
  
  if ($second_diff < 60)
  {
    if ($second_diff == 1) return $second_diff . ' second ago';
    else if ($second_diff > 1) return $second_diff . ' seconds ago';
  }
  else if ($minute_diff < 60)
  {
    if ($minute_diff == 1) return $minute_diff . ' minute ago';
    else if ($minute_diff > 1) return $minute_diff . ' minutes ago';
  }
  else if ($hour_diff < 24)
  {
    if ($hour_diff == 1) return $hour_diff . ' hour ago';
    else if ($hour_diff > 1) return $hour_diff . ' hours ago';
  }
  else if ($day_diff < 7)
  {
    if ($day_diff == 1) return $day_diff . ' day ago';
    else if ($day_diff > 1) return $day_diff . ' days ago';
  }
  else if ($week_diff < 4)
  {
    if ($week_diff == 1) return $week_diff . ' week ago';
    else if ($week_diff > 1) return $week_diff . ' weeks ago';
  }
  else if ($month_diff < 12)
  {
    if ($month_diff == 1) return $month_diff . ' month ago';
    else if ($month_diff > 1) return $month_diff . ' months ago';
  }
  else if ($year_diff < 10)
  {
    if ($year_diff == 1) return $year_diff . ' year ago';
    else if ($year_diff > 1) return $year_diff . ' years ago';
  }
  
  return "very long time ago";
}

function com_stripslashes($array)
{
  // Strip slashes from an array
  $array = is_array($array) ?
              array_map('com_stripslashes', $array) :
              stripslashes($array);
  return $array;
}

?>